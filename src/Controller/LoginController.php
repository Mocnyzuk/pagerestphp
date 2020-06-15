<?php


namespace App\Controller;


use App\Service\LoginService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    private $loginService;

    /**
     * LoginController constructor.
     * @param $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function login(){

    }
    public function refresh(){

    }
    public function logout(){

    }
    public function register(){

    }
}