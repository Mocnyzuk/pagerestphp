<?php


namespace App\Controller;


use App\Service\StorageService;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;

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


    public function postFile(string $dirname, Request $request){
        return $this->json($this->storageService->handlePostFile($dirname, $request));
    }
    public function getFile($dirname, $filename, AdapterInterface $cache){
        $url = $dirname."/".$filename;
        $binaryFile = $this->storageService->getFile($url);
        $item = $cache->getItem(str_replace($url, "/", "_"));
        if(!$item->isHit()){
            $item->set($binaryFile);
            $cache->save($item);
        }
        return $item->get();
    }
}