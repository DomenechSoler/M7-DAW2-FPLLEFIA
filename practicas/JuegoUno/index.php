<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UNO's game</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <?php 
    include_once 'carta.class.php';
    include_once 'baraja.class.php';
    include_once 'partida.class.php';
    include_once 'jugador.class.php';

    

    // Inicializar la sesión y partida si no existe
    if (!isset($_SESSION['partida'])) {
        require_once 'formulario_uno.php';
        $_SESSION['partida'] = new Partida();
        $_SESSION['partida']->baraja->crea_baraja();
    }

    // Manejo del formulario inicial
    if (isset($_REQUEST['njugadors']) && isset($_REQUEST['ncartas'])) {
        // Validar entradas
        $numeroJugadores = filter_var($_REQUEST['njugadors'], FILTER_VALIDATE_INT);
        $numeroCartas = filter_var($_REQUEST['ncartas'], FILTER_VALIDATE_INT);

        if ($numeroJugadores && $numeroCartas) {
            $_SESSION['partida']->numero_jugadores = $numeroJugadores;
            $_SESSION['partida']->numero_cartas = $numeroCartas;

            // Mezclar baraja
            $_SESSION['partida']->baraja->mezcla();

            // Crear jugadores y repartir cartas
            for ($i = 0; $i < $numeroJugadores; $i++) {
                $jugador = new Jugador($i);
                $_SESSION['partida']->array_jugadores[] = $jugador;

                // Repartir cartas al jugador
                for ($j = 0; $j < $numeroCartas; $j++) {
                    if (!empty($_SESSION['partida']->baraja->conjunto_cartas)) {
                        $lastCard = array_pop($_SESSION['partida']->baraja->conjunto_cartas);
                        $jugador->mano->conjunto_cartas[] = $lastCard;
                    }
                }
            }

            // Sacar una carta inicial a la mesa
            do {
                $_SESSION['partida']->carta_en_mesa = array_pop($_SESSION['partida']->baraja->conjunto_cartas);
            } while (!is_numeric($_SESSION['partida']->carta_en_mesa->numero));

            $_SESSION['partida']->jugar();
        }
    }

    // Manejo del clic en una carta
    if (isset($_REQUEST['indice'])) {
        $posicionCarta = filter_var($_REQUEST['posicion'], FILTER_VALIDATE_INT);
        $indiceCarta = filter_var($_REQUEST['indice'], FILTER_VALIDATE_INT);
        $numeroCarta = $_REQUEST['numero'];
        $paloCarta = $_REQUEST['palo'];

        if (($numeroCarta == $_SESSION['partida']->carta_en_mesa->numero) || ($paloCarta == $_SESSION['partida']->carta_en_mesa->palo)) {
            $cartaTirada = array_splice(
                $_SESSION['partida']->array_jugadores[$_SESSION['partida']->turno]->mano->conjunto_cartas,
                $posicionCarta,
                1
            );

            $_SESSION['partida']->normas_uno($numeroCarta, $paloCarta, $posicionCarta, $indiceCarta);
            $_SESSION['partida']->cambiar_turno();
            $_SESSION['partida']->jugar();
        } else {
            echo '<script type="text/javascript">
                alert("Error. Deben ser del mismo color o número. Inténtalo de nuevo o roba si no tienes...");
                window.location.href="index.php?turno=' . $_SESSION['partida']->turno . '";
            </script>';
        }
    }

    // Manejo del turno
    if (isset($_REQUEST['turno'])) {
        $_SESSION['partida']->jugar();
    }

	if (isset($_REQUEST['robar'])) {
		// Verificar que la baraja no esté vacía
		if (!empty($_SESSION['partida']->baraja->conjunto_cartas)) {
			$cartaRobada = array_pop($_SESSION['partida']->baraja->conjunto_cartas);
	
			// Verificar que el jugador actual esté inicializado correctamente
			if (isset($_SESSION['partida']->array_jugadores[$_SESSION['partida']->turno]) &&
				isset($_SESSION['partida']->array_jugadores[$_SESSION['partida']->turno]->mano) &&
				is_array($_SESSION['partida']->array_jugadores[$_SESSION['partida']->turno]->mano->conjunto_cartas)) {
				
				$_SESSION['partida']->array_jugadores[$_SESSION['partida']->turno]->mano->conjunto_cartas[] = $cartaRobada;
	
				// Verificar que la carta en mesa no sea null
				if ($_SESSION['partida']->carta_en_mesa !== null) {
					if (($cartaRobada->numero != $_SESSION['partida']->carta_en_mesa->numero) &&
						($cartaRobada->palo != $_SESSION['partida']->carta_en_mesa->palo)) {
						$_SESSION['partida']->cambiar_turno();
					}
				} else {
					echo "Error: No hay una carta en la mesa.";
					exit;
				}
	
				$_SESSION['partida']->jugar();
			} else {
				echo "Error: Jugador actual o su mano no están inicializados correctamente.";
				exit;
			}
		} else {
			echo "Error: La baraja está vacía, no se pueden robar más cartas.";
			exit;
		}
	}
	
    ?>

</body>
</html>
