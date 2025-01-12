<?php
session_start(); 

if (!isset($_SESSION['biblioteca'])) { // Comprueba que la session biblioteca no esta iniciada
    $biblioteca = new Biblioteca(); //si no existe la crea
} else {
   
    if (is_string($_SESSION['biblioteca'])) { // Verifica si es string antes de deserializar
        $biblioteca = unserialize($_SESSION['biblioteca']); //lo deserializa
    } else {
        $biblioteca = new Biblioteca(); 
    }
}

class Llibre {
    public string $titol;
    public string $autor;
    public int $anypublicacio;
    public string $foto;

    public function __construct(string $titol = "Sin título", string $autor = "Sin autor", int $anypublicacio = 0, string $foto = "Sin foto") {
        $this->titol = $titol;
        $this->autor = $autor;
        $this->anypublicacio = $anypublicacio;
        $this->foto = $foto;
    }

    public function descripcio(): string {
        return "El libro " . $this->titol . ", publicado en " . $this->anypublicacio . ", es del autor " . $this->autor . ".";
    }

    public function mostrarFoto(): string {
        if ($this->foto != "Sin foto") {
            return "<img src='" . $this->foto . "' alt='Imagen del libro' style='width:100px;'>";
        } else {
            return "No hay imagen disponible.";
        }
    }
}

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

    public function cercarLlibres(string $criteri): array {
        $resultats = [];
        foreach ($this->llibres as $llibre) {
            if (stripos($llibre->titol, $criteri) !== false) {
                $resultats[] = $llibre;
            }
        }
        return $resultats;
    }
}



$criteri = $_GET['criteri'] ?? '';
$resultats = $criteri ? $biblioteca->cercarLlibres($criteri) : $biblioteca->llibres;



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titol'], $_POST['autor'], $_POST['anypublicacio'])) {
    $titol = $_POST['titol'];
    $autor = $_POST['autor'];
    $anypublicacio = (int)$_POST['anypublicacio'];
    $foto = $_POST['foto'] ?? "Sin foto";

    $nouLlibre = new Llibre($titol, $autor, $anypublicacio, $foto);

    $biblioteca->afegirLlibre($nouLlibre); 
    $_SESSION['biblioteca'] = serialize($biblioteca); 
}


if (isset($_GET['reiniciar'])) {
    unset($_SESSION['biblioteca']); 
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <style>
       

        img {
            max-width: 100px;
            height: auto;
        }

    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="border border-gray-200"> <!--añade un borde gris-->
        <h1 class="text-3xl font-bold">Llibres</h1> <!--define el tamaño del texto y que sea negrita-->
        <?php foreach ($biblioteca->llibres as $llibre): ?>
            <p><?php echo $llibre->descripcio(); ?></p>
        <?php endforeach; ?>
    </div>
    
    <div>
        <form method="GET" action="" class="bg-blue-200 p-5 w-1/2 mx-auto mt-5 rounded-lg"> <!--fondo azul claro, añade un padding, establece el ancho del formulario al 50% y lo centra y redondea -->
            <input class="w-full mb-3 p-2 border border-gray-300 rounded-md" type="text" name="criteri" placeholder="Buscar por título" value="<?php echo htmlspecialchars($criteri); ?>"> <!--hace que ocupe todo el ancho, borde gris y redondeado -->
            <div class="">
                <button class="w-full bg-blue-500 text-white p-4 rounded hover:bg-blue-600 transition duration-300" type="submit" value="Buscar">Buscar</button><!-- fondo boton zul mas oscuro cambia el color del texto a blanco añade padding y redondea y cambia a zul mas laro al pasar el raton por encima con una transicion --> 
            </div>
        </form>
    </div>

    
    <table class="table-auto border-collapse border border-gray-200 w-4/5 mx-auto mt-5"> <!--ajusta automaticamente el ancho de las columnas, borde gris claro y que colapsen en uno solo, hace que la tabla sea del 80% y la centra horizontal -->
    <thead>
        <tr class="bg-gray-200"> <!--fondo gris claro -->
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Título</th> <!--borde gris un poco mas oscuro padding vertical y horizontal texto a la izquierda texto pequeño, semi negrita y gris oscuro-->
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Autor</th>
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Año Publicación</th>
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($resultats) > 0): ?>
            <?php foreach ($resultats as $llibre): ?>
                <tr class="bg-gray-50"> <!--fondo gris claro -->
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->titol; ?></td> <!-- padding vertical y horizontal con borde gris -->
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->autor; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->anypublicacio; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->mostrarFoto(); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="py-3 px-4 text-center text-gray-600">No se encontraron libros con el criterio "<?php echo htmlspecialchars($criteri); ?>".</td> <!--paddings y texto centrado texto gris oscuro -->
            </tr>
        <?php endif; ?>
    </tbody>
</table>



    
    <div class="w-1/2 mx-auto mt-10 p-6 bg-blue-100 rounded-lg shadow-lg"> <!--redondeo grande y shombra tambien -->
    <h2 class="text-2xl font-bold mb-6 text-center">Afegir llibre</h2> <!--tamaño muy grande -->
    
    <form method="POST" action="" class="space-y-4"> <!--espacio vertical de 4 unidades -->
        <div>
            <label for="titol" class="block text-sm font-semibold text-gray-700">Títol:</label> <!--hace que la label ocupe todo el ancho -->
            <input type="text" name="titol" id="titol" required class="w-full p-3 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="autor" class="block text-sm font-semibold text-gray-700">Autor:</label>
            <input type="text" name="autor" id="autor" required class="w-full p-3 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="anypublicacio" class="block text-sm font-semibold text-gray-700">Any publicació:</label>
            <input type="number" name="anypublicacio" id="anypublicacio" required class="w-full p-3 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="foto" class="block text-sm font-semibold text-gray-700">Url imagen:</label>
            <input type="text" name="foto" id="foto" class="w-full p-3 border border-gray-300 rounded-md ">
        </div>
        <div class="mt-6 text-center">
            <input type="submit" value="Afegir llibre" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 focus:outline-none transition duration-300"><!--ocupe todo el ancho color de fondo verde que cuando pase por encima sea mas oscuro eliminar el borde y transicion -->
        </div>
    </form>

    <div class="mt-6 text-center">
        <button class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 focus:outline-none transition duration-300">
            <a href="?reiniciar=1" class="font-semibold">Reiniciar sessió</a>
        </button>
    </div>
</div>



    <h1 class="text-center text-3xl font-bold mt-6">Biblioteca</h1>
    <h2 class="text-center text-2xl font-bold">Llista de llibres</h2>
    <table class="table-auto border-collapse border border-gray-200 w-1/2 mx-auto mt-5">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Títol</th>
                <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Autor</th>
                <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Any Publicació</th>
                <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($biblioteca->llibres as $llibre): ?>
                <tr class="bg-gray-50 hover:bg-gray-100">
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->titol; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->autor; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->anypublicacio; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->mostrarFoto(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>
</html>
