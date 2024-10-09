<?php
require_once ('userService.php');
class usersController
{
    protected $clothService;
    function __construct($userService)
    {
        $this->clothService = $userService;
    }
    // Получить все
    public function getAll()
    {
        $response = $this->clothService->getAll();
        return $response;
    }
    // Получить один
    public function getOne($userId)
    {
        $response = $this->clothService->getOne($userId);
        return $response;
    }
    // Добавить один
    public function addOne($login, $pass, $name, $role, $phone, $email)
    {
        $response = $this->clothService->addOne($login, $pass, $name, $role, $phone, $email);
        return $response;
    }
    // Обновить один
    public function updateOne($userId, $login, $pass, $name, $role, $phone, $email)
    {
        $response = $this->clothService->updateOne($userId, $login, $pass, $name, $role, $phone, $email);
        return $response;
    }
    // Удалить один
    public function deleteOne($id)
    {
        $response = $this->clothService->deleteOne($id);
        return $response;
    }
}

$usersController = new usersController($usersService);