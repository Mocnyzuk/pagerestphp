<?php


namespace App\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JWTLogoutHandler implements EventSubscriberInterface
{

    public function onLogoutSuccess()
    {
        $response = new JsonResponse(['result' => true]);
        $response->headers->clearCookie("jwt");
        $response->headers->add(["jacek" => 'dupa']);
        return $response;
    }

    public static function getSubscribedEvents()
    {
        return[
            "security.event_dispatcher.main" => 'onLogoutSuccess'
        ];
    }

}