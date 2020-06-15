<?php


namespace App\Controller;


use App\Service\ProblemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProblemController extends AbstractController
{

    private $problemService;

    /**
     * ProblemController constructor.
     * @param $problemService
     */
    public function __construct(ProblemService $problemService)
    {
        $this->problemService = $problemService;
    }

    public function show(string $name){
        return $this->json($this->problemService->getProblemByName($name));
    }


}