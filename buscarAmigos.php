<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$nombreAmigo = $_GET['amigo'];

	
	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		if($nombreAmigo!=""){
			
			$h = UtilWeb::buscarAmigos($nombreAmigo);
			echo json_encode(array ("tipo"=>"ok", "amigos"=>$h));
		}
		else{
			echo json_encode(array ("tipo"=>"error", "msn"=>"BadNick"));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

