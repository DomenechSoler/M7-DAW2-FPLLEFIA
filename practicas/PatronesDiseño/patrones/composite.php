<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrón de Diseño Composite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container mt-5">
        <h1 class="mb-4">Composite</h1>
        <h2>¿Qué es?</h2>
        <p class="">El patrón Composite es un patrón de diseño estructural que permite tratar de manera uniforme a objetos individuales y a composiciones de objetos. Este patrón permite que los objetos se agrupen en estructuras jerárquicas de árbol, donde cada objeto (hoja o compuesto) puede ser tratado de la misma manera. Es útil cuando se tiene una colección de objetos que deben ser tratados de forma similar, pero algunos de esos objetos pueden ser compuestos de otros objetos.</p>
        
        <h2>¿Cómo Funciona?</h2>
        <p>El patrón Composite sigue la siguiente estructura:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Componente Común:</strong> Define una interfaz común para todos los objetos en la composición. Esta interfaz puede ser utilizada tanto por objetos simples como por composiciones complejas.</li>
            <li class="list-group-item"><strong>Hoja:</strong> Es una clase que implementa la interfaz del componente, representando un objeto individual que no tiene elementos hijos.</li>
            <li class="list-group-item"><strong>Composición:</strong> Es una clase que también implementa la interfaz del componente, pero que puede contener otros objetos (hojas o composiciones).</li>
            <li class="list-group-item"><strong>Cliente:</strong> Interactúa con los componentes (hojas o composiciones) a través de la interfaz común, sin necesidad de preocuparse si está tratando con un objeto individual o con una colección de objetos.</li>
        </ul>
        <p class="mt-4">El patrón Composite permite que un cliente manipule una jerarquía de objetos de manera coherente, ya que no hay distinción entre hojas y composiciones desde la perspectiva del cliente.</p>
        
        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/composite.png" alt="">
        </div>


        <h2>Implementación: Ejemplo</h2>
        <p>Imagina que estás construyendo una aplicación que gestiona una jerarquía de archivos y carpetas. Una carpeta puede contener archivos individuales y otras carpetas, lo que forma una estructura en árbol. En lugar de tratar los archivos y las carpetas de manera diferente, puedes usar el patrón Composite para tratarlos de manera uniforme.</p>
        
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// Componente común
interface FileSystemComponent {
    public function showDetails();
}

// Hoja: Representa un archivo
class File implements FileSystemComponent {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function showDetails() {
        return "Archivo: " . $this->name;
    }
}

// Composición: Representa una carpeta que puede contener otros archivos o carpetas
class Folder implements FileSystemComponent {
    private $name;
    private $children = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function add(FileSystemComponent $component) {
        $this->children[] = $component;
    }

    public function showDetails() {
        $details = "Carpeta: " . $this->name . "\n";
        foreach ($this->children as $child) {
            $details .= $child->showDetails() . "\n";
        }
        return $details;
    }
}

// Cliente
$rootFolder = new Folder("Raíz");
$documentsFolder = new Folder("Documentos");
$photosFolder = new Folder("Fotos");

$file1 = new File("documento1.txt");
$file2 = new File("documento2.txt");
$file3 = new File("foto1.jpg");

$documentsFolder->add($file1);
$documentsFolder->add($file2);
$photosFolder->add($file3);

$rootFolder->add($documentsFolder);
$rootFolder->add($photosFolder);

echo $rootFolder->showDetails();
            </code></pre>
        </div>
        <p>En este ejemplo, tanto los archivos como las carpetas implementan la misma interfaz FileSystemComponent. Esto permite al cliente interactuar con ellos de manera uniforme. Al llamar a <code>showDetails()</code> en el objeto raíz, obtienes los detalles de todos los archivos y carpetas contenidos dentro de ella, sin preocuparte de si son archivos individuales o carpetas.</p>
        
        <h2>Ventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Uniformidad: Permite tratar de manera uniforme tanto objetos individuales como composiciones complejas, simplificando el código cliente.</li>
            <li class="list-group-item">Extensibilidad: Puedes agregar nuevas clases de componentes (hojas o composiciones) sin modificar las existentes, lo que facilita la extensión del sistema.</li>
            <li class="list-group-item">Jerarquías complejas: Permite construir estructuras jerárquicas de objetos, como árboles de directorios o menús, de manera sencilla.</li>
            <li class="list-group-item">Flexibilidad: Los objetos compuestos pueden contener tanto objetos simples como otros objetos compuestos, proporcionando una gran flexibilidad para modelar relaciones jerárquicas.</li>
        </ul>
        
        <h2>Desventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Complejidad: Puede ser más difícil de entender y de implementar, especialmente si la jerarquía de objetos es muy compleja.</li>
            <li class="list-group-item">Sobrecarga: Si no se necesita una jerarquía compleja, utilizar este patrón puede ser innecesario y agregar una sobrecarga de diseño y rendimiento.</li>
            <li class="list-group-item">Dificultad en la modificación: Si se introducen cambios en la jerarquía o en la forma de interactuar con los objetos, puede ser necesario modificar muchas clases.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El patrón Composite es excelente para modelar jerarquías de objetos donde tanto las hojas como las composiciones deben ser tratadas de la misma manera. Este patrón es ideal para representar estructuras en árbol, como sistemas de archivos, menús o gráficos, y permite una gran flexibilidad y extensibilidad. Aunque puede aumentar la complejidad en algunos casos, su capacidad para simplificar el cliente y permitir una mayor modularidad lo convierte en una herramienta poderosa para la construcción de sistemas jerárquicos.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>