<?php


namespace App\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public function onException(ExceptionEvent $event){
        $e = $event->getThrowable();
        if(!$e instanceof AccessDeniedHttpException){
            return;
        }
        $responseData = [ "error" => $e->getMessage()];
        $response = new JsonResponse($responseData);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
       return [
           KernelEvents::EXCEPTION => "onException"
       ];
    }

}