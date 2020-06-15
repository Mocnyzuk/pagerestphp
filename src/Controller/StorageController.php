<?php


namespace App\Controller;


use App\Service\StorageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function postFile(){

    }
}