<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$nombreUser = $_GET['user'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		if ($nombreUser==null)
			echo json_encode(array ("tipo"=>"error", "msn" =>"noUser"));
		if ( UtilWeb::borraUserAdmin($nombreUser))
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "msn" =>"noExisteUser"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
