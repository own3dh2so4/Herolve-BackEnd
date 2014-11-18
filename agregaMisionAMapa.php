<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$idMapa = $_GET['idMapa'];
	$idMision = $_GET['idMision'];
	$posicion =  $_GET['posicion'];
	$x = $_GET['x'];
	$y = $_GET['y'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		if ($idMapa==null || $idMision==null || $x==null || $y == null)
			echo json_encode(array ("tipo"=>"error", "msn" =>"faltaidMapa"));
		else{
			if(UtilWeb::agregarMisionAMapa($idMapa, $idMision,$posicion, $x, $y))
				echo json_encode(array ("tipo"=>"ok"));
			else
				echo json_encode(array ("tipo"=>"error", "msn"=>"errorDeCreacion"));
		}
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
