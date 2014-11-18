<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/modelo/dao_recursos.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');
	
	$token = $_GET['token'];
	$idEdificio = $_GET['idEdificio'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		
		echo UtilWeb::mejoraEdificio($t,$idEdificio);
		//json_encode(array("tipo"=>"ok","r"=>$r));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
