<?php


namespace App\Controller;


use App\Service\ProblemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProblemController extends AbstractController implements ApiController
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
        $problem = $this->problemService->getProblemByName($name);
        $webCode = 404;
        $body = null;
        if($problem){
            $webCode = 200;
            $body = ["problem" => $problem];
        }
        return $this->json($body, $webCode);

    }


}