<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrón de Diseño Adapter</title>
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
        <h1 class="mb-4">Adapter</h1>
        <h2>¿Qué es?</h2>
        <p class="">El patrón Adapter es un patrón de diseño estructural que permite que dos interfaces incompatibles trabajen juntas. Este patrón actúa como un puente entre dos clases con interfaces diferentes. El Adapter convierte la interfaz de una clase en otra que el cliente espera. Es útil cuando tienes una clase que no es compatible con la interfaz que tu sistema necesita, y quieres reutilizarla sin modificar su código original.</p>
        
        <h2>¿Cómo Funciona?</h2>
        <p>El patrón Adapter funciona de la siguiente manera:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Interfaz Esperada (Cliente):</strong> El cliente requiere una interfaz específica para interactuar con un objeto.</li>
            <li class="list-group-item"><strong>Clase Incompatible:</strong> La clase existente que quieres utilizar no implementa esa interfaz, pero tiene la funcionalidad que necesitas.</li>
            <li class="list-group-item"><strong>Clase Adapter:</strong> Se crea una clase que implementa la interfaz esperada y delega las llamadas al objeto incompatible, adaptándolo a la interfaz requerida.</li>
            <li class="list-group-item"><strong>Delegación:</strong> La clase Adapter actúa como intermediaria y convierte las llamadas de un tipo de interfaz a otro, permitiendo que el cliente y el objeto incompatible trabajen juntos sin modificar el código original.</li>
        </ul>
        
        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/adapter.png" alt="">
        </div>

        <h2>Implementación: Ejemplo</h2>
        <p>Imagina que tienes una aplicación que necesita conectarse a una base de datos usando un formato antiguo de conexión. Sin embargo, la nueva versión de la aplicación requiere que se utilice una interfaz más moderna y estandarizada.</p>
        
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// Interfaz esperada por el cliente
interface Database {
    public function connect();
    public function query($sql);
}

// Clase antigua (incompatible)
class OldDatabase {
    public function oldConnect() {
        return "Conexión establecida con la base de datos antigua";
    }

    public function oldQuery($sql) {
        return "Consulta ejecutada: $sql";
    }
}

// Adapter que hace que OldDatabase sea compatible con la interfaz Database
class DatabaseAdapter implements Database {
    private $oldDatabase;

    public function __construct(OldDatabase $oldDatabase) {
        $this->oldDatabase = $oldDatabase;
    }

    public function connect() {
        return $this->oldDatabase->oldConnect();
    }

    public function query($sql) {
        return $this->oldDatabase->oldQuery($sql);
    }
}

// Cliente
class DatabaseClient {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function execute($sql) {
        echo $this->database->connect() . "\n";
        echo $this->database->query($sql) . "\n";
    }
}

// Uso del Adapter
$oldDatabase = new OldDatabase();
$adapter = new DatabaseAdapter($oldDatabase);
$client = new DatabaseClient($adapter);

$client->execute("SELECT * FROM users");
            </code></pre>
        </div>
        <p>En este ejemplo, la clase DatabaseAdapter adapta la interfaz de la clase OldDatabase para que sea compatible con la interfaz Database esperada por el cliente. Ahora, el cliente puede interactuar con la base de datos antigua sin problemas.</p>
        
        <h2>Ventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Reutilización de código: Permite utilizar clases existentes que no cumplen con la interfaz esperada, evitando tener que reescribir código.</li>
            <li class="list-group-item">Flexibilidad: Los objetos de diferentes interfaces pueden ser utilizados juntos, aumentando la interoperabilidad.</li>
            <li class="list-group-item">Desacoplamiento: El cliente no necesita saber nada sobre la clase que está adaptando, lo que reduce el acoplamiento entre componentes.</li>
            <li class="list-group-item">Interfaz única: Ofrece una interfaz común para interactuar con objetos incompatibles, haciendo que el código sea más limpio y fácil de mantener.</li>
        </ul>
        
        <h2>Desventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Complejidad: Introducir un adaptador puede hacer que el diseño sea más complicado, especialmente si necesitas adaptar múltiples clases.</li>
            <li class="list-group-item">Sobrecarga: Puede haber una ligera sobrecarga de rendimiento debido a la delegación de las llamadas al objeto adaptado.</li>
            <li class="list-group-item">Demasiados adaptadores: Si tienes muchas clases que requieren adaptación, puedes terminar con una gran cantidad de adaptadores, lo que puede hacer que el sistema sea difícil de mantener.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El patrón Adapter es ideal cuando necesitas que clases con interfaces incompatibles trabajen juntas sin modificar su código original. Es especialmente útil cuando se trabaja con sistemas heredados o bibliotecas de terceros. Aunque puede aumentar la complejidad y la sobrecarga en algunos casos, su capacidad para hacer que componentes incompatibles cooperen de manera eficiente lo convierte en una herramienta poderosa para la integración de sistemas.</p>
        <p>Este patrón es fundamental para la reutilización de código y la adaptación de interfaces en aplicaciones más grandes, asegurando que el código sea flexible y extensible sin tener que cambiar el comportamiento de clases ya existentes.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>