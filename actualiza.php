<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once ('util/utilWeb.php');

	$token = $_GET['token'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		
		UtilWeb::getRecursos($t);
		UtilWeb::getNotificaciones($t);
		UtilWeb::actualizaEdificio($t);
		UtilWeb::terminoMision($t);
		echo json_encode(array("tipo"=>"ok"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

