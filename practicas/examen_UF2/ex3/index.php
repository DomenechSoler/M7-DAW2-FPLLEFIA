<?php

class Habitacio{

    public string $tipus;
    public int $preu;
    public bool $disponible; 

    public function __construct(string $tipus = "Sin tipo", int $preu = 0, bool $disponible){
        $this->tipus = $tipus;
        $this->preu = $preu;
        $this->disponible = $disponible;
    }


    public function mostrarInfo (): string {
        return "La habitación " . $this->tipus . ", cuesta " . $this->preu . " euros y está " . $this->disponible . ".";
    }
}

$habitacio1 = new Habitacio("Hotel", 25, true);
$habitacio2 = new Habitacio("Hostal", 15, false);
$habitacio3 = new Habitacio("Casa", 10, true);
$habitacio4 = new Habitacio("Piso", 20, false);

class Hotel{
    public array $habitacions = [];

    public function llistarHabitacions(){
        foreach ($this->habitacions as $habitacio) {
            if ($habitacio->disponible===true) {
                echo $habitacio->mostrarInfo() . "<br>";
            }
        }
    }

public function reservarHabitacio(){
    foreach ($this->habitacions as $habitacio) {
        if ($habitacio->disponible===true) {
            $habitacio->disponible = false;
            echo "Habitación reservada";
            return;
        }
    }
    echo "No hay habitaciones disponibles";
}

public function mmostrarDisponibilitat(){
    foreach ($this->habitacions as $habitacio) {
        if ($habitacio->disponible===true) {
            echo "Hay habitaciones disponibles";
            return;
        }
    }
    echo "No hay habitaciones disponibles";
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Tipus</th>
            <th>Preu</th>
            <th>Disponible</th>
        </tr>
        <tr>
            <td><?php echo $habitacio1->tipus; ?></td>
            <td><?php echo $habitacio1->preu; ?></td>
            <td><?php echo $habitacio1->disponible; ?></td>
        </tr>
        <tr>
            <td><?php echo $habitacio2->tipus; ?></td>
            <td><?php echo $habitacio2->preu; ?></td>
            <td><?php echo $habitacio2->disponible; ?></td>
        </tr>
        <tr>
            <td><?php echo $habitacio3->tipus; ?></td>
            <td><?php echo $habitacio3->preu; ?></td>
            <td><?php echo $habitacio3->disponible; ?></td>
        </tr>
        <tr>
            <td><?php echo $habitacio4->tipus; ?></td>
            <td><?php echo $habitacio4->preu; ?></td>
            <td><?php echo $habitacio4->disponible; ?></td>
        </tr>
    </table>

    <table>
        <tr>
        <?php
        
        foreach ($hotel->habitacions as $habitacio) {
            echo "<td>" . $habitacio->tipus . "</td>";
            echo "<td>" . $habitacio->preu . "</td>";
            echo "<td>" . $habitacio->disponible . "</td>";
        }
        ?>
        </tr>
    </table>
</body>
</html>




