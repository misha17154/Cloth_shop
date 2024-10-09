<?php
require_once ('ordersService.php');
class ordersController
{
    protected $ordersService;
    function __construct($ordersService)
    {
        $this->ordersService = $ordersService;
    }
    // Получить все
    public function getAll()
    {
        $response = $this->ordersService->getAll();
        return $response;
    }
    // Получить один
    public function getOne($userId)
    {
        $response = $this->ordersService->getOne($userId);
        return $response;
    }
    // Добавить один
    public function addOne($userId, $cloth, $adress, $payOffline)
    {
        // cloth - это массив с одеждой из корзины
        $response = $this->ordersService->addOne($userId, $cloth, $adress, $payOffline);
        return $response;
    }
    // Обновить один
    public function updateOne($orderId)
    {
        $response = $this->ordersService->updateOne($orderId);
        return $response;
    }
    // Удалить один
    public function deleteOne($orderId)
    {
        $response = $this->ordersService->deleteOne($orderId);
        return $response;
    }
}

$ordersController = new ordersController($ordersService);