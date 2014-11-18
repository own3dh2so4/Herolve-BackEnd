<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idMundo = $_GET['idMundo'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		if ($idMundo==null)
			echo json_encode(array ("tipo"=>"error", "msn" =>"faltaIdMundo"));
		else{
			UtilWeb::creaMapa($idMundo);
			echo json_encode(array ("tipo"=>"ok"));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
