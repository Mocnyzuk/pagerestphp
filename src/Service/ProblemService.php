<?php


namespace App\Service;


class ProblemService
{

    private $repoService;

    /**
     * ProblemService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function getProblemByName(string $name){
        return $this->repoService->getProblemRepo()->createQueryBuilder("p")
            ->where("p.urlPath LIKE :name")
            ->setParameter("name", "%".$name."%")
            ->getQuery()
            ->getOneOrNullResult();
    }


}