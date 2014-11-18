<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		$conectados = UtilWeb::getUsuariosConectadosNumero();
		if ($conectados==null)
			echo json_encode(array ("tipo"=>"ok", "usuarios" => 0));
		else{
			echo json_encode(array ("tipo"=>"ok", "usuarios" => $conectados));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
