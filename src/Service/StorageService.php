<?php


namespace App\Service;


use App\Entity\Image;
use App\Migrations\FileReader;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class StorageService
{
    private $repoService;

    /**
     * StorageService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function handlePostFile(string $dirname, Request $request)
    {
        $file = $request->files->all();
        if(!$file){
            return $file;
        }else{
            $em = $this->repoService->getEntityManager();
            foreach ($file as $f){
                if ($f instanceof UploadedFile){
                    $originalFilename = pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = FileReader::generateUrlPath($originalFilename);
                    $newFilename = $safeFilename.'.'.$f->guessExtension();
                    try {
                        $f->move(
                            $_SERVER['DOCUMENT_ROOT'] . "/../files/".$dirname,
                            $newFilename
                        );
                        if($dirname === "zdjecia"){
                            $image = new Image($safeFilename, "/files/zdjecia/".$newFilename);
                            $em->persist($image);
                        }
                    } catch (FileException $e) {
                        return false;
                    }
                }
            }
            $em->flush();
        }
        return true;
    }

    public function getFile(string $path) : BinaryFileResponse
    {
        $url = $_SERVER['DOCUMENT_ROOT'] . '/../files/'.$path;
        return new BinaryFileResponse($url);
    }

}