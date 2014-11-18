<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$user = $_GET['user'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$h = UtilWeb::getMensajesFromUser($t, $user);
		if($h==false)
			echo json_encode(array ("tipo"=>"error", "msn"=>"noMensajes"));
		else
			echo json_encode(array ("tipo"=>"ok", "mensajes"=>$h));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
