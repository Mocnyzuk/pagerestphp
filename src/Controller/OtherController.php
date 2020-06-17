<?php


namespace App\Controller;


use App\Service\OtherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OtherController extends AbstractController implements ApiController
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

    public function getCategories(){
        return $this->json($this->otherService->getUslugsCategories());
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
    public function trichoskopia(){
        return new Response($this->otherService->getTrichoskopia());
    }
    public function postMessage(Request $request){
        $code = 201;
        if(!$this->otherService->handleMessage($request->getContent())){
            $code = 400;
        };
        return $this->json(null, $code);
    }

}