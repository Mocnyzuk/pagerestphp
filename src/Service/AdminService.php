<?php


namespace App\Service;


use App\Entity\Image;
use App\Entity\Problem;
use App\Entity\Usluga;
use App\Entity\Zabieg;
use App\Migrations\FileReader;
use Exception;
use http\Env\Response;
use mysql_xdevapi\Result;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class AdminService
{
    private $repoService;
    private $serializer;

    /**
     * AdminService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
        $this->repoService = $repoService;
    }

    public function handlePostCennik(Request $request): int
    {
        if($this->decodeCennik($request->getContent())){
            return 201;
        }
        return 400;
    }


    public function handlePostKontakt(Request $request): int
    {
        if($this->decodeKontakt($request->getContent())){
            return 201;
        }
        return 400;
    }

    public function handlePostSlideshow(Request $request)
    {
        if($this->decodeSlideshow($request->getContent())){
            return 201;
        }
        return 400;
    }

    public function handlePostProblem(Request $request)
    {
        if($this->decodeProblem($request->getContent())){
            return 201;
        }
        return 400;
    }

    public function handlePostProza(Request $request)
    {
        if($this->decodeProza($request->getContent())){
            return 201;
        }
        return 400;
    }

    public function handlePostZabieg(Request $request)
    {
        if($this->decodeZabieg($request->getContent())){
            return 201;
        }
        return 400;
    }

    private function decodeCennik($json): bool {
        try {
            $data = json_decode($json, true);
            $keySet = array_keys($data);
            $uslugas = array();
            foreach ($keySet as $key) {
                $uslugas = array_merge($uslugas, $data[$key]);

            }
            foreach ($uslugas as $usluga) {
                $old = $this->repoService->getUslugaRepo()->find($usluga["id"]);
                $zabieg = $usluga["zabieg"];
                if ($zabieg) {
                    $image = $zabieg["image"];
                    if ($image) {
                        $image = new Image($image["name"], $image["path"], $image["id"]);
                    } else {
                        $image = null;
                    }
                    $zabieg = new Zabieg($zabieg["id"],
                        $zabieg["category"],
                        $zabieg["urlPath"],
                        $zabieg["name"],
                        $zabieg["description"],
                        $zabieg["priceOnce"],
                        $zabieg["priceSeries"],
                        $zabieg["duration"],
                        $image);
                    $old->setZabieg($zabieg);
                }


                $old->setCategory($usluga["category"]);
                $old->setName(ucfirst($usluga["name"]));
                $old->setPriceOnce($usluga["priceOnce"]);
                $old->setPriceSeries($usluga["priceSeries"]);
            }
            $this->repoService->getEntityManager()->flush();
        }catch (Exception $e){
            return false;
        }

            return true;
}

    private function decodeKontakt($json): bool
    {
        try {
            $data = json_decode($json, true);
            $old = $this->repoService->getKontaktRepo()->find($data["id"]);
            $openHoursArr = $data["openHours"];
            $openHoursRepo = $this->repoService->getOpenHoursRepo();
            foreach ($openHoursArr as $oh) {
                $oldOH = $openHoursRepo->find($oh["id"]);
                $oldOH->setOpen($oh["open"]);
                $oldOH->setClose($oh["close"]);
            }
            $old->setEmail($data["email"]);
            $old->setCity($data["city"]);
            $old->setZipCode($data["zipCode"]);
            $old->setPhone($data["phone"]);
            $old->setStreet($data["street"]);
            $old->setHouseNumber($data["houseNumber"]);
            $this->repoService->getEntityManager()->flush();
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    private function decodeZabieg($json):bool
    {
        try {
            $data = json_decode($json, true);
            if (key_exists("id", $data)) {
                $old = $this->repoService->getZabiegRepo()->find($data["id"]);
                $old->setCategory($data["category"]);
                $old->setName(ucfirst($data["name"]));
                $old->setDescription($data["description"]);
                $old->setPriceOnce($data["priceOnce"]);
                $old->setPriceSeries($data["priceSeries"]);
                $old->setDuration($data["duration"]);
                $old->setUrlPath("/zabieg/" . $old->getCategory() . "/" . FileReader::generateUrlPath($old->getName()));
                $image = $data["image"];
                if ($image) {
                    $oldImage = $this->repoService->getImageRepo()->find($image["id"]);
                    $old->setImage($oldImage);
                }
            } elseif (key_exists("name", $data)) {
                $zabieg = new Zabieg();
                $zabieg->setName($data["name"]);
                $this->repoService->getEntityManager()->persist($zabieg);
            }
            $this->repoService->getEntityManager()->flush();
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    private function decodeSlideshow($json):bool
    {
        try {
            $data = json_decode($json, true);
            $old = $this->repoService->getSlideshowRepo()->findAll()[0];
            $newImages = $this->repoService->getImageRepo()->findBy(["id" => $data["slides"]]);
            if(!$newImages){
                return false;
            }
            $old->getImages()->clear();
            foreach ($newImages as $image){
                $old->addImage($image);
            }
            $old->setDescription($data["description"]);
            $this->repoService->getEntityManager()->flush();
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    private function decodeProblem($json):bool
    {
        try{
            $data = json_decode($json, true);

            if (key_exists("id", $data)) {
                $old = $this->repoService->getProblemRepo()->find($data["id"]);
                $old->setDescription($data["description"]);
                $old->setName(ucfirst($data["name"]));
                $old->setUrlPath("/problem/".FileReader::generateUrlPath($old->getName()));
                $old->setImage($this->repoService->getImageRepo()->find($data["image"]["id"]));
                $this->repoService->getEntityManager()->flush();
            }elseif(key_exists("name", $data)){
                $problem = new Problem();
                $problem->setName($data["name"]);
                $this->repoService->getEntityManager()->persist($problem);

            }
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    private function decodeProza($json):bool
    {

            $data = json_decode($json, true);
            $query = null;
            switch ($data["type"]){
                case "quote":
                    $query = "cytat";
                    break;
                case "omnie":
                    $query = "omnie";
                    break;
                case "home":
                    $query = "proza 1";
                    break;
                case "trichoskopia":
                    $query = "trichoskopia";
                    break;
            }
            if(!$query){
                return false;
            }
            $old = $this->repoService->getProzaRepo()->findOneBy(["name" => $query]);
            $old->setTresc($data["value"]);
            $this->repoService->getEntityManager()->flush();
        return true;
    }

    public function getMessages(): array
    {
        return $this->repoService->getMessageRepo()->findAll();
    }

    public function getZdjecia(): array
    {
        return $this->repoService->getImageRepo()->findAll();
    }

    public function getKontakt()
    {
        return $this->repoService->getKontaktRepo()->findAll()[0];
    }

    public function getSlideshow()
    {
        $slideshow =  $this->repoService->getSlideshowRepo()->findAll()[0];
        $slides = array();
        $imagesFromSlideshow = $slideshow->getImages()->getValues();
        for ($i = 0; $i<sizeof($imagesFromSlideshow); $i++) {
            $slides[] =  $imagesFromSlideshow[$i]->getId();
        }
        $description = $slideshow->getDescription();
        $images = $this->repoService->getImageRepo()->findAll();
        $readyObject = ["description" => $description,
            "slides" => $slides];
        return ["slideshow" => $readyObject,
            "images" => $images];
    }

    public function getAllZabiegs()
    {
        $zabiegs = $this->repoService->getZabiegRepo()->findAll();
        $listOfDTO = array();
        for($i = 0; $i<sizeof($zabiegs);$i++){
            $zab = $zabiegs[$i];
            $listOfDTO[] = ["urlPath" => $zab->getUrlPath(),
                "name" => $zab->getName()];
        }
        return $listOfDTO;
    }
}