<?php


namespace App\Security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class JWTLogoutHandler implements LogoutSuccessHandlerInterface
{

    public function onLogoutSuccess(Request $request)
    {
        $response = new JsonResponse(['result' => true]);
        $response->headers->clearCookie("jwt");
        return $response;
    }
}