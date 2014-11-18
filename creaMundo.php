<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$numMax = $_GET['max'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		if ($numMax==null)
			echo json_encode(array ("tipo"=>"error", "msn" =>"faltaNumMax"));
		else{
			UtilWeb::crearMundo($numMax);
			echo json_encode(array ("tipo"=>"ok"));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
