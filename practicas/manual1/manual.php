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

    public function saludar(): string{
        return "Hola, sóc " . $this->nom . " i tinc " . $this->edad . " anys.";
    }

}


class Producte {
    public string $nom = "Sense nom";
    public float $preu = 0;

    public function __construct(string $nom, float $preu)
    {
        $this->nom = $nom;
        $this->preu = $preu;
    }
     public function mostrarPreu(): string{
        return "El preu de la " . $this->nom . " es de " . $this->preu . "€.";
     }

}

$productes = [
    $producte = new Producte("guitarra", 60),
    $producte = new Producte("teclat", 20),
    $producte = new Producte("pilota", 30),
    $producte = new Producte("altaveu", 50),
    $producte = new Producte("taula", 15),
];


// Comprovar si el formulari s'ha enviat
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'] ?? '';
    $edad = $_POST['edad'] ?? 0;

    // Validació bàsica de les dades
    if (!empty($nom) && is_numeric($edad)) {
        $persona = new Persona($nom, (int)$edad);
    } else {
        echo "Introdueix dades vàlides.";
    }
}

class Calculadora{
    public float $num1;
    public float $num2;

    public function __construct(float $num1, float $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function sumar(): string{
      return $this->num1 + $this->num2;
    }
    public function restar(): float{
       return $this->num1 - $this->num2;
    }
    public function multiplicar(): float{
        return $this->num1 * $this->num2;
     }
     public function dividir(): float{
        return $this->num1 / $this->num2;
     }
}




class Animal {
    public string $nom;
    public string $tipus;

    public function __construct(string $nom, string $tipus) {
        $this->nom = $nom;
        $this->tipus = $tipus;
    }

    public function descriure(): string {
        return "L'animal es diu " . $this->nom . " i és un " . $this->tipus . ".";
    }
}

$animalDescripcio = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $tipus = $_POST['tipus'] ?? '';
    
    if (!empty($nom) && !empty($tipus)) {
        $animal = new Animal($nom, $tipus);
        $animalDescripcio = $animal->descriure();
    } else {
        $animalDescripcio = "Si us plau, omple tots els camps.";
    }
}







$persona = new Persona("Anna", 25);

$llibre = new Llibre("'La república'","Platón");

$calculadora = new Calculadora(10,5);

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Descripcion del Libro</h1>
    <p><?php echo $llibre->descripcio(); ?></p>
    <p><?php echo $llibre->getAutor(); ?></p>

    <form method="post" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>
        <label for="edad">Edat:</label>
        <input type="number" id="edad" name="edad" required>
        <br><br>
        <button type="submit">Enviar</button>
    </form>

    <?php if ($persona): ?>
        <h2>Resultat:</h2>
        <p><?php echo $persona->saludar(); ?></p>
    <?php endif; ?>

    <p><?php echo $producte->mostrarPreu()?></p>
    <p><?echo "suma de 10+5= " . $calculadora->sumar()?></p>
    <p><?echo "resta de 10+5= " . $calculadora->restar()?></p>
    <p><?echo "producto de 10*5= " . $calculadora->multiplicar()?></p>
    <p><?echo "cociente de 10*5= " . $calculadora->dividir()?></p>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Preu</th>
            </tr>
        </thead>

        <?php foreach ($productes as $producte): ?>

        <tbody>
            <tr>
                <td><?php echo $producte->nom; ?></td>
                <td><?php echo $producte->preu; ?></td>
            </tr>
        </tbody>        
        
        <?php endforeach; ?>
    </table>
    

    <div>
        <h1>Descripció d'un Animal</h1>
        <form method="POST" action="">
            <input type="text" name="nom" placeholder="Nom de l'animal">
            <input type="text" name="tipus" placeholder="Tipus de l'animal">
            <button type="submit">Envia</button>
        </form>
        <div>
            <?php if (!empty($animalDescripcio)): ?>
                <p><?php echo $animalDescripcio; ?></p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>