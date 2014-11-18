<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$msn = $_GET['msn'];
	$para = $_GET['para'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		if(UtilWeb::enviarMensaje($t,$para, $msn ))
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

