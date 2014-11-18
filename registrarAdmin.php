<?php

require_once('inc/util.php'); 
require_once('inc/modelo/dao_usuariosAdmin.php');
require_once('inc/modelo/usuariosAdmin.php');
require_once('inc/common.php');

$nombreUsuario = $_GET['nombreUsuario'];
$contrasenaUsuario = $_GET['contrasenaUsuario'];
$salt = Util::aleat(10);
$hash = Util::hash($contrasenaUsuario,$salt);
$token = $_GET['token'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
{
	if ( $nombreUsuario==null || $contrasenaUsuario==null ) {
			echo json_encode(array ("tipo"=>"error", "msn" => "faltandatos"));
	}else if (DaoUsuarioAdmin::getDao()->porLogin($nombreUsuario) != null) {
			echo json_encode(array ("tipo"=>"error", "msn" => "existeuser"));
	} else if ( ! UsuarioAdmin::crea($nombreUsuario, $contrasenaUsuario, $hash, $salt)) {
			echo json_encode(array ("tipo"=>"error", "msn" => "fallocreandouser"));		
	} else {
			// creado bien - creamos su sesion y le redirigimos al index, 
			// para que no siga creando usuarios
			
			
			
					
			echo json_encode(array ("tipo"=>"ok"));		
			
		}
}

else{
		echo json_encode(array( "tipo"=>"error", "msn"=>"undefinedToken"));
	}