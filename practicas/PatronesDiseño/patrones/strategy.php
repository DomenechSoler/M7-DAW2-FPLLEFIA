<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrón de Diseño Strategy</title>
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
        <h1 class="mb-4">Strategy</h1>
        <h2>¿Qué es?</h2>
        <p class="">El patrón Strategy es un patrón de diseño de comportamiento que permite definir una familia de algoritmos, encapsularlos en clases separadas y hacer que sean intercambiables. El contexto (la clase que utiliza el algoritmo) delega el trabajo a una de estas clases de estrategia, sin conocer detalles de la implementación específica. Este patrón es útil cuando tienes múltiples formas de hacer una tarea y quieres poder cambiar entre ellas de manera flexible durante la ejecución.</p>
        
        <h2>¿Cómo Funciona?</h2>
        <p>La implementación del patrón Strategy generalmente sigue estos pasos:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Definir una interfaz común: Todas las estrategias implementan la misma interfaz, que expone un único método para ejecutar el algoritmo.</li>
            <li class="list-group-item">Crear estrategias concretas: Cada algoritmo o comportamiento específico es implementado en una clase separada que implementa la interfaz común.</li>
            <li class="list-group-item">Contexto: La clase contexto tiene un campo para almacenar una referencia a un objeto de estrategia. Delegará la ejecución del algoritmo al objeto de estrategia actual.</li>
            <li class="list-group-item">Cambio de estrategia: La clase contexto no selecciona la estrategia, sino que el cliente decide qué estrategia debe usar en un momento dado.</li>
        </ul>
        <p class="mt-4">Este enfoque permite cambiar entre diferentes algoritmos sin modificar el código de la clase contexto ni las estrategias existentes.</p>
        
        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/strategy.png" alt="">
        </div>

        <h2>Implementación: Ejemplo</h2>
        <p>Imagina que estamos creando una aplicación de navegación para viajeros. Esta aplicación debe planificar rutas utilizando diferentes modos de transporte: coche, a pie, transporte público y bicicleta. En lugar de tener una enorme clase con múltiples condicionales que gestionen todos los algoritmos de enrutamiento, podemos usar el patrón Strategy para separarlos en clases individuales.</p>
        
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// La interfaz común para todas las estrategias
interface Strategy {
    public function planRoute($start, $end);
}

// Estrategia concreta para rutas en coche
class CarRoute implements Strategy {
    public function planRoute($start, $end) {
        return "Ruta en coche desde $start a $end";
    }
}

// Estrategia concreta para rutas a pie
class WalkingRoute implements Strategy {
    public function planRoute($start, $end) {
        return "Ruta a pie desde $start a $end";
    }
}

// Estrategia concreta para rutas en transporte público
class PublicTransportRoute implements Strategy {
    public function planRoute($start, $end) {
        return "Ruta en transporte público desde $start a $end";
    }
}

// Estrategia concreta para rutas en bicicleta
class BikeRoute implements Strategy {
    public function planRoute($start, $end) {
        return "Ruta en bicicleta desde $start a $end";
    }
}

// Clase contexto que utiliza una estrategia
class Navigator {
    private $strategy;
    
    public function setStrategy(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function executeStrategy($start, $end) {
        return $this->strategy->planRoute($start, $end);
    }
}
            </code></pre>
        </div>
        <p>En este ejemplo, la clase Navigator usa diferentes estrategias de enrutamiento. El cliente puede cambiar la estrategia en tiempo de ejecución, eligiendo el modo de transporte según lo necesite.</p>
        
        <h2>Ventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Intercambio de algoritmos: Puedes cambiar entre diferentes algoritmos durante la ejecución sin modificar el contexto.</li>
            <li class="list-group-item">Código limpio y desacoplado: El contexto no necesita conocer los detalles de los algoritmos, lo que reduce la complejidad.</li>
            <li class="list-group-item">Facilita la extensión: Se pueden añadir nuevas estrategias sin modificar el código del contexto.</li>
            <li class="list-group-item">Sustitución de herencia por composición: El patrón promueve la reutilización de código a través de composición en lugar de herencia, lo que hace que el sistema sea más flexible.</li>
            <li class="list-group-item">Principio de abierto/cerrado: El patrón permite introducir nuevas estrategias sin tener que modificar las clases existentes.</li>
        </ul>
        
        <h2>Desventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Complejidad adicional: Si el número de algoritmos es pequeño y no cambia a menudo, el patrón puede introducir una complejidad innecesaria debido a la creación de clases y la gestión de interfaces adicionales.</li>
            <li class="list-group-item">Conocimiento de estrategias: Los clientes deben entender cómo seleccionar la estrategia adecuada, lo que puede complicar el diseño si no se gestiona correctamente.</li>
            <li class="list-group-item">Rendimiento: Aunque el patrón es flexible, puede agregar una pequeña sobrecarga de rendimiento, ya que implica la delegación de trabajo a objetos separados.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El patrón Strategy es ideal para situaciones en las que necesitas ejecutar un comportamiento específico de manera intercambiable y flexible. Es útil cuando tienes múltiples variantes de un mismo algoritmo y necesitas cambiar entre ellas sin alterar el contexto que las usa. Aunque puede agregar complejidad en algunos casos, ofrece grandes ventajas en términos de flexibilidad, mantenimiento y expansión de las aplicaciones, especialmente cuando se requieren varios algoritmos en tiempo de ejecución.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>