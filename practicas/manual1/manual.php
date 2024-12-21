<?php

class Llibre {
    public string $titol = "Sin titulo";
    public string $autor = "Sin autor";


    public function __construct(string $titol, string $autor)
    {
        $this->titol = $titol;
        $this->autor = $autor;
    }

    public function descripcio(): string{
        return "El libro " . $this->titol . " es del autor " . $this->autor . "."; 
    }


    public function getAutor(): string{
        return $this->autor;
    }
}

class Persona {
    public string $nom = "sin nombre";
    public int $edad = 0;


    public function __construct(string $nom, int $edad)
    {
        $this->nom = $nom;
        $this->edad = $edad;
    }

    public function saludar(){
        return "Hola, sóc " . $this->nom . " i tinc " . $this->edad . " anys.";
    }

}



$persona = new Persona("Anna", 25);

$llibre = new Llibre("'La república'","Platón");







?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Descripcion del Libro</h1>
    <p><?php echo $llibre->descripcio(); ?></p>
    <p><?php echo $llibre->getAutor(); ?></p>
    <p><?php echo $persona->saludar(); ?></p>
</body>
</html>