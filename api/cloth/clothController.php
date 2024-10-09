<?php
require_once ('clothService.php');
class clothController
{
    protected $clothService;
    function __construct($clothService)
    {
        $this->clothService = $clothService;
    }
    // Получить все
    public function getAll()
    {
        $response = $this->clothService->getAll();
        return $response;
    }
    // Получить один
    public function getOne($clothId)
    {
        $response = $this->clothService->getOne($clothId);
        return $response;
    }
    // Добавить один
    public function addOne($type, $size, $color, $brand, $header, $description, $cost, $imgSrc)
    {
        $response = $this->clothService->addOne($type, $size, $color, $brand, $header, $description, $cost, $imgSrc);
        return $response;
    }
    // Обновить один
    public function updateOne($clothId, $type, $size, $color, $brand, $header, $description, $cost)
    {
        $response = $this->clothService->updateOne($clothId, $type, $size, $color, $brand, $header, $description, $cost);
        return $response;
    }
    // Удалить один
    public function deleteOne($id)
    {
        $response = $this->clothService->deleteOne($id);
        return $response;
    }
}

$clothController = new clothController($clothService);