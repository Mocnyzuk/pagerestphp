<?php


namespace App\Controller;


use App\Service\OtherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OtherController extends AbstractController
{

    private $otherService;

    /**
     * OtherController constructor.
     * @param $otherService
     */
    public function __construct(OtherService $otherService)
    {
        $this->otherService = $otherService;
    }

    public function cennik(){
        return $this->json($this->otherService->getCennikPage());
    }
    public function kontakt(){
        return $this->json($this->otherService->getKontaktPage());
    }
    public function preparaty(){
        return $this->json($this->otherService->getPreparaty());
    }
    public function omnie(){
        return $this->json($this->otherService->getOmnie());
    }

}