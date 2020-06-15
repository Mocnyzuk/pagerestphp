<?php


namespace App\Service;


class LoginService
{
    private $repoService;

    /**
     * LoginService constructor.
     * @param $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }
    public function login(){

    }
    public function refresh(){

    }
    public function logout(){

    }
    public function register(){

    }
}