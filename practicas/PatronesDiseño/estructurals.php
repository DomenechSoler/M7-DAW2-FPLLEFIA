<?php
$structuralPatterns = [
    'Adapter' => 'patrones/adapter.php',
    'Composite' => 'patrones/composite.php'
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
    <h2 class="mb-4">Patrones Estructurales</h2>
    <p>Los patrones estructurales se centran en la forma en que los objetos y las clases se organizan y se relacionan entre sí. Su objetivo es simplificar la estructura de un sistema al permitir que los componentes se conecten de manera eficiente y flexible, sin alterar su funcionalidad. Estos patrones ayudan a definir la forma en que las clases y objetos interactúan, facilitando su integración y reutilización.</p>
    <p>Algunos ejemplos de patrones estructurales son:</p>
    <ul class="list-group mb-4">
        <li class="list-group-item">Adapter: Permite que dos clases incompatibles trabajen juntas, adaptando la interfaz de una clase a la interfaz que espera el cliente.</li>
        <li class="list-group-item">Bridge: Separa la abstracción de su implementación, permitiendo que ambas varíen independientemente.</li>
        <li class="list-group-item">Composite: Permite tratar de manera uniforme a los objetos individuales y a las composiciones de objetos, formando estructuras de árbol.</li>
        <li class="list-group-item">Decorator: Añade responsabilidades adicionales a un objeto de manera dinámica sin modificar su estructura.</li>
        <li class="list-group-item">Facade: Proporciona una interfaz simplificada para un conjunto de interfaces más complejas, ocultando la complejidad interna.</li>
        <li class="list-group-item">Flyweight: Permite compartir objetos para reducir el uso de memoria, creando una instancia única para objetos que son iguales en lugar de duplicarlos.</li>
        <li class="list-group-item">Proxy: Proporciona un sustituto o representante de otro objeto, controlando el acceso al objeto real.</li>
    </ul>
    <p>Los patrones estructurales ayudan a crear sistemas más modulares, permitiendo que las relaciones entre los objetos sean más flexibles y fáciles de modificar sin afectar demasiado el sistema.</p>
    <form method="GET" action="" class="mb-4">
    <div class="mb-3">
        <label for="pattern" class="form-label">Selecciona un patrón estructural:</label>
        <div class="row">
            <div class="col-md-8">
                <select name="pattern" id="pattern" class="form-select">
                    <?php foreach ($structuralPatterns as $name => $link): ?>
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
