<?php


namespace App\Controller;


use App\Entity\User;
use App\Migrations\FileReader;
use App\Service\HomeAndRootService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RootController extends AbstractController
{
    public function initDB(){
        $object = new FileReader();
        $array = $object->getDataForDB();
        $imageArray = $array["images"];
        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i<sizeof($imageArray); $i++){
            $em->persist($imageArray[$i]);
        }
        $problemArray = $array["problems"];
        $zabiegArray = $array["zabiegs"];
        $uslugArray = $array["uslugs"];
        $openHours = $array["openHours"];
        for ($i = 0; $i<sizeof($openHours); $i++){
            $em->persist($openHours[$i]);
        }
        $kontakt = $array["kontakt"];
        $em->persist($kontakt);
        $slideshow = $array["slideshow"];
        $em->persist($slideshow);
        $navbarHref = $array["navBarHref"];
        for ($i = 0; $i<sizeof($navbarHref); $i++){
            $em->persist($navbarHref[$i]);
        }
        for ($i = 0; $i<sizeof($problemArray); $i++){
            $em->persist($problemArray[$i]);
        }
        for ($i = 0; $i<sizeof($zabiegArray); $i++){
            $em->persist($zabiegArray[$i]);
        }
        for ($i = 0; $i<sizeof($uslugArray); $i++){
            $em->persist($uslugArray[$i]);
        }
        $prozas = $array["prozas"];
        for ($i = 0; $i<sizeof($prozas); $i++){
            $em->persist($prozas[$i]);
        }
        $authorities = $array["authority"];
        for ($i = 0; $i<sizeof($authorities); $i++){
            $em->persist($authorities[$i]);
        }
        $users = $array["users"];
        for ($i = 0; $i<sizeof($users); $i++){
            $em->persist($users[$i]);
        }
        $em->flush();
        return $this->json($this->getDoctrine()->getRepository(User::class)->findOneBy(["username"=>"fpmoles@fpmoles.pl"]));
    }
    public function home(HomeAndRootService $service){
        return $this->json($service->getRootPage());
    }
    public function index(){
        return $this->render("index.html");
    }
}