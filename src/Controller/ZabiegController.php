<?php


namespace App\Controller;


use App\Service\ZabiegService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZabiegController extends AbstractController implements ApiController
{
    private $zabiegService;

    /**
     * ZabiegController constructor.
     * @param $zabiegService
     */
    public function __construct(ZabiegService $zabiegService)
    {
        $this->zabiegService = $zabiegService;
    }
    public function showAllCategories(){
        return $this->json($this->zabiegService->getAllCategories());
    }
    public function showByCategory(string $category){
        return $this->json($this->zabiegService->getByCategory($category));
    }
    public function showByName(string $category, string $name){
        return $this->json(["zabieg" => $this->zabiegService->getZabiegByName($name)]);
    }


}