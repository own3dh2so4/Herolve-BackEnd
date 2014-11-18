<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		UtilWeb::unLogAdmin($t);
		echo json_encode(array( "tipo"=>"ok"));
	}
	else{
		echo json_encode(array( "tipo"=>"error", "msn"=>"undefinedToken"));
	}

