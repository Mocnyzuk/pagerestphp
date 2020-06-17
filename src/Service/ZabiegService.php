<?php


namespace App\Service;


class ZabiegService
{
    private $repoService;

    /**
     * ZabiegService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    public function getAllCategories():array{
        $zabiegs = $this->repoService->getZabiegRepo()->findAll();

        return array_keys($this->repoService->getZabiegRepo()->findAll());
    }

    public function getByCategory(string $category): array
    {
        return $this->repoService->getZabiegRepo()->findBy(["category"=>$category]);
    }
    public function getZabiegByName(string $name){
        return $this->repoService->getZabiegRepo()->createQueryBuilder("z")
            ->where("z.urlPath LIKE :name")
            ->setParameter("name", "%".$name."%")
            ->getQuery()
            ->getOneOrNullResult();
    }

}