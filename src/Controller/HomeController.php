<?php


namespace App\Controller;


use App\Service\HomeAndRootService;

class HomeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function home(HomeAndRootService $service){

        return $this->json($service->getHomePage());
    }
}