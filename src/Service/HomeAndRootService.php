<?php


namespace App\Service;



class HomeAndRootService
{

    private $repoService;

    /**
     * HomeAndRootService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function getRootPage() :array {
        $logo = $this->repoService->getImageRepo()->findOneBy(["name"=>"transparentLogoSmall"]);
        $kontakt = $this->repoService->getKontaktRepo()->findAll()[0];
        $kontaktDTO = ["email"=>$kontakt->getEmail(),
            "phone"=>$kontakt->getPhone()];
        $navBar = $this->repoService->getNavBarHrefRepo()->findAll();
        $problemLights = $this->getProblemLight();
        $zabiegMap = $this->getMapByCategoryZabiegOrUslugs($this->repoService->getZabiegRepo()->findAll());
        return ["logo"=>$logo,
            "kontakt"=>$kontaktDTO,
            "navBarHref"=>$navBar,
            "problems"=>$problemLights,
            "trychologyMenu"=>$zabiegMap];
    }
    public function getHomePage() :array{
        $banner = $this->getBanner();
        $prozasInString = $this->repoService->getProzaRepo()->findOneBy(["name"=>"proza 1"]);
        $slideshow = $this->repoService->getSlideshowRepo()->findAll()[0];
        $slideshowLight = ["imageSrc"=>$slideshow->getImages(),
            "opis"=>$slideshow->getDescription()];
        return ["banner"=>$banner,
            "problems"=>$this->getProblemLight(),
            "slideshow"=>$slideshowLight,
            "prozas"=>$prozasInString];
    }
    private function getProblemLight():array{
        $problems = $this->repoService->getProblemRepo()->findAll();
        $problemLights = array();
        for($i=0;$i<sizeof($problems);$i++){
            $problem = $problems[$i];
            $problemLights[] = ["urlPath"=>$problem->getUrlPath(),
                "path"=>$problem->getImage()->getPath(),
                "name"=>$problem->getName()];
        }
        return $problemLights;
    }
    public function getMapByCategoryZabiegOrUslugs($array): array{
        $zabiegs = $array;
        $zabiegTrych = array();
        $zabiegApar = array();
        $zabiegInny = array();
        for ($i = 0; $i<sizeof($zabiegs);$i++){
            $zab = $zabiegs[$i];
            if($zab->getCategory() === "trychologiczny"){
                $zabiegTrych[] = $zab;
            }elseif($zab->getCategory() === "trychologiczny-aparaturowy"){
                $zabiegApar[] = $zab;
            }else{
                $zabiegInny[] = $zab;
            }
        }
        return ["Trychologiczny"=>$zabiegTrych,
            "Trychologiczno-aparaturowy"=>$zabiegApar,
            "Diagnostyczny"=>$zabiegInny];
    }
    public function getBanner() :array{
        $image = $this->repoService->getImageRepo()->findOneBy(["name"=>"pierwsza strona"]);
        $tresc = $this->repoService->getProzaRepo()->findOneBy(["name"=>"cytat"]);
        $banner = array();
        $banner[] = $image->getName();
        $banner[] = $image->getPath();
        $banner[] = $tresc->getTresc();
        return $banner;
    }

}