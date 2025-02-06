<?php
include '../src/config/config.php';
include '../src/classes/Dutton.php';
include '../src/classes/ObjecteEspecial.php';

$selectedDuttons = $_POST['personatges'] ?? [];

if (empty($selectedDuttons)) {
    echo "<p>Error: No has seleccionat cap personatge.</p>";
    echo '<p><a href="characters.php">Tornar a la selecció</a></p>';
    exit;
}

$duttons = array_map('unserialize', $_SESSION['duttons']);
$duttonsSeleccionats = array_filter($duttons, function ($dutton) use ($selectedDuttons) {
    return in_array($dutton->id, $selectedDuttons);
});

$objectesEspecials = [
    new ObjecteEspecial('Espasa de Foc', 'Augment atac', 20, 'assets/img/espasa_foc.png'),
    new ObjecteEspecial('Escut d’Aigua', 'Redueix dany', 10, 'assets/img/escut_aigua.png'),
    new ObjecteEspecial('Capa d’Ombra', 'Escut protector', 0, 'assets/img/capa_ombra.png'),
];
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precombat</title>
    <link rel="stylesheet" href="../src/styles/style.css">
</head>
<body>
    <h1>Fase de Precombat</h1>

    <form method="POST" action="combat.php">
        <div>
            <h2>Personatges Seleccionats</h2>
            <?php foreach ($duttonsSeleccionats as $index => $dutton): ?>
                <div class="personatge-card">
                    <h3><?php echo htmlspecialchars($dutton->getNom()); ?></h3>
                    <img src="<?php echo htmlspecialchars($dutton->getImatge()); ?>" alt="Imatge de <?php echo htmlspecialchars($dutton->getNom()); ?>">
                    <p>Salut: <?php echo $dutton->getSalut(); ?></p>
                    <p>Dany: <?php echo $dutton->getDany(); ?></p>
                    <p>Habilitats: <?php echo $dutton->obtenirHabilitats(); ?></p>
                    
                    <label for="objecte-<?php echo $index; ?>">Assigna un objecte especial:</label>
                    <select name="objectes[<?php echo $dutton->id; ?>]" id="objecte-<?php echo $index; ?>">
                        <?php foreach ($objectesEspecials as $objecte): ?>
                            <option value="<?php echo htmlspecialchars(serialize($objecte)); ?>">
                                <?php echo $objecte->nom; ?> (<?php echo $objecte->tipus; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>

        <div>
            <h2>Objectes Especials Disponibles</h2>
            <?php foreach ($objectesEspecials as $objecte): ?>
                <div class="objecte-card">
                    <h3><?php echo htmlspecialchars($objecte->nom); ?></h3>
                    <img src="<?php echo htmlspecialchars($objecte->imatge); ?>" alt="Imatge de <?php echo htmlspecialchars($objecte->nom); ?>">
                    <p>Tipus: <?php echo htmlspecialchars($objecte->tipus); ?></p>
                    <p>Valor: <?php echo $objecte->valor; ?>%</p>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit">Iniciar Combat</button>
    </form>
</body>
</html>
