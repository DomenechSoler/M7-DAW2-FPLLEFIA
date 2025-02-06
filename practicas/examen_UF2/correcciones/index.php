<?php

class Cotxe {
    public $marca;
    public $model;
    
    function __construct($marca, $model) {
        $this->marca = $marca;
        $this->model = $model;
    }

    function descripcio() {
        return "Aquest cotxe és un " . $this->marca . " " . $this->model;
    }
}
$cotxe = new Cotxe("Toyota", "Corolla");
echo $cotxe-> descripcio();






?>