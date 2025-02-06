<?php 
session_start(); 
include 'clases/usuario.php'; // Incluir la definición de la clase Usuario

// Crear y serializar el objeto Usuario si no está ya en la sesión
if (!isset($_SESSION["usuario"])) {
    $usuario = new Usuario('Juan', 'juan@example.com');
    $_SESSION["usuario"] = serialize($usuario);
} else {
    $usuario = unserialize($_SESSION["usuario"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <p>
        hola mi nombre es 
        <?php 
            if (isset($_SESSION['nombre']) && !empty($_SESSION['nombre'])) {
                echo htmlspecialchars($_SESSION['nombre']);
            } else {
                echo 'Invitado';
            }
        ?>
    </p>

    
     <?php if ($usuario): ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($usuario->nombre); ?></td>
                <td><?php echo htmlspecialchars($usuario->email); ?></td>
            </tr>
        </table>
        <?php else: ?>
        <p>No hay usuario guardado.</p>
        <?php endif; ?>
</body>
</html>