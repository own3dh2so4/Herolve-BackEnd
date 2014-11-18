<?php

require_once('inc/util.php');
require_once('inc/common.php');
require_once('inc/modelo/dao_usuarios.php');

	$nombreUsuario = $_GET['nombreUsuario'];
	
	$user = DaoUsuario::getDao()->porLogin($nombreUsuario);
	if ($user==null)
		echo json_encode(array ("tipo"=>"error", "msn" => "baduser"));
	else {		
		
		echo  json_encode(array ("tipo"=>"ok","salt"=>$user->salt));
	}
