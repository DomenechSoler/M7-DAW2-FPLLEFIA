<?php
session_start();

class Producte {
    public $nom;
    public $preu;

    public function __construct($nom, $preu) {
        $this->nom = $nom;
        $this->preu = $preu;
    }
}

class CarretCompra {
    public $productes = [];

    public function afegirProducte($producte) {
        $this->productes[] = $producte;
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->productes as $producte) {
            $total += $producte->preu;
        }
        return $total;
    }
}

if (!isset($_SESSION['carret'])) {
    $_SESSION['carret'] = serialize(new CarretCompra());
}

$carret = unserialize($_SESSION['carret']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nom']) && isset($_POST['preu'])) {
    $nom = $_POST['nom'];
    $preu = floatval($_POST['preu']);
    $producte = new Producte($nom, $preu);
    $carret->afegirProducte($producte);
    $_SESSION['carret'] = serialize($carret);
}


if (isset($_GET['reiniciar'])) {
    unset($_SESSION['carret']); 
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Carret de Compra</title>
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
    <h1>Carret de Compra</h1>
    <form method="post" action="">
        <label for="nom">Nom del Producte:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="preu">Preu:</label>
        <input type="number" id="preu" name="preu" step="0.01" required>
        <button type="submit">Afegir Producte</button>
    </form>

    <h2>Productes Afegits</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Preu</th>
        </tr>
        <?php foreach ($carret->productes as $producte): ?>
        <tr>
            <td><?php echo htmlspecialchars($producte->nom); ?></td>
            <td><?php echo number_format($producte->preu, 2); ?> €</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total: <?php echo number_format($carret->calcularTotal(), 2); ?> €</h3>

    <button class="">
            <a href="?reiniciar=1" class="">Reiniciar sessió</a>
        </button>
</body>
</html>