<?php


namespace App\Controller;


use App\Service\StorageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StorageController extends AbstractController implements ApiController
{
    private $storageService;

    /**
     * StorageController constructor.
     * @param $storageService
     */
    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function getFile(){

    }
    public function postFile(string $dirname, ParamFe){
    return $this->json($request);
    }
}