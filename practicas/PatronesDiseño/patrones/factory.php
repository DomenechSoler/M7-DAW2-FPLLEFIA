<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory Method</title>
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
        <h1 class="mb-4">Factory Method</h1>
        <p class=""><strong>Factory Method</strong> es un patrón de diseño creacional que proporciona una interfaz para crear objetos en una superclase, mientras permite a las subclases alterar el tipo de objetos que se crearán.</p>
        
        <h2>Problema</h2>
        <p>Imagina que estás creando una aplicación de gestión logística que inicialmente solo maneja transporte en camión. Con el tiempo, debes agregar transporte marítimo, pero la mayor parte del código está acoplado a la clase Camión. Para añadir barcos, tendrías que modificar todo el código, lo que lo haría confuso y difícil de mantener.</p>
        
        <h2>Solución</h2>
        <p>El patrón Factory Method sugiere que, en lugar de crear objetos directamente con <code>new</code>, se invoque a un método fábrica especial en la superclase. Luego, cada subclase podrá sobrescribir este método para devolver productos específicos.</p>
        
        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/factoryMethod.png" alt="">
        </div>

        <h2>Ejemplo</h2>
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// La clase creadora declara el método fábrica que debe devolver
// un objeto de una clase de producto. Normalmente, las
// subclases de la creadora proporcionan la implementación de
// este método.
class Dialog {
    // La creadora también puede proporcionar cierta
    // implementación por defecto del método fábrica.
    abstract method createButton():Button

    // Observa que, a pesar de su nombre, la principal
    // responsabilidad de la creadora no es crear productos.
    // Normalmente contiene cierta lógica de negocio que depende
    // de los objetos de producto devueltos por el método
    // fábrica. Las subclases pueden cambiar indirectamente esa
    // lógica de negocio sobrescribiendo el método fábrica y
    // devolviendo desde él un tipo diferente de producto.
    method render() {
        // Invoca el método fábrica para crear un objeto de
        // producto.
        Button okButton = createButton()
        // Ahora utiliza el producto.
        okButton.onClick(closeDialog)
        okButton.render()
    }
}

// Los creadores concretos sobrescriben el método fábrica para
// cambiar el tipo de producto resultante.
class WindowsDialog extends Dialog {
    method createButton():Button {
        return new WindowsButton()
    }
}

class WebDialog extends Dialog {
    method createButton():Button {
        return new HTMLButton()
    }
}

// La interfaz de producto declara las operaciones que todos los
// productos concretos deben implementar.
interface Button {
    method render()
    method onClick(f)
}

// Los productos concretos proporcionan varias implementaciones
// de la interfaz de producto.
class WindowsButton implements Button {
    method render(a, b) {
        // Representa un botón en estilo Windows.
    }
    method onClick(f) {
        // Vincula un evento clic de OS nativo.
    }
}

class HTMLButton implements Button {
    method render(a, b) {
        // Devuelve una representación HTML de un botón.
    }
    method onClick(f) {
        // Vincula un evento clic de navegador web.
    }
}

class Application {
    field dialog: Dialog

    // La aplicación elige un tipo de creador dependiendo de la
    // configuración actual o los ajustes del entorno.
    method initialize() {
        config = readApplicationConfigFile()

        if (config.OS == "Windows") {
            dialog = new WindowsDialog()
        } else if (config.OS == "Web") {
            dialog = new WebDialog()
        } else {
            throw new Exception("Error! Unknown operating system.")
        }
    }

    // El código cliente funciona con una instancia de un
    // creador concreto, aunque a través de su interfaz base.
    // Siempre y cuando el cliente siga funcionando con el
    // creador a través de la interfaz base, puedes pasarle
    // cualquier subclase del creador.
    method main() {
        this.initialize()
        dialog.render()
    }
}
            </code></pre>
        </div>
        
        <h2 class="mt-5">Beneficios</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Reduce el acoplamiento entre la clase creadora y los productos concretos.</li>
            <li class="list-group-item">Facilita la extensión del código sin modificar la lógica existente.</li>
            <li class="list-group-item">Permite reutilizar objetos y optimizar el uso de recursos.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El Factory Method es ideal cuando se quiere delegar la responsabilidad de creación de objetos a las subclases, permitiendo que el código sea más flexible y escalable.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>