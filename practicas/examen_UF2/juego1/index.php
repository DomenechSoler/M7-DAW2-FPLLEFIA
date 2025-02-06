<?php
session_start();

class JocAdivinacio {
    private $numeroSecret;
    private $intents;

    public function __construct() {
        if (!isset($_SESSION['numeroSecret'])) {
            $_SESSION['numeroSecret'] = rand(1, 20);
        }
        $this->numeroSecret = $_SESSION['numeroSecret'];
        $this->intents = isset($_SESSION['intents']) ? $_SESSION['intents'] : 0;
    }

    public function comprovar($num) {
        $this->intents++;
        $_SESSION['intents'] = $this->intents;

        if ($num < $this->numeroSecret) {
            return "El número és més gran.";
        } elseif ($num > $this->numeroSecret) {
            return "El número és més petit.";
        } else {
            session_destroy();
            return "Correcte! Has encertat el número en $this->intents intents.";
        }
    }
}

$joc = new JocAdivinacio();
$resultat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = intval($_POST['numero']);
    $resultat = $joc->comprovar($num);
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Joc d'Adivinació</title>
</head>
<body>
    <h1>Joc d'Adivinació</h1>
    <form method="post" action="">
        <label for="numero">Introdueix un número entre 1 i 20:</label>
        <input type="number" id="numero" name="numero" min="1" max="20" required>
        <button type="submit">Comprovar</button>
    </form>
    <p><?php echo $resultat; ?></p>
</body>
</html>