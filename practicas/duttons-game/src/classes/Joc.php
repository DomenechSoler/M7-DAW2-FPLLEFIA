<?php
class Joc {
    public $jugadors = [];
    public $tornActual = 0; 
    public $estatJoc = 'en curs';

    public function __construct() {
        $this->jugadors = [];
    }

    public function afegirJugador($jugador) {
        $this->jugadors[] = $jugador;
    }

    public function iniciarPartida() {
        $this->tornActual = rand(0, 1);  
        echo "El joc comença amb el torn de " . $this->jugadors[$this->tornActual]->getNom() . ".\n";
    }

    public function processarTorn($accio, $objectiu) {
        $jugadorActual = $this->jugadors[$this->tornActual];

        $jugadorActual->realitzarAccio($accio, $objectiu);

        $this->tornActual = ($this->tornActual + 1) % 2;

        $this->comprovarGuanyador();
    }

    public function comprovarGuanyador() {
        if ($this->jugadors[0]->dutton->getSalut() <= 0) {
            $this->estatJoc = 'finalitzat';
            echo "{$this->jugadors[1]->nom} ha guanyat!\n";
        } elseif ($this->jugadors[1]->dutton->getSalut() <= 0) {
            $this->estatJoc = 'finalitzat';
            echo "{$this->jugadors[0]->nom} ha guanyat!\n";
        }
    }

   public function setEstatJoc($estat) {
    $this->estatJoc = $estat;
}
}


?>