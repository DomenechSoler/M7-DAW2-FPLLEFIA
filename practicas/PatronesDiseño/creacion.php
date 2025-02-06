<?php
$creationalPatterns = [
    'Singleton' => 'patrones/singleton.php',
    'Factory Method' => 'patrones/factory.php'
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
    <h2 class="mb-4">Patrones Creacionales</h2>
    <p>Los patrones creacionales son un tipo de patrones de diseño que se enfocan en la creación de objetos de manera flexible y eficiente. Estos patrones permiten abstraer y delegar la instancia de objetos a una clase específica, evitando la necesidad de que el código cliente conozca detalles específicos sobre cómo se crean los objetos. El objetivo es hacer que la creación de objetos sea más sencilla, flexible y escalable.</p>
    <p>Algunos ejemplos de patrones creacionales son:</p>
    <ul class="list-group mb-4">
        <li class="list-group-item">Singleton: Garantiza que una clase tenga una sola instancia y proporciona un punto global de acceso a esa instancia.</li>
        <li class="list-group-item">Factory Method: Define una interfaz para crear objetos, pero deja que las subclases decidan qué clase instanciar.</li>
        <li class="list-group-item">Abstract Factory: Permite crear familias de objetos relacionados sin especificar sus clases concretas.</li>
        <li class="list-group-item">Builder: Separa la construcción de un objeto complejo de su representación, permitiendo crear diferentes representaciones del mismo tipo de objeto.</li>
        <li class="list-group-item">Prototype: Permite crear nuevos objetos copiando un objeto existente, en lugar de crear una nueva instancia desde cero.</li>
    </ul>
    <p>Estos patrones son útiles cuando necesitamos controlar cómo se crean los objetos o cuando la creación de los objetos debe ser independiente de su uso.</p>
    <form method="GET" action="" class="mb-4">
        <div class="mb-3">
            <label for="pattern" class="form-label">Selecciona un patrón creacional:</label>
            <div class="row">
                <div class="col-md-8">
                    <select name="pattern" id="pattern" class="form-select">
                        <?php foreach ($creationalPatterns as $name => $link): ?>
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

    <br>
    <br>
    <br>
</div>
</body>
