<?php
class Cloth
{
    public $articul;
    public $type;
    public $size;
    public $color;
    public $brand;
    public $header;
    public $description;
    public $cost;

    function __construct($articul, $type, $size, $color, $brand, $header, $description, $cost)
    {
        $this->articul = $articul;
        $this->type = $type;
        $this->size = $size;
        $this->color = $color;
        $this->brand = $brand;
        $this->header = $header;
        $this->description = $description;
        $this->cost = $cost;
    }
}