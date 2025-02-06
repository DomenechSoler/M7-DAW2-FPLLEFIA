<?php
class Usuario {
    public $nombre;
    public $email;

    public function __construct($nombre, $email) {
        $this->nombre = $nombre;
        $this->email = $email;
    }
}


?>