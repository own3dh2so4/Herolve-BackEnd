<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idM = $_GET['idMision'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$h = UtilWeb::getMision($idM);
		echo json_encode(array ("tipo"=>"ok", "mision"=>$h));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
