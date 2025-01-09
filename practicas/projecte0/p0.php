<?php
session_start(); 

if (!isset($_SESSION['biblioteca'])) {
    $biblioteca = new Biblioteca(); 
} else {
    // Verifica si es string antes de des...
    if (is_string($_SESSION['biblioteca'])) {
        $biblioteca = unserialize($_SESSION['biblioteca']); 
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
    <div class="border border-gray-200">
        <h1 class="text-3xl font-bold">Llibres</h1>
        <?php foreach ($biblioteca->llibres as $llibre): ?>
            <p><?php echo $llibre->descripcio(); ?></p>
        <?php endforeach; ?>
    </div>
    
    <div>
        <form method="GET" action="" class="bg-blue-200 p-5 w-1/2 mx-auto mt-5 rounded-lg">
            <input class="w-full mb-3 p-2 border border-gray-300 rounded-md" type="text" name="criteri" placeholder="Buscar por título" value="<?php echo htmlspecialchars($criteri); ?>">
            <div class="">
                <button class="w-full bg-blue-500 text-white p-4 rounded hover:bg-blue-600 transition duration-300" type="submit" value="Buscar">Buscar</button>
            </div>
        </form>
    </div>

    
    <table class="table-auto border-collapse border border-gray-200 w-4/5 mx-auto mt-5">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Título</th>
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Autor</th>
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Año Publicación</th>
            <th class="border border-gray-400 py-3 px-4 text-left text-sm font-semibold text-gray-700">Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($resultats) > 0): ?>
            <?php foreach ($resultats as $llibre): ?>
                <tr class="bg-gray-50 hover:bg-gray-100">
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->titol; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->autor; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->anypublicacio; ?></td>
                    <td class="py-3 px-4 border border-gray-200"><?php echo $llibre->mostrarFoto(); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="py-3 px-4 text-center text-gray-600">No se encontraron libros con el criterio "<?php echo htmlspecialchars($criteri); ?>".</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>



    
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-blue-100 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Afegir llibre</h2>
    
    <form method="POST" action="" class="space-y-4">
        <div>
            <label for="titol" class="block text-sm font-semibold text-gray-700">Títol:</label>
            <input type="text" name="titol" id="titol" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="autor" class="block text-sm font-semibold text-gray-700">Autor:</label>
            <input type="text" name="autor" id="autor" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="anypublicacio" class="block text-sm font-semibold text-gray-700">Any publicació:</label>
            <input type="number" name="anypublicacio" id="anypublicacio" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="foto" class="block text-sm font-semibold text-gray-700">Url imagen:</label>
            <input type="text" name="foto" id="foto" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mt-6 text-center">
            <input type="submit" value="Afegir llibre" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300">
        </div>
    </form>

    <div class="mt-6 text-center">
        <button class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-300">
            <a href="?reiniciar=1" class="font-semibold">Reiniciar sessió</a>
        </button>
    </div>
</div>



    <h1 class="text-center text-3xl font-bold mt-6">Biblioteca</h1>
    <h2 class="text-center text-2xl font-bold">Llista de llibres</h2>
    <table class="table-auto border-collapse border border-gray-200 w-4/5 mx-auto mt-5">
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
