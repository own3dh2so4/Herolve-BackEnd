<?php

require_once('inc/util.php'); 
require_once('inc/modelo/dao_usuarios.php');
require_once('inc/modelo/dao_heroes.php');
require_once('inc/common.php');
require_once('inc/modelo/heroes.php');
require_once('inc/modelo/edificios_heroe.php');
require_once('inc/modelo/recursos.php');
require_once('util/utilWeb.php');

$nombreUsuario = $_GET['nombreUsuario'];
$contrasenaUsuario = $_GET['contrasenaUsuario'];
$emailUsuario = $_GET['emailUsuario'];
$salt = Util::aleat(10);
$hash = Util::hash($contrasenaUsuario,$salt);
$nombreHeroe = $_GET['nombreHeroe'];
$mundo = 1; // AQUI HAY QUE LEER ELMUNDO.



if ( $nombreUsuario==null || $contrasenaUsuario==null || $emailUsuario ==null) {
		echo json_encode(array ("tipo"=>"error", "msn" => "faltandatos"));
}else if (DaoUsuario::getDao()->porLogin($nombreUsuario) != null) {
		echo json_encode(array ("tipo"=>"error", "msn" => "existeuser"));
}else if (DaoHeroe::getDao()->porNombre($nombreHeroe,$mundo) !=null){
		echo json_encode(array ("tipo"=>"error", "msn" => "existeheroe"));
} else if ( ! Usuario::crea($nombreUsuario, $contrasenaUsuario, $emailUsuario, $hash, $salt)) {
		echo json_encode(array ("tipo"=>"error", "msn" => "fallocreandouser"));		
} else {
		// creado bien - creamos su sesion y le redirigimos al index, 
		// para que no siga creando usuarios
		
		$u = DaoUsuario::getDao()->porLogin($nombreUsuario);
		
		if ($nombreHeroe!=null)
			$h = Heroe::crea($u->id, $nombreHeroe, $mundo);
		//Aqui creariamos todos los edificios.
		$e1 = EdificioHeroe::crea($h->id, 1, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 2, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 3, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 4, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 5, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 6, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 7, "d",0);
		$e1 = EdificioHeroe::crea($h->id, 8, "d",0);
		
		
		//Aqui irian los recursos
		$madera = Recursos::crea($h->id, "madera", 50);
		$piedra = Recursos::crea($h->id, "piedra", 50);
		$comida = Recursos::crea($h->id, "comida", 10);
		$metal = Recursos::crea($h->id, "metal", 0);
		$rubies = Recursos::crea($h->id, "rubies", 0);
		$soldados = Recursos::crea($h->id, "soldados", 5);
		$magos = Recursos::crea($h->id, "magos", 5);
		
		
		UtilWeb::inicializaMisiones($h);
		
		UtilWeb::setNotificacion ($h->id, "Te has registrado!");
		
				
		echo json_encode(array ("tipo"=>"ok"));
			
		
	}

