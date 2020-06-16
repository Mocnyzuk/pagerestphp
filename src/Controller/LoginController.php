<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\LoginService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->json(['result' => true]);
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
    public function logout(){

    }
    public function register(ObjectManager $om, UserPasswordEncoderInterface $passwordEncoder, Request $request){
        $user = new User();
        $email                  = $request->request->get("email");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("password_confirmation");
        $errors = [];
        if($password != $passwordConfirmation)
        {
            $errors[] = "Password does not match the password confirmation.";
        }
        if(strlen($password) < 6)
        {
            $errors[] = "Password should be at least 6 characters.";
        }
        if(!$errors)
        {
            $encodedPassword = $passwordEncoder->encodePassword($user, $password);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            try
            {
                $om->persist($user);
                $om->flush();
                return $this->json([
                    'user' => $user
                ]);
            }
            catch(UniqueConstraintViolationException $e)
            {
                $errors[] = "The email provided already has an account!";
            }
            catch(\Exception $e)
            {
                $errors[] = "Unable to save new user at this time.";
            }
        }
        return $this->json([
            'errors' => $errors
        ], 400);
    }
}