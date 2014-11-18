<?php

require_once('inc/modelo/token.php');

class Token{
	
	public $id;
	public $token;
	
	public static function crea ($id, $token){
		if (DaoToken::getDao()->porId($id) != null) {
            return "Fallo, id repetido";
		}else if (DaoToken::getDao()->porToken($token) != null) {
            return "Fallo, token repetido";
		}else {
			$t = new Token();
			$t->id=$id;
			$t->token=$token;
			DaoToken::getDao()->create($t);
			return $t;
		}
	}
	
	public function __construct(){
		
	}

}
