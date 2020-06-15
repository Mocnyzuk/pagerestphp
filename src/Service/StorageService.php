<?php


namespace App\Service;


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

}