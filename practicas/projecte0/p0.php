<?php
class Llibre {

public string $titol ;
public string $autor ;
public int $anypublicacio ;
public string $foto ; 

public function __construct( string $titol= " sin titulo ", string $autor= " sin autor ", int $anypublicacio= 0, string $foto=" sin foto ") {
    $this->titol = $titol;
    $this->autor = $autor;
    $this->anypublicacio = $anypublicacio;
    $this->foto = $foto;

}

public function descripcio(): string {
    return "El libro " . $this->titol . " publicador en " . $this->anypublicacio . " es del autor " . $this->autor . "." ;
}


public function mostrarFoto() {
    if ($this->foto != "sin foto") {
        return "<img src='" . $this->foto . "' alt='Imagen del libro' style='width:200px;'>";
    } else {
        return "No hay imagen disponible.";
    }
}

}

$llibre1 = new Llibre(); 
 

$llibre2 = new Llibre("'El gran Gatsby'", "Platón", 1925, "https://upload.wikimedia.org/wikipedia/commons/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg" ); 

class Biblioteca {
    public array $llibres = [];

    public function afegirLlibre(Llibre $llibre) {
        $this->llibres[] = $llibre;
    }

    public function mostrarLlibres() {
        if (count($this->llibres) === 0) {
            return "No hi ha llibres a la biblioteca.";
        }

        $llistesLlibres = "";
        foreach ($this->llibres as $llibre) {
            $llistesLlibres .= $llibre->descripcio() . "<br>";
        }
        return $llistesLlibres;
    }

    public function cercarLlibrePelTitol(string $cerca) {
        $resultats = [];

        foreach ($this->llibres as $llibre) {
            // stripos fa la cerca de manera insensible a majúscules i minúscules
            if (stripos($llibre->titol, $cerca) !== false) {
                $resultats[] = $llibre->descripcio();
            }
        }

        if (empty($resultats)) {
            return "No s'ha trobat cap llibre amb aquest títol.";
        } else {
            return implode("<br>", $resultats);
        }
    }
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $anypublicacio = (int)$_POST['anypublicacio'];

    $llibre4 = new Llibre ($titol, $autor, $anypublicacio);
 
} else {
    echo "Si us plau, ompliu el formulari.";
}

$biblioteca = new Biblioteca();

// Afegim llibres a la biblioteca
$b1 = new Llibre("'El gran Gatsby'", "F. Scott Fitzgerald", 1925, "https://upload.wikimedia.org/wikipedia/commons/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg");
$b2 = new Llibre("'Cien años de soledad'", "Gabriel García Márquez", 1967);
$b3 = new Llibre("'El alquimista'", "Paulo Coelho", 1988);

// Afegim llibres a la biblioteca
$biblioteca->afegirLlibre($b1);
$biblioteca->afegirLlibre($b2);
$biblioteca->afegirLlibre($b3);

// Mostrem tots els llibres de la biblioteca
echo "<h2>Llibres a la Biblioteca:</h2>";
echo $biblioteca->mostrarLlibres();

// Cercar un llibre pel títol
echo "<h2>Cerca per títol:</h2>";
echo $biblioteca->cercarLlibrePelTitol("gran");  // Cerca per "gran" (no necessita coincidència exacta)





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
    <h1>Libros</h1>
    <p><?echo $llibre1->descripcio();?></p>
    <?echo $llibre2->descripcio();?>
    <br>
    <?php echo $llibre2->mostrarFoto(); ?>
    

    
    <div style="background-color:rgb(156, 196, 241);">
    <h1>Afegir llibre</h1>
    <form method="POST" action="">
        <label for="titol">Títol:</label>
        <input type="text" name="titol" id="titol" required><br><br>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required><br><br>

        <label for="anypublicacio">Any publicació:</label>
        <input type="date" name="anypublicacio" id="anypublicacio" required><br><br>

        <label for="foto">Url imagen:</label>
        <input type="text" name="foto" id="foto"> <br><br>

        <input type="submit" value="Enviar">
    </form>
    <p><?echo $llibre4->descripcio(); ?></p>
    </div>
   
    <h1>Llista de llibres</h1>
    <table>
        <thead>
            <tr>
                <th>Títol</th>
                <th>Autor</th>
                <th>Any Publicació</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($biblioteca->llibres as $llibre): ?>
                <tr>
                    <td><?php echo $llibre->titol; ?></td>
                    <td><?php echo $llibre->autor; ?></td>
                    <td><?php echo $llibre->anypublicacio; ?></td>
                    <td><?php echo $llibre->mostrarFoto(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>