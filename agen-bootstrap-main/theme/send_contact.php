<?php
session_start();
require_once './config.php'; // Asegúrate de que la ruta sea correcta
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validar los datos del formulario
    if (empty($name) || empty($email) || empty($message)) {
        die("Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido.");
    }

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['SMTP_PORT'];

        // Configuración del correo
        $mail->setFrom($email, $name);
        $mail->addAddress('domenechsolerkilian@fpllefia.com'); // Cambia esto a tu dirección de correo
        $mail->Subject = "Nuevo mensaje de contacto de $name";
        $mail->Body = "Nombre: $name\nCorreo electrónico: $email\n\nMensaje:\n$message";

        // Enviar el correo
        if ($mail->send()) {
            echo "Mensaje enviado con éxito.";
        } else {
            echo "Error al enviar el mensaje.";
        }
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>