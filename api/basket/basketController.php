<?php
require_once ('basketService.php');
class basketController
{
    protected $basketService;
    function __construct($basketService)
    {
        $this->basketService = $basketService;
    }
    // Получить все
    public function getAll()
    {
        $response = $this->basketService->getAll();
        return $response;
    }
    // Получить один
    public function getOne($userId)
    {
        $response = $this->basketService->getOne($userId);
        return $response;
    }
    // Добавить один
    public function addOne($basketId, $clothId, $count)
    {
        $response = $this->basketService->addOne($basketId, $clothId, $count);
        return $response;
    }
    // Обновить один
    public function updateOne($busketToClothId, $newCount)
    {
        $response = $this->basketService->updateOne($busketToClothId, $newCount);
        return $response;
    }
    // Удалить один
    public function deleteOne($userId, $clothId)
    {
        $response = $this->basketService->deleteOne($userId, $clothId);
        return $response;
    }
}

$basketController = new basketController($basketService);