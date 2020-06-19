<?php


namespace App\Migrations;



use App\Entity\Authority;
use App\Entity\Image;
use App\Entity\Kontakt;
use App\Entity\NavBarHref;
use App\Entity\OpenHours;
use App\Entity\Problem;
use App\Entity\Proza;
use App\Entity\Slideshow;
use App\Entity\User;
use App\Entity\Usluga;
use App\Entity\Zabieg;

class FileReader
{
    private $PATH;
    private $ZDJECIA = "\zdjecia";
    private $TEKSTY = "\\teksty";

    public function __construct()
    {
        $this->PATH = $_SERVER['DOCUMENT_ROOT'] . "\\files";
    }

    public function getDataForDB() : array{
        $images = $this->getImages();
        $problemsAndZabiegs = $this->getProblems($images);
        $uslugs = $this->getUslugs($problemsAndZabiegs["zabiegs"]);
        $kontaktArr = $this->getKontakt();
        $credentials = $this->getBaseCredentials();
        return ["images"=>$images,  //array
                "problems"=>$problemsAndZabiegs["problems"], //array
                "zabiegs"=>$problemsAndZabiegs["zabiegs"],  //array
                "uslugs"=>$uslugs,   //array
                "kontakt"=>$kontaktArr["kontakt"],
                "openHours"=>$kontaktArr["openHours"], //array
                "slideshow"=>$this->getSlideshow($images),
                "navBarHref"=>$this->getNavBar(),
                "prozas"=>$this->getProzas(),
                "users"=>$credentials["users"],
                "authority"=>$credentials["authority"]]; //array
    }
    private function readFile($path) :array {
        $result = array();
        if(file_exists($path)){
//            1 opcja czytania plikow
//            $file = fopen($path, "r") or die("Unable to open file!");
//            $result = fread($file,filesize($path));
//            fclose($file);
//            return $result;
//            2 opcja czytania plikow
//            return file_get_contents($path);

            $file = fopen($path, "r");
            if($file){
                while(($line = fgets($file)) !== false){
                    $result[] = $line;
                }
            }
        }
        return $result;
    }
    private function getFileList($path) : array{
        return scandir($path);
    }
    private function getImages(): array{
        $path = $this->PATH . $this->ZDJECIA;
        $listOfZdjecia = $this->getFileList($path);
        $images = array();
        $size = count($listOfZdjecia);
        for($j=0; $j<$size; $j++) {
            $name = basename($listOfZdjecia[$j]);
            if($name === "." || $name === ".."){
                continue;
            }
            $object = new Image(substr($name, 0, strrpos($name, ".")),
                "/files/zdjecia/" . $name);
            $images[] = $object;
        }
        return $images;
    }
    private function getProblems($imageArray): array{
        $pathTxt = $this->PATH . $this->TEKSTY;
        $listOfZdjecia = $imageArray;
        $listOfTeksty = $this->getFileList($pathTxt);
        $size = sizeof($listOfTeksty);
        $problems = array();
        $zabiegs = array();
        for($i=0; $i<$size; $i++){
            $name = basename($listOfTeksty[$i]);
            if($name === "." || $name === ".."){
                continue;
            }
            $textValue = $this->readFile($pathTxt . "\\" . $name);
            $zdjeciaSize = sizeof($listOfZdjecia);
            for($j=0; $j<$zdjeciaSize; $j++) {
                $zdjecie = $listOfZdjecia[$j];
                $zdjecieName = mb_strtoupper(trim($zdjecie->getName()), "UTF-8");
                $problemName = mb_strtoupper(trim($textValue[0]), "UTF-8");
                if(strcasecmp($zdjecieName, $problemName) == 0){
                    $object = new Problem();
                    $object->setName($problemName);
                    $textValue[0] = "";
                    $object->setDescription(implode($textValue));
                    $object->setImage($zdjecie);
                    $object->setUrlPath(
                        "/problem/" . $this->generateUrlPath($problemName));
                    $problems[] =$object;
                    break;
                }elseif(strpos($problemName, 'ZABIEG') !== false){
                    $problemName = str_replace("ZABIEG", "", $problemName);
                    $type = $problemName;
                    $problemName = mb_strtoupper(trim($textValue[1]), "UTF-8");
                    if(strcasecmp($zdjecieName, $problemName) == 0){
                        $priceOnce = floatval($textValue[2]);
                        $priceSeries = floatval($textValue[3]);
                        $textValue[1] = "";
                        $textValue[2] = "";
                        $textValue[3] = "";
                        $object = new Zabieg();
                        $object->setName($problemName);
                        $textValue[0] = "";
                        $object->setDescription(implode($textValue));
                        $object->setImage($zdjecie);
                        $object->setUrlPath(
                            "/zabieg/".strtolower($type)."/". $this->generateUrlPath($problemName));
                        $object->setCategory($type);
                        $object->setPriceOnce($priceOnce);
                        $object->setPriceSeries($priceSeries);
                        $object->setDuration(10);
                        $zabiegs[] =$object;
                    }
                }
            }

        }
        return ["problems"=>$problems, "zabiegs"=>$zabiegs];
    }

    public static function generateUrlPath($zdjecieName):string
    {
        $name = mb_strtolower($zdjecieName, "UTF-8");
        $polskieZnaki = array("ł", "ó", "ą", "ę", "ż", "ź", "ń", "ć", "ś", " ", "_");
        $replacement = array("l", "o", "a", "e", "z", "z", "n", "c", "s", "-", "-");
        $name = str_replace($polskieZnaki, $replacement, $name);
        return $name;
    }
    private function getUslugs($zabiegs) : array{
        $uslugs = array();
        for($i=0;$i<sizeof($zabiegs);$i++) {
           $zabieg = $zabiegs[$i];
            $uslugs[] = new Usluga($zabieg->getCategory(),
               $zabieg->getName(),
               $zabieg->getPriceOnce(),
               $zabieg->getPriceSeries(),
               $zabieg
           );
       }
        $uslugs[] = new Usluga("TRYCHOLOGICZNY",
            mb_strtoupper("Masaż linfatyczny skóry głowy", "UTF-8"),
            80.0, 0.0, null);
        $uslugs[] = new Usluga("DIAGNOSTYCZNY",
            "WIZYTA KONTROLNA",
            60.0, 0.0, null);
        $uslugs[] = new Usluga("DIAGNOSTYCZNY",
            mb_strtoupper("Badanie skóry głowy trichoskopem + konsultacja trychologiczna", "UTF-8"),
            80.0, 0.0, null);
        return $uslugs;
    }
    private function getSlideshow($imageArray) : Slideshow{
        $result = new Slideshow();
        $slides = array();
        for($i=0;$i<6;$i++){
            $result->addImage($imageArray[$i]);
        }
        $result->setName("Piewrszy pokaz");
        $result->setDescription("<p><strong>W gabinecie TRICHODERMEDICA trycholog</strong>:</p>" .
            "<ul><li>przeprowadzi wywiad dotyczący stanu zdrowia</li>".
            "<li>wykona badanie skóry głowy za pomocą <a class=\"text-decoration-none\" href=\"/trichoskopia\">trichoskopu</a></li>".
            "<li>zdiagnozuje przyczynę danego problemu skóry głowy</li>".
            "<li>zaleci oraz wykona specjalistyczne zabiegi trychologiczne wspomagające leczenie danego schorzenia</li>".
            "<li>dobierze odpowiednie preparaty trychologiczne</li>".
            "<li>w przypadku potrzeby, skieruje na badania analityczne</li>".
            "<li>wykonane przez lekarza specjalistę (m.in. endokrynologa, dermatologa, immunologa).</li></ul>");
        return $result;
    }
    private function getKontakt() : array{
        $open = array("09:00", "10:00", "09:00", "10:00", "09:00");
        $close = array("16:00", "18:00", "16:00", "18:00", "16:00");
        $days = array("Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek");
        $kontakt = new Kontakt();
        $kontakt->setCity("Sosnowiec");
        $kontakt->setEmail("trichodermedica@gmail.com");
        $kontakt->setZipCode("41-205");
        $kontakt->setStreet("Staropogańska");
        $kontakt->setHouseNumber("14/1");
        $kontakt->setPhone("+48 798 208 775");
        $openHoursArr = array();
        for ($i=0;$i<5;$i++){
            $object = new OpenHours();
            $object->setClose($close[$i]);
            $object->setDay($days[$i]);
            $object->setOpen($open[$i]);
            $kontakt->addOpenHour($object);
            $openHoursArr[] = $object;
        }
        return ["openHours"=>$openHoursArr,
            "kontakt"=>$kontakt];
    }

    private function getNavBar():array
    {
        $result = array();
        $names = array("Strona Główna", "O Mnie", "Zabiegi", "Preparaty trychologiczne", "Cennik", "Bon Podarunkowy", "Kontakt");
        $hrefs = array("/", "/omnie", "/zabieg", "/preparatytrychologiczne", "/cennik", "/bonpodarunkowy", "/kontakt");
        for ($i=0;$i<7;$i++){
            $object = new NavBarHref();
            $object->setName($names[$i]);
            $object->setUrlPath($hrefs[$i]);
            $result[] = $object;
        }
        return $result;
    }
    private function getProzas() : array{
        $result = array();
        $proza1 = new Proza();
        $proza1->setName("home");
        $proza1->setTresc('<p>Wygląd włos&oacute;w jest odzwierciedleniem zdrowia i kondycji całego organizmu.</p> 
					<p>Pogorszenie ich stanu, nadmierne wypadanie mogą świadczyć o zaburzeniach wewnątrzustrojowych, niewłaściwie zbilansowanej diecie lub narażeniu na przewlekły stres.</p> 
					<p>W celu uzyskania poprawy, konieczne jest podjęcie kompleksowych działań. Pierwszym krokiem jest wizyta w gabinecie, kt&oacute;ry powstał z myślą o osobach cierpiących na wszelkiego rodzaju dolegliwości związane z chorobami sk&oacute;ry głowy.</p> <p>Gabinet TRICHODERMEDICA oferuje kompleksowe oraz indywidualne podejście do każdego klienta.</p>
                    <p>Specjalizuje się w diagnozowaniu oraz wspomaganiu leczenia schorzeń sk&oacute;ry głowy takich jak: wypadanie włos&oacute;w, łysienie, łupież, łojotok, łojotokowe zapalenie sk&oacute;ry głowy, atopowe zapalenie sk&oacute;ry głowy, sucha i wrażliwa sk&oacute;ra głowy. W ofercie gabinetu znajduje się bogata oferta zabieg&oacute;w pielęgnujących suche oraz zniszczone włosy.</p>
                    <p>W pierwszej kolejności&nbsp; przeprowadzana jest konsultacja trychologiczna wraz z badaniem sk&oacute;ry głowy za pomocą <a href=/trichoskopia>trichoskopu</a>. Na tej podstawie diagnozowana jest przyczyna danego schorzenia oraz postawienie właściwej diagnozy. Kolejny krok stanowi opracowanie indywidualnej trychoterapii &nbsp;dostosowanej do konkretnego problemu oraz dob&oacute;r profesjonalnych preparat&oacute;w&nbsp; w celu uzupełnienia specjalistycznej kuracji domowej.</p>
                    <p>Ponadto, w ofercie gabinetu znajdują się zabiegi z zakresu kosmetologii o działaniu oczyszczającym, nawilżającym oraz przeciwstarzeniowym.</p>');
        $trichoskopia = new Proza();
        $trichoskopia->setName("trichoskopia");
        $trichoskopia->setTresc('<h1><strong>TRICHOSKOPIA</strong></h1><br />
					<h6><strong>Opis badania trichoskopem:</strong></h6> 
					<p>Trichoskopia to nieinwazyjne oraz bezpieczne badanie obrazowe sk&oacute;ry głowy i
					włos&oacute;w. Może być przeprowadzane u os&oacute;b w każdym wieku. Za pomocą urządzenia
					zwanego trichoskop, kt&oacute;ry wyposażony jest w r&oacute;żne skale powiększenia oraz
					specjalistyczne źr&oacute;dło światła można otrzymać bardzo precyzyjny obraz sk&oacute;ry głowy,
					kt&oacute;ry ułatwi zdiagnozowanie danego schorzenia. Obraz z mikrokamery widoczny jest także dla osoby poddawanej badaniu.</p><br />
					<p>W 200x powiększeniu możliwa jest ocena stanu mieszk&oacute;w włosowych, naczyń
					krwionośnych, stopnia produkcji łoju lub określenie kondycji samych łodyg włos&oacute;w.<br />
					Na podstawie badania mikrokamerą możliwe jest określenie przyczyny wypadania
					włos&oacute;w, rodzaju łysienia oraz stopnia jego zaawansowania.
					<h6><strong>Cel badania:</strong></h6>
					<p>Badanie mikrokamerą przeprowadzane jest w celu ustalenia przyczyny danego
					problemu sk&oacute;rnego oraz ułatwia postawienie trafnej diagnozy. Ponadto dzięki
					analizie trycholog pomaga dobrać odpowiednią kurację trychologiczną, kt&oacute;ra ma na
					celu przywr&oacute;cenie prawidłowego funkcjonowanie sk&oacute;ry oraz umożliwia obiektywną
					ocenę jej skuteczności na podstawie archiwizacji zdjęć, kt&oacute;re wykonywane są
					podczas badania.</p>
					<h6><strong>Czas trwania:</strong> 60 min</h6>
					<h6><strong>Przygotowanie do badania trychologicznego:</strong></h6>
					<p>Bardzo ważne jest, aby w dniu badania nie myć głowy ani włos&oacute;w. Najlepiej zrobić to
					1-2 dni przed przystąpieniem do badania. Nie należy stosować środk&oacute;w
					stylizujących, lakieru, suchego szamponu oraz odżywek, kt&oacute;re zaburzają rzeczywisty
					obraz. Nie powinno się r&oacute;wnież farbować włos&oacute;w i wykonywać trwałej ondulacji.<br />
					<h6><strong>Przeciwwskazania:</strong></h6>
					<p>Brak przeciwwskazań do wykonania badania.</p>');
        $omnie = new Proza();
        $omnie->setName("omnie");
        $omnie->setTresc('Gabinet TRICHODERMEDICA to kompleksowego oraz indywidualne podejście do każdego klienta.
        Połączenie profesjonalizmu, rzetelnej wiedzy oraz doświadczenia. Przyjazna atmosfera, która
        gwarantuje odprężenie a także poczucie wyjątkowości oraz intymności.
        TRICHODERMEDICA specjalizuje się w diagnozowaniu oraz wspomaganiu leczenia schorzeń skóry
        głowy takich jak: wypadanie włosów, łysienie, łupież, łojotok, łojotokowe zapalenie skóry głowy,
        atopowe zapalenie skóry głowy, sucha i wrażliwa skóra głowy. Wspomagam pielęgnację suchych oraz
        zniszczonych włosów.
        W pierwszej kolejności  przeprowadzam konsultację wraz z badaniem skóry głowy za pomocą
        trychoskopu oraz diagnozuję przyczynę danego schorzenia. Następnie zalecam i wykonuję zabiegi
        trychologiczne oraz dobieram profesjonalne preparaty  w celu uzupełnienia kuracji domowej.
        Ponadto, w ofercie znajdują się zabiegi z zakresu kosmetologii, dotyczące zarówno twarzy jak i ciała.');
        $cytat = new Proza();
        $cytat->setName("quote");
        $cytat->setTresc('<blockquote><p><strong>Wiedza</strong>, <strong>doświadczenie</strong>
                                                           i <strong>profesjonalizm</strong><br/> pozwolą ci odzyskać
                                                           <strong>zdrowe</strong> <br/> i piękne <strong>włosy</strong>
                                                           oraz <strong>skórę</strong>. </p> <footer><cite>Anna Wilkusz</cite></footer>
                                                            </blockquote>');
        $result[] = $proza1;
        $result[] = $trichoskopia;
        $result[] = $omnie;
        $result[] = $cytat;
        return $result;
        }
        private function getBaseCredentials():array{
        $admin = new Authority();
        $admin->setAuthority("ROLE_ADMIN");
        $admin->setUsername("fpmoles@fpmoles.pl");
        $user = new Authority();
        $user->setUsername("fpmoles@fpmoles.pl");
        $user->setAuthority("ROLE_USER");
        $user2 = new Authority();
        $user2->setUsername("jdoe@jdoe.pl");
        $user2->setAuthority("ROLE_USER");
        $fpmoles = new User();
        $fpmoles->setUsername("fpmoles@fpmoles.pl");
        $fpmoles->setRoles(array($admin, $user));
        $fpmoles->setPassword("$2y$10\$TWUOu.RuZvySpJ9Udr3dAu88Ql23V9y2sBJxdAJHS9jWTZ1TQFnIm");
        $jdoe = new User();
        $jdoe->setUsername("jdoe@jdoe.pl");
        $jdoe->setRoles(array($user2));
        $jdoe->setPassword("$2y$10\$TWUOu.RuZvySpJ9Udr3dAu88Ql23V9y2sBJxdAJHS9jWTZ1TQFnIm");
        $users = array();
        $auth = array();
        $users[] = $fpmoles;
        $users[] = $jdoe;
        $auth[] = $admin;
        $auth[] = $user;
        $auth[] = $user2;
        return ["authority"=>$auth,
                "users"=>$users];
        }
}