<?php
session_start();

class Factura {
    public $client;
    public $producte;
    public $quantitat;
    public $preuUnitari;


    public function __construct(string $client, string $producte, int $quantitat, float $preuUnitari) {
        $this->client = $client;
        $this->producte = $producte;
        $this->quantitat = $quantitat;
        $this->preuUnitari = $preuUnitari;
    }

    public function calcularTotal(): float {
        return $this->quantitat * $this->preuUnitari;
    }

    public function aplicarDescompte($percentatge=10) {
        $descompte = $this->calcularTotal() * $percentatge / 100;
        return $this->calcularTotal() - $descompte;
    }
}

$facturas = [
    new Factura('Pepito', 'Llapis', 10, 1.5),
    new Factura('Lucia', 'Boli', 15, 2),
    new Factura('Pepe', 'Taula', 10, 4),
    new Factura('Marcos', 'llibreta', 40, 4),
    new Factura('Pepito', 'Teclat', 60, 10)
];

$_SESSION['facturas'] = $facturas;
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
    <h1>Facturas</h1>
    <table>
        <tr>
            <th>client</th>
            <th>producte</th>
            <th>quantitat</th>
            <th>preuUnitari</th>
            <th>descompte</th>
            <th>Total amb descompte</th>
        </tr>
        <?php foreach ($_SESSION['facturas'] as $factura): ?>
        <tr>
            <td><?php echo $factura->client; ?></td>
            <td><?php echo $factura->producte; ?></td>
            <td><?php echo $factura->quantitat; ?></td>
            <td><?php echo $factura->preuUnitari; ?></td>
            <td><?php echo $factura->calcularTotal(); ?></td>
            <td><?php echo $factura->aplicarDescompte(10); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
