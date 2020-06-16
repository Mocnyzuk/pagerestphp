<?php


namespace App\Controller;


use App\Service\HomeAndRootService;

class HomeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController implements ApiController
{

    public function home(HomeAndRootService $service){

        return $this->json($service->getHomePage());
    }
}