<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\LoginService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LoginController extends AbstractController implements ApiController
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
        return $this->json(['result' => $this->getUser()]);
    }
    public function refresh(){

    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function user(){
        return $this->json([
            'user' => $this->getUser()
        ]);
    }
    public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request){
        return $this->loginService->register($request, $passwordEncoder);

    }
}