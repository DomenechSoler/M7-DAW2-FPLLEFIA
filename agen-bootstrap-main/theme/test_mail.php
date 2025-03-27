<?php
$to = 'domenechsolerkilian@fpllefia.com'; // Cambia esto a tu dirección de correo
$subject = "Prueba de correo";
$body = "Este es un mensaje de prueba.";
$headers = "From: tu_correo@example.com"; // Cambia esto a tu dirección de correo

if (mail($to, $subject, $body, $headers)) {
    echo "Mensaje de prueba enviado con éxito.";
} else {
    echo "Error al enviar el mensaje de prueba.";
}
?>