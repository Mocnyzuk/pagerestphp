<?php


namespace App\Service;


use App\Entity\Kontakt;
use App\Service\HomeAndRootService;
use App\Service\RepoService;

class OtherService
{
    private $repoService;
    private $homeAndRootService;

    /**
     * OtherService constructor.
     * @param RepoService $repoService
     * @param HomeAndRootService $homeService
     */
    public function __construct(RepoService $repoService,
                            HomeAndRootService $homeService)
    {
        $this->repoService = $repoService;
        $this->homeAndRootService = $homeService;
    }

    public function getCennikPage() : array{
        return ["cennik" => $this->homeAndRootService->
        getMapByCategoryZabiegOrUslugs($this->repoService->getUslugaRepo()->findAll())];
    }
    public function getKontaktPage(){
        return $this->repoService->getKontaktRepo()->findAll()[0];
    }
    public function getOmnie():array{
        $omnie = $this->repoService->getProzaRepo()->findOneBy(["name"=>"omnie"])->getTresc();
        $banner = $this->homeAndRootService->getBanner();
        return ["banner"=>$banner,
            "description"=>$omnie];
    }
    public function getPreparaty(): array{
        $images = $this->repoService->getImageRepo()->createQueryBuilder("i")
            ->where("i.name LIKE :name")
            ->setParameter("name", "%preparaty%")
            ->getQuery()
            ->getResult();
        return ["pictures"=>$images,
            "description"=>"jeszcze nic nie ma"];
    }

    public function getTrichoskopia()
    {
        return $this->repoService->getProzaRepo()->findOneBy(["name" => "trichoskopia"])->getTresc();
    }

}