<?php
include './practicas/duttons-game/src/config/config.php';
include './practicas/duttons-game/src/classes/Dutton.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nom']) && !empty($_POST['salut']) && !empty($_POST['dany']) && !empty($_POST['imatge']) && !empty($_POST['habilitats'])) {
        $nouDutton = new Duttons(
            uniqid(), 
            $_POST['nom'],
            (int)$_POST['salut'],
            (int)$_POST['dany'],
            $_POST['imatge'],
            explode(',', $_POST['habilitats'])
        );

        $_SESSION['duttons'][] = serialize($nouDutton);

        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color: red;'>Tots els camps són obligatoris.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Dutton</title>
</head>
<body>
    <h1>Crea un nou Dutton</h1>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="salut">Salut:</label>
        <input type="number" id="salut" name="salut" required><br><br>

        <label for="dany">Dany:</label>
        <input type="number" id="dany" name="dany" required><br><br>

        <label for="imatge">URL Imatge:</label>
        <input type="url" id="imatge" name="imatge" required><br><br>

        <label for="habilitats">Habilitats (separades per comes):</label>
        <input type="text" id="habilitats" name="habilitats" required><br><br>

        <button type="submit">Crear Dutton</button>
    </form>

    <p><a href="./practicas/duttons-game/public/characters.php">Veure Duttons</a></p>
    <p><a href="reset.php">Reiniciar la sessió</a></p>
</body>
</html>
