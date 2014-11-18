<?php

	require_once ('dao_amigos.php');
class Amigos {
	public $id;
	public $id_user1;
	public $id_user2;
	public $estado;
	
	public static function crea ($id_user1, $id_user2){
		
		
			$a = new Heroe();
			$a->id = 0;
			$a->id_user1 = $id_user1;
			$a->id_user2 = $id_user2;
			$a->estado = "a";
            DaoAmigos::getDao()->save($a);
        	return $a;
	   
	} 
	
	public function __construct (){
		
	}
	
	public function setId ($id){
		$this->id = $id;
	}
	
	public function setIdUser1 ($id_user1){
		$this->id_user1 = $id_user1;
	}
	
	public function setIdUser2 ($id_user2){
		$this->id_user2 = $id_user2;
	}
	
	public function getId (){
		return $this->id;
	}
	
	public function getIdUser1 (){
		return $this->id_user1;
	}
	
	public function getIdUser2 (){
		return $this->id_user2;
	}
	
}