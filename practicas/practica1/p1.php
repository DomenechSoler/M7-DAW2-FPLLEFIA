<?php
class Cotxe {

    public string $marca ;
    public string $model ;

    public function __construct( string $marca= "sin marca", string $model= "sin modelo") {
        $this->marca = $marca;
        $this->model = $model;
    }

    public function descripcio() {
        return "El cotxe és de la marca " . $this->marca . " i el model és " . $this->model . ".";
    }
}





$cotxe1 = new Cotxe(); 
 

$cotxe2 = new Cotxe("Ford", "Focus"); 
 


class Persona {

    public string $nom;
    public int $edat;

    public function __construct(string $nom, int $edat) {
        $this->nom = $nom;
        $this->edat = $edat;
    }

    public function benvinguda(): string {
        return "Benvingut/a, " . $this->nom . "! Tens " . $this->edat . " anys.";
    }
}

$persona1 = new Persona("Joan", 30);
$persona2 = new Persona("Pepe",66);
$persona3 = new Persona("Lucia", 40);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $edat = (int)$_POST['edat'];

    $persona4 = new Persona($nom, $edat);
 
} else {
    echo "Si us plau, ompliu el formulari.";
}



class Calculadora {
    public float $num1 = 0;
    public float $num2 = 0;

    public function __construct(float $num1, float $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }
    public function sumar(): float {
        return $this->num1 + $this->num2;
    }
}

$calculadora = new Calculadora(10, 5);

echo "El resultat de la suma és: " . $calculadora->sumar();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><h1>10 ejercicios practicos</h1>
<h4><?echo $persona1->benvinguda(); ?></h4>
    <p><?echo $cotxe1->descripcio();?></p>
    <?echo $cotxe2->descripcio();?>
    <h1>Introduïu el vostre nom i edat</h1>
    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom"><br><br>

        <label for="edat">Edat:</label>
        <input type="number" name="edat" id="edat"><br><br>

        <input type="submit" value="Enviar">
    </form>
    <p><?echo $persona4->benvinguda(); ?></p>
</body>
</html>