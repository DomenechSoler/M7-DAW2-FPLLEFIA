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

class Animal {
    public string $nom;
    public string $tipus;

    public function __construct(string $nom = "sense nom", string $tipus = "sense tipus") {
        $this->nom = $nom;
        $this->tipus = $tipus;
    }

    public function saludar(): string {
        return "Hola, sóc un " . $this->tipus . " i em dic " . $this->nom . ".";
    }
}


$animal1 = new Animal("Luna", "gos");
$animal2 = new Animal("Michi", "gat");

echo $animal1->saludar(); 

echo $animal2->saludar(); 



class Producte {
    public string $nom;
    public float $preu;

    public function __construct(string $nom, float $preu) {
        $this->nom = $nom;
        $this->preu = $preu;
    }

    public function descripcio(): string {
        return $this->nom . " - " . number_format($this->preu, 2) . "€";
    }
}

$productes = [
    new Producte("Pa", 1.50),
    new Producte("Llet", 0.99),
    new Producte("Formatge", 2.99),
    new Producte("Cafè", 3.49)
];



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>10 ejercicios practicos</h1>
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
    <p><?echo $animal1->saludar(); ?></p>
    <p><?echo $animal2->saludar(); ?></p>
    <h1>Llista de productes</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Preu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productes as $producte): ?>
                <tr>
                    <td><?php echo $producte->nom; ?></td>
                    <td><?php echo number_format($producte->preu, 2); ?>€</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>