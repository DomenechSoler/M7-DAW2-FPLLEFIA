<?php
require_once '../src/classes/Dutton.php'; 
require_once '../src/classes/Jugador.php';
require_once '../src/classes/Joc.php';



$jugador1 = new Jugador("Jugador 1");
$jugador2 = new Jugador("Jugador 2");

$jugador1->seleccionarDutton($duttons[0]);
$jugador2->seleccionarDutton($duttons[1]);

$joc = new Joc();
$joc->afegirJugador($jugador1);
$joc->afegirJugador($jugador2);
$joc->iniciarPartida();

$joc->processarTorn('atacar', $jugador2);
$joc->processarTorn('habilitat', $jugador1);

if ($joc->estatJoc == 'finalitzat') {
    echo "El joc ha acabat.\n";
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personatges Duttons</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <h1>Personatges Duttons</h1>

    <?php if (empty($duttons)): ?>
        <p class="no-gormitis">No has creat cap Dutton encara.</p>
        <p><a href="../../../index.php">Crear un altre Dutton</a></p>
        <p><a href="reset.php">Reiniciar la sessió</a></p>
    <?php else: ?>
        <form method="POST" action="precombat.php">
            <div class="container">
                <?php foreach ($duttons as $dutton): ?>
                    <?php if ($dutton instanceof Duttons): ?>
                        <div class="card">
                            <img src="<?= htmlspecialchars($dutton->imatge) ?>" alt="Imatge de <?= htmlspecialchars($dutton->nom) ?>">
                            <h3><?= htmlspecialchars($dutton->nom) ?></h3>
                            <p>Salut: <?= htmlspecialchars($dutton->salut) ?></p>
                            <p>Dany: <?= htmlspecialchars($dutton->dany) ?></p>
                            <p>Habilitats: <?= htmlspecialchars($dutton->obtenirHabilitats()) ?></p>
                            <input type="checkbox" name="personatges[]" value="<?php echo htmlspecialchars($dutton->id); ?>">Selecciona
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="clear"></div>
            <button type="submit">Anar al precombat</button>
        </form>
    <?php endif; ?>

    <p><a href="../../../index.php">Crear un altre Dutton</a></p>
    <p><a href="reset.php">Reiniciar la sessió</a></p>
</body>
</html>