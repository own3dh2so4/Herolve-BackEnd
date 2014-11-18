<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$nick =  $_GET['nick'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		$info = UtilWeb::getInfoUser($nick);
		if ($info==false)
			echo json_encode(array ("tipo"=>"error", "msn" =>"fallo"));
		else{
			echo json_encode(array ("tipo"=>"ok", "info" => $info));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
