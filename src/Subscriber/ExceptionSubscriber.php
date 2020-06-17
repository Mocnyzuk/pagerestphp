<?php


namespace App\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public function onException(ExceptionEvent $event){
        //$event->setResponse(new RedirectResponse("/"));
        return;
    }

    public static function getSubscribedEvents()
    {
       return [
           KernelEvents::EXCEPTION => "onException"
       ];
    }

}