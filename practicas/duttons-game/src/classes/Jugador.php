<?php
class Jugador {
    public $nom;
    public $dutton;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function seleccionarDutton($dutton) {
        $this->dutton = $dutton;
    }
     public function getNom() {
        return $this->nom;
    }

    public function realitzarAccio($accio, $objectiu) {
        if ($accio == 'atacar') {
            $dany = $this->dutton->getDany();
            $objectiu->dutton->setSalut($objectiu->dutton->getSalut() - $dany);
            echo "{$this->nom} ha atacat a {$objectiu->nom} i li ha fet {$dany} de dany.\n";
            echo "Salut restant de {$objectiu->nom}: " . $objectiu->dutton->getSalut() . "\n";
        } elseif ($accio == 'habilitat') {
            echo "{$this->nom} ha activat una de les seves habilitats: " . $this->dutton->obtenirHabilitats() . "\n";
        }
    }
    
}
?>