<?php

require_once 'dao_usuariosAdmin.php';

class UsuarioAdmin{
	public $id;
	public $nick;
	public $hash;
	public $salt;
	
	/**
     * crea un nuevo usuario y lo inserta en la BD.
     */
    public static function crea($login, $pass_, $hash, $salt) {
        if (DaoUsuarioAdmin::getDao()->porLogin($login) != null) {
            return "Usuario existente - elije otro login";
        } else if ( !( mb_strlen($login) >= 4 && mb_strlen($pass_) >= 4)) {
	        return "Login ó contraseña demasiado cortos";
	    } else {
			
	        $u = new Usuario();
			$u->id=0;
	        $u->nick = $login;
	        $u->salt = $salt;
        	$u->hash = $hash;
            DaoUsuarioAdmin::getDao()->save($u);
        	return $u;
	    }
	} 

}