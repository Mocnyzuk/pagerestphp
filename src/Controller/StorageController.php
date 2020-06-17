<?php


namespace App\Controller;


use App\Service\StorageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class StorageController extends AbstractController
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

    public function postFile(string $dirname, Request $request){
        return $this->json($this->storageService->handlePostFile($dirname, $request));
    }
}