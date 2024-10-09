<?php
class Order {
    public $id;
    public $username;
    public $adress;
    public $payOffline;
    public $completed;
    public $products = [];

    function __construct($id, $username, $adress, $payOffline, $completed, $products) {
        $this->id = $id;
        $this->username = $username;
        $this->adress = $adress;
        $this->payOffline = $payOffline;
        $this->completed = $completed;
        $this->products = $products;
    }
}