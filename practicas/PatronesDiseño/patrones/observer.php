<?php include '../header.php'; ?>
<?php include '../navPatrones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrón de Diseño Observer</title>
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
        <h1 class="mb-4">Patrón de Diseño Observer</h1>
        <p class="">El patrón Observer es un patrón de diseño de comportamiento que permite establecer una relación de suscripción entre objetos, de manera que cuando un objeto cambia de estado, todos sus observadores son notificados automáticamente.</p>
        
        <h2>¿Cómo funciona?</h2>
        <p>El patrón Observer sigue una estructura básica con dos actores principales:</p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Sujeto (Subject):</strong> Mantiene una lista de observadores y proporciona métodos para añadir o eliminar observadores.</li>
            <li class="list-group-item"><strong>Observadores (Observers):</strong> Objetos que desean recibir actualizaciones cuando el sujeto cambie.</li>
        </ul>

        <h2 class="mt-3">Esquema</h2>
        <div class="d-flex justify-content-center">
            <img src="../imagenes/observer.png" alt="">
        </div>
        
        <h2>Implementación</h2>
        <p>A continuación, un ejemplo simple en JavaScript que ilustra el patrón Observer:</p>
        <div class="bg-dark p-4 rounded shadow-sm">
            <pre><code class="text-white">// La clase notificadora base incluye código de gestión de
// suscripciones y métodos de notificación.
class EventManager {
    private listeners = new Map();

    subscribe(eventType, listener) {
        if (!this.listeners.has(eventType)) {
            this.listeners.set(eventType, []);
        }
        this.listeners.get(eventType).push(listener);
    }

    unsubscribe(eventType, listener) {
        if (this.listeners.has(eventType)) {
            const index = this.listeners.get(eventType).indexOf(listener);
            if (index !== -1) {
                this.listeners.get(eventType).splice(index, 1);
            }
        }
    }

    notify(eventType, data) {
        if (this.listeners.has(eventType)) {
            this.listeners.get(eventType).forEach(listener => listener.update(data));
        }
    }
}

// El notificador concreto contiene lógica de negocio real, de
// interés para algunos suscriptores.
class Editor {
    public events = new EventManager();
    private file;

    openFile(path) {
        this.file = new File(path);
        this.events.notify("open", this.file.name);
    }

    saveFile() {
        this.file.write();
        this.events.notify("save", this.file.name);
    }
}

// Aquí está la interfaz suscriptora.
class EventListener {
    update(filename) {}
}

// Los suscriptores concretos reaccionan a las actualizaciones
// emitidas por el notificador al que están unidos.
class LoggingListener extends EventListener {
    constructor(logFilename, message) {
        super();
        this.log = new File(logFilename);
        this.message = message;
    }

    update(filename) {
        this.log.write(this.message.replace('%s', filename));
    }
}

class EmailAlertsListener extends EventListener {
    constructor(email, message) {
        super();
        this.email = email;
        this.message = message;
    }

    update(filename) {
        system.email(this.email, this.message.replace('%s', filename));
    }
}

// Una aplicación puede configurar notificadores y suscriptores
// durante el tiempo de ejecución.
class Application {
    config() {
        const editor = new Editor();

        const logger = new LoggingListener(
            "/path/to/log.txt",
            "Someone has opened the file: %s"
        );
        editor.events.subscribe("open", logger);

        const emailAlerts = new EmailAlertsListener(
            "admin@example.com",
            "Someone has changed the file: %s"
        );
        editor.events.subscribe("save", emailAlerts);
    }
}
            </code></pre>
        </div>
        
        <h2>Ejemplo</h2>
        <p>Un ejemplo común del patrón Observer es un sistema de notificaciones en una tienda en línea. Los clientes pueden suscribirse a actualizaciones sobre un producto y recibir una notificación cuando esté disponible.</p>
        
        <h2>Ventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Facilita la comunicación entre objetos sin acoplamiento fuerte.</li>
            <li class="list-group-item">Permite agregar observadores dinámicamente en tiempo de ejecución.</li>
            <li class="list-group-item">Sigue el principio de abierto/cerrado, facilitando la expansión del código sin modificarlo.</li>
        </ul>
        
        <h2>Desventajas</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">El orden en que se notifican los observadores no está garantizado.</li>
            <li class="list-group-item">Puede generar problemas de rendimiento si hay demasiados observadores.</li>
        </ul>
        
        <h2>Conclusión</h2>
        <p>El patrón Observer es una solución eficiente para gestionar dependencias entre objetos sin acoplarlos directamente. Es ampliamente utilizado en interfaces gráficas, sistemas de eventos y aplicaciones en tiempo real.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>