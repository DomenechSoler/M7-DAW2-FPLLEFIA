<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrón de Diseño Singleton</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="mb-4">Singleton</h1>
        <p class="">El patrón de diseño Singleton es un patrón creacional que garantiza que una clase tenga una única instancia y proporciona un punto de acceso global a dicha instancia.</p>
        
        <h2>¿Cómo funciona?</h2>
        <p>El patrón Singleton impide la creación de múltiples instancias de una clase y asegura que todas las partes del programa accedan a la misma instancia. Esto es útil cuando se necesita controlar el acceso a un recurso compartido como una base de datos o un archivo de configuración.</p>
        
        <h2>Implementación</h2>
        <p>Para implementar Singleton, se siguen estos pasos:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Declarar un campo estático privado para almacenar la instancia.</li>
            <li class="list-group-item">Crear un método estático público que retorne la instancia única.</li>
            <li class="list-group-item">Hacer privado el constructor para evitar instanciaciones directas.</li>
        </ul>
        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/singeleton.png" alt="">
        </div>

        <h2>Ejemplo</h2>
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// La clase Base de datos define el método `obtenerInstancia`
// que permite a los clientes acceder a la misma instancia de
// una conexión de la base de datos a través del programa.
class Database {
    // El campo para almacenar la instancia singleton debe
    // declararse estático.
    private static Database instance;

    // El constructor del singleton siempre debe ser privado
    // para evitar llamadas de construcción directas con el
    // operador `new`.
    private Database() {
        // Algún código de inicialización, como la propia
        // conexión al servidor de una base de datos.
        // ...
    }

    // El método estático que controla el acceso a la instancia
    // singleton.
    public static Database getInstance() {
        if (instance == null) {
            synchronized (Database.class) {
                // Garantiza que la instancia aún no se ha
                // inicializado por otro hilo mientras ésta ha
                // estado esperando el desbloqueo.
                if (instance == null) {
                    instance = new Database();
                }
            }
        }
        return instance;
    }

    // Por último, cualquier singleton debe definir cierta
    // lógica de negocio que pueda ejecutarse en su instancia.
    public void query(String sql) {
        // Por ejemplo, todas las consultas a la base de datos
        // de una aplicación pasan por este método. Por lo
        // tanto, aquí puedes colocar lógica de regularización
        // (throttling) o de envío a la memoria caché.
        // ...
    }
}

class Application {
    public static void main(String[] args) {
        Database foo = Database.getInstance();
        foo.query("SELECT ...");
        // ...
        Database bar = Database.getInstance();
        bar.query("SELECT ...");
        // La variable `bar` contendrá el mismo objeto que la
        // variable `foo`.
    }
}
            </code></pre>
        </div>
        
        <h2>Ventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Garantiza que haya una única instancia de la clase.</li>
            <li class="list-group-item">Proporciona un punto de acceso global.</li>
            <li class="list-group-item">Permite la inicialización diferida.</li>
        </ul>
        
        <h2>Desventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Vulnera el principio de responsabilidad única.</li>
            <li class="list-group-item">Puede dificultar las pruebas unitarias.</li>
            <li class="list-group-item">Requiere consideraciones especiales en entornos multihilo.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El patrón Singleton es útil cuando se necesita un único punto de acceso a una instancia compartida, aunque su uso excesivo puede indicar problemas en el diseño del software.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
