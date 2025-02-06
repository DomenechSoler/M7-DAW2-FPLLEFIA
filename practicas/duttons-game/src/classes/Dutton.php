<?php

class Duttons {

    public $id;      
    public string $nom;     
    public int $salut;   
    public int $dany;      
    public $imatge;     
    public $habilitats;  

    public function __construct($id, string $nom, int $salut, int $dany, $imatge, $habilitats = []) {
        $this->id = $id;
        $this->nom = $nom;
        $this->salut = $salut;
        $this->dany = $dany;
        $this->imatge = $imatge;
        $this->habilitats = $habilitats; 
    }


    public function obtenirHabilitats() {
        return implode(', ', $this->habilitats);
    }

    public function getId() {
        return $this->id;
    }

    public function getNom(): string  {
        return $this->nom;
    }

    public function getSalut(): int  {
        return $this->salut;
    }

    public function getDany(): int  {
        return $this->dany;
    }

    public function getImatge() {
        return $this->imatge;
    }

    public function getHabilitats() {
        return $this->habilitats;
    }

    public function setSalut($salut) {
        $this->salut = $salut;
    }

    public function setDany($dany) {
        $this->dany = $dany;
    }
}
