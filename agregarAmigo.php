<?php
	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idAmigo = $_GET['amigoAgregar'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$bool = UtilWeb::agregarAmigo($t,$idAmigo);
		if ($bool)
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "msn"=>"error"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
	
