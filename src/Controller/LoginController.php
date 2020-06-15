<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\LoginService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request){
        $user = new User();
        $email                  = $request->request->get("odp");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("repassword");
        return $this->json([
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation
        ]);
    }
}