<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ForwardController extends AbstractController
{

    public function forwardToIndex(): Response{
        return $this->render("index.html");
    }

}