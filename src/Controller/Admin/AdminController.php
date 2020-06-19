<?php


namespace App\Controller\Admin;


use App\Controller\ApiController;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController implements ApiController, AdminChecker
{
    private $adminService;

    /**
     * AdminController constructor.
     * @param $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAdmin(){
        return $this->json(["images" => $this->adminService->getZdjecia()]);
    }
    public function getKontakt(){
        return $this->json($this->adminService->getKontakt());
    }
    public function getSlideshow(){
        return $this->json($this->adminService->getSlideshow());
    }
    public function getZabieg(){
        return $this->json($this->adminService->getAllZabiegs());
    }

    public function postCennik(Request $request){
        return $this->json(null, $this->adminService->handlePostCennik($request));
    }
    public function postKontakt(Request $request){
        return $this->json(null, $this->adminService->handlePostKontakt($request));
    }
    public function postSlideshow(Request $request){
        if($this->adminService->handlePostSlideshow($request)){
            return $this->json(null, 201);
        }
        return $this->json(null, 400);
    }
    public function postProblem(Request $request){
        if($this->adminService->handlePostProblem($request)){
            return $this->json(null, 201);
        }
        return $this->json(null, 400);
    }
    public function postProza(Request $request){
        if($this->adminService->handlePostProza($request)){
            return $this->json(null, 201);
        }
        return $this->json(null, 400);
    }
    public function postZabieg(Request $request){
        if($this->adminService->handlePostZabieg($request)){
            return $this->json(null, 201);
        }
        return $this->json(null, 400);
    }
    public function getMessages(){
        return $this->json($this->adminService->getMessages());
    }
}