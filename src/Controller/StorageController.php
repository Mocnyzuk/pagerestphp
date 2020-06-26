<?php


namespace App\Controller;


use App\Service\StorageService;
use Liip\ImagineBundle\Binary\BinaryInterface;
use Liip\ImagineBundle\Binary\Loader\FileSystemLoader;
use Liip\ImagineBundle\Binary\Loader\LoaderInterface;
use Liip\ImagineBundle\Controller\ImagineController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;

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
    public function getFile($dirname, $filename, Request $request){
        $url = $dirname."/".$filename;
        $binaryFileResponse = $this->storageService->getFile($url);
        $binaryFileResponse->setEtag(md5($binaryFileResponse->getContent()));
        $binaryFileResponse->setPublic();
        $binaryFileResponse->setMaxAge(300);
        $binaryFileResponse->headers->addCacheControlDirective("must-revalidate", true);
        $binaryFileResponse->headers->addCacheControlDirective("no-transform", true);
//        $binaryFileResponse->headers->set("Vary", "Origin");
//        $binaryFileResponse->headers->set("Vary", "Access-Control-Request-Method");
//        $binaryFileResponse->headers->set("Vary", "Access-Control-Request-Headers");
        $binaryFileResponse->isNotModified($request);
        return $binaryFileResponse;
    }
}