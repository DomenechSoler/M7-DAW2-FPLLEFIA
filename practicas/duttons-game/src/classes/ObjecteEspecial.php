<?php
class ObjecteEspecial {
    public string $nom;
    public string $tipus;
    public float $valor; 
    public string $imatge;

    public function __construct(string $nom, string $tipus, float $valor, string $imatge) {
        $this->nom = $nom;
        $this->tipus = $tipus;
        $this->valor = $valor;
        $this->imatge = $imatge;
    }
}
?>