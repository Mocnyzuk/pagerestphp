<?php


namespace App\Subscriber;


use App\Controller\ApiController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class Bumcyfykszy implements EventSubscriberInterface
{

    public function checkTheHeader(ControllerEvent $event){
        $controller = $event->getController();
        if(is_array($controller) && $controller[0] instanceof ApiController){
            if($event->getRequest()->headers->get("bumcyfykszy") === null){
                throw new AccessDeniedHttpException("co to za kombinowanie");
            }
        }

    }

    public static function getSubscribedEvents()
    {
       return[
           KernelEvents::CONTROLLER => 'checkTheHeader'
       ];
    }


}