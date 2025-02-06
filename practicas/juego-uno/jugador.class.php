<?php 
class Jugador{

	public $mano;
	public $id;

	function __construct($ID){
		$this->mano = new Baraja(); 
		$this->id = $ID;

	}
	


}
 
 ?>
