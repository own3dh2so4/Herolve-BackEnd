<?php

require_once('inc/modelo/tokenAdmin.php');

class TokenAdmin{
	
	public $id;
	public $token;
	
	public static function crea ($id, $token){
		if (DaoTokenAdmin::getDao()->porId($id) != null) {
            return "Fallo, id repetido";
		}else if (DaoTokenAdmin::getDao()->porToken($token) != null) {
            return "Fallo, token repetido";
		}else {
			$t = new TokenAdmin();
			$t->id=$id;
			$t->token=$token;
			DaoTokenAdmin::getDao()->create($t);
			return $t;
		}
	}
	
	public function __construct(){
		
	}

}
