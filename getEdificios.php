<?php

	require_once('util/utilWeb.php');
	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');

	$token = $_GET['token'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$e = UtilWeb::getEdificios ();
		echo json_encode(array ("tipo"=>"ok", "edificios"=>$e));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
