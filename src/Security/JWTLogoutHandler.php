<?php


namespace App\Security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class JWTLogoutHandler
{
    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $event){
        $response = new JsonResponse(null);
        $response->headers->clearCookie("jwt");
        $event->setResponse($response);
    }

}