<?php
class Cotxe {
    // Atributos
    private $marca;
    private $model;

    // Contructor para inicalizar los atributos con valores por defecto
    public function __construct($marca = "Desconeguda", $model = "Desconegut") {
        $this->marca = $marca;
        $this->model = $model;
    }

    // metodo para obtener la descripcion del coche
    public function descripcio() {
        return "El cotxe és de la marca " . $this->marca . " i el model és " . $this->model . ".";
    }
}




// Ejemplos
$cotxe1 = new Cotxe(); 
echo $cotxe1->descripcio(); 

$cotxe2 = new Cotxe("Ford", "Focus"); 
echo $cotxe2->descripcio(); 


class Persona {
    // Atributos
    private $nom;
    private $edat;

    // Constructor que inicializa los atributos
    public function __construct(string $nom, int $edat) {
        $this->nom = $nom;
        $this->edat = $edat;
    }

    // metodo para mostrar un mensaje de bienvenida
    public function benvinguda(): string {
        return "Benvingut/a, " . $this->nom . "! Tens " . $this->edat . " anys.";
    }
}

// Ejemplo
$persona1 = new Persona("Joan", 30); // Crea un objeto de la clase Persona
echo $persona1->benvinguda(); 



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><h1>holas</h1>
    
</body>
</html>