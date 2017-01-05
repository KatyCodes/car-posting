<?php

class Car
{
    public $make_model;
    public $price;
    public $miles;
    public $image;
    function __construct($make_model, $price, $miles, $image)
    {
        $this->make_model = $make_model;
        $this->price = $price;
        $this->miles = $miles;
        $this->image = $image;
    }
    function setPrice($new_price)
    {
        $float_price =(float) $new_price;
        if($float_price != 0){
            $formatted_price = number_format($float_price, 2);
            $this->price = $formatted_price;
        }
    }
    function getPrice()
    {
        return $this->price;

    }
    function setModel($new_model)
    {
        if($new_model){
            $this->make_model = $new_model;
        }

    }
    function getModel()
    {
        return $this->make_model;

    }
    function setMiles($new_miles)
    {
        if($new_miles){
            $this->miles = $new_miles;
        }
    }
    function getMiles()
    {
        return $this->miles;

    }
    function save()
    {
      array_push($_SESSION["allCars"], $this);
    }
    static function getAll()
    {
        return $_SESSION['allCars'];
    }
    static function deleteAll()
    {
        $_SESSION['allCars'] = array();
    }
}


?>
