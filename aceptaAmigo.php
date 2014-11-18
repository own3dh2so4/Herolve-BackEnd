<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idUser2 = $_GET['usuarioAceptar'];
	
	$t = DaoToken::getDao()->porToken($token);
	
	if ($t != null)
	{
		$aceptado = UtilWeb::aceptaAmigo($t,$idUser2);
		if ($aceptado)
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "mns"=>"fallo"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

