
<?php


class Usuario {
	public $id;
	public $nick;
	public $hash;
	public $salt;
	public $correo;
	public $estado;
	public $foto;


	/**
     * crea un nuevo usuario y lo inserta en la BD.
     */
    public static function crea($login_, $pass_, $correo, $hash, $salt) {
        if (DaoUsuario::getDao()->porLogin($login_) != null) {
            return "Usuario existente - elije otro login";
        } else if ( !( mb_strlen($login_) >= 4 && mb_strlen($pass_) >= 4)) {
	        return "Login ó contraseña demasiado cortos";
	    } else {
	        $u = new Usuario();
			$u->id=0;
	        $u->nick = $login_;
	        $u->salt = $salt;
        	$u->hash = $hash;
        	$u->correo = $correo;
			$u->estado = "c";
			$u->foto = 0;
            DaoUsuario::getDao()->save($u);
        	return $u;
	    }
	} 
	

	public function __construct (){
		

	}

	public function setId($id){
		$this->id = $id;
	}

	public function setNick($nick){
		$this->nick = $nick;
	}

	public function setHash ($hash){
		$this->hash = $hash;
	}
	public function setSalt($salt){
		$this->salt = $salt;
	}

	public function setCorreo($correo){
		$this->correo = $correo;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getId (){
		return $this->id;
	}

	public function getNick (){
		return $this->nick;
	}

	public function getHash (){
		return $this->hash;
	}

	public function getSalt (){
		return $this->salt;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function getEstado (){
		return $this->estado;
	}

}