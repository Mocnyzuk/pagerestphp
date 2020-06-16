<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;

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
        $file = $request->getContent();
        return $file;
    }

}