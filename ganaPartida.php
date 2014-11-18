<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	
	$t = DaoToken::getDao()->porToken($token);
	
	if ($t != null)
	{
		$correcto = UtilWeb::ganaPartida($t);
		if ($correcto)
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "mns"=>"UndefinedProblem"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

