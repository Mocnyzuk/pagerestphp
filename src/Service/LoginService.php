<?php


namespace App\Service;


use App\Entity\Authority;
use App\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginService
{
    private $repoService;

    /**
     * LoginService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }
    public function login(){

    }
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $data = json_decode($request->getContent(), true);
        $email                  = $data["username"];
        $password               = $data["password"];
        $passwordConfirmation   = $data["repassword"];
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
            $user->setUsername($email);
            $user->setPassword($encodedPassword);
            $authority = new Authority();
            $authority->setAuthority("ROLE_USER");
            $authority->setUsername($user->getUsername());
            $user->addAuthority($authority);
            try
            {
                $em = $this->repoService->getEntityManager();
                $em->persist($user);
                $em->flush();
                return new JsonResponse([
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
        return new JsonResponse([
            'errors' => $errors
        ], 400);

    }
    public function logout(){

    }
    public function refresh(){

    }
}