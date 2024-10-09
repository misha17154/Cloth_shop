<?php
require_once ('authService.php');
class authController
{
    protected $authService;
    function __construct($authService)
    {
        $this->authService = $authService;
    }
    // Получить все
    public function register($login, $name, $email, $phone, $password)
    {
        $response = $this->authService->register($login, $name, $email, $phone, $password);
        return $response;
    }
    // Получить один
    public function login($login, $password)
    {
        $response = $this->authService->login($login, $password);
        return $response;
    }
    
}

$authController = new authController($authService);