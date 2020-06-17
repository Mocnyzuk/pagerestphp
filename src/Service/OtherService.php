<?php


namespace App\Service;


use App\Entity\Kontakt;
use App\Entity\Sender;
use App\Service\HomeAndRootService;
use App\Service\RepoService;
use App\Entity\Message;
use Exception;

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

    public function handleMessage($json):bool
    {
        $em = $this->repoService->getEntityManager();
        $data = json_decode($json, true);
        if(!$data["rights"]){
            return false;
        }
        $sender = $this->repoService
            ->getSenderRepo()
            ->findOneBy(["email" => $data["email"]]);
        $message = new Message();
        if (!$sender) {
            $new = new Sender();
            $new->setEmail($data["email"]);
            $new->setPhone($data["phone"]);
            $new->setFullName($data["fullName"]);
            $message->setSender($new);
            $em->persist($new);
        } else {
            $message->setSender($sender);
        }
        $message->setMessage($data["message"]);
        $message->setAnswered(false);
        $em->persist($message);
        $em->flush();

    return true;
    }

    public function getUslugsCategories():array
    {
        $uslugs = $this->repoService->getUslugaRepo()->findAll();
        $result = array();
        foreach ($uslugs as $usl){
            $result[] = $usl->getCategory();
        }
        return array_values(array_unique($result));
    }

}