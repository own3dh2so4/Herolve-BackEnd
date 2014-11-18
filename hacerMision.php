<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idMision = $_GET['idMision'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$bool = UtilWeb::hacerMision($t,$idMision);
		if ($bool)
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "msn"=>"fallo"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
