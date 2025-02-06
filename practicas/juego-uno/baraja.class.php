<?php 

class Baraja{
	public $conjunto_cartas=[];

	function __construct(){ 
		$this->conjunto_cartas=[];
	}

	function crea_baraja(){
		$palo = ['yellow','red','green','blue'];
		$numero = [1,2,3,4,5,6,7,8,9,0,'reverse','skip','picker',];
	
		$ind = 0;
		foreach ($palo as $value1) {
			foreach ($numero as $value2) { 
				$ind ++;
				$c = new Carta($value1,$value2,$ind); 
				array_push($this->conjunto_cartas,$c);
			}
		} 
	}

	public function mezcla(){
		shuffle ($this->conjunto_cartas);
	}
	public function pinta_baraja(){
		foreach ($this->conjunto_cartas as $posicion=>$w){
			$w->pinta_carta_link($posicion);
			echo '<br>';
		}
	}

	public function pinta_baraja_girada(){
		foreach ($this->conjunto_cartas as $posicion=>$v){
			$v->pinta_carta_girada($posicion);
			echo '<br>';
		}
	}
}

 ?>
