<?php


namespace App\Controller;


use App\Migrations\FileReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RootController extends AbstractController
{
    public function home(){
        $object = new FileReader();
        $imageArray = $object->getImages();
        $em = $this->getDoctrine()->getManager();
//        for ($i = 0; $i<sizeof($imageArray); $i++){
//            $em->persist($imageArray[$i]);
//        }
        //$em->flush();


        $problemArray = $object->getProblems($imageArray);

        for ($i = 0; $i<sizeof($problemArray); $i++){
            $em->persist($problemArray[$i]);
        }
        $em->flush();
        echo "jestem";
        return new Response(sizeof($problemArray));
    }
}