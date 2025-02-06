<?php
$behavioralPatterns = [
    'observer' => 'patrones/observer.php',
    'strategy' => 'patrones/strategy.php'
];
?>


<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<style>
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
<body class="bg-secondary">
    <div class="container bg-light mt-5 p-4 rounded">
    <h2 class="mb-4">Patrones de Comportamiento</h2>
    <p>Los patrones de comportamiento se enfocan en cómo los objetos interactúan entre sí y cómo se comunican dentro de un sistema. Buscan definir la responsabilidad de los objetos y la forma en que se distribuyen las tareas, lo que permite una mayor flexibilidad en la forma en que se realiza el flujo de trabajo. Estos patrones son útiles para resolver problemas relacionados con la comunicación, la gestión de eventos, la toma de decisiones y el control de flujos de procesos.</p>
    <p>Algunos ejemplos de patrones de comportamiento son:</p>
    <ul class="list-group mb-4">
        <li class="list-group-item">Chain of Responsibility: Permite que varios objetos manejen una solicitud sin que el emisor sepa cuál objeto la manejará. Cada objeto tiene la opción de procesar la solicitud o pasarla al siguiente en la cadena.</li>
        <li class="list-group-item">Command: Convierte una solicitud en un objeto que contiene toda la información necesaria para ejecutarla. Esto desacopla al remitente del receptor y permite realizar operaciones como deshacer/rehacer.</li>
        <li class="list-group-item">Interpreter: Define una gramática para interpretar una secuencia de instrucciones o expresiones. Es útil para procesar lenguajes y expresiones.</li>
        <li class="list-group-item">Iterator: Proporciona una forma de acceder secuencialmente a los elementos de un conjunto sin exponer su representación interna.</li>
        <li class="list-group-item">Mediator: Define un objeto que centraliza la comunicación entre diferentes objetos, evitando que estos interactúen directamente entre sí y reduciendo las dependencias.</li>
        <li class="list-group-item">Memento: Permite capturar el estado interno de un objeto sin exponer su estructura y restaurarlo posteriormente, facilitando el deshacer y rehacer.</li>
        <li class="list-group-item">Observer: Permite que un objeto (el sujeto) notifique a varios objetos dependientes (observadores) cuando su estado cambia, sin necesidad de que los observadores conozcan los detalles internos del sujeto.</li>
        <li class="list-group-item">State: Permite que un objeto cambie su comportamiento cuando su estado interno cambia. El objeto parecerá cambiar su clase.</li>
        <li class="list-group-item">Strategy: Permite seleccionar una algoritmo o comportamiento en tiempo de ejecución, sin modificar el objeto que lo utiliza.</li>
        <li class="list-group-item">Template Method: Define la estructura de un algoritmo en un método, dejando algunos pasos a ser implementados por las subclases.</li>
        <li class="list-group-item">Visitor: Permite agregar nuevas operaciones a clases existentes sin modificar sus estructuras, permitiendo recorrer elementos de una estructura de objetos y realizar diversas acciones.</li>
    </ul>
    <p>Los patrones de comportamiento son fundamentales para definir cómo las distintas partes de un sistema deben interactuar y reaccionar entre sí, promoviendo una mayor flexibilidad y extensibilidad en el código.</p>
    <form method="GET" action="" class="mb-4">
    <div class="mb-3">
        <label for="pattern" class="form-label">Selecciona un patrón de comportamiento:</label>
        <div class="row">
            <div class="col-md-8">
                <select name="pattern" id="pattern" class="form-select">
                    <?php foreach ($behavioralPatterns as $name => $link): ?>
                        <option value="<?= $link ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Ver patrón</button>
            </div>
        </div>
    </div>
</form>

<?php if (isset($_GET['pattern'])): ?>
    <script type="text/javascript">
        // Realiza la redirección usando JavaScript
        window.location.href = "<?= $_GET['pattern'] ?>";
    </script>
<?php endif; ?>
</div>
</body>
