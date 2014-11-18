<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$nombreHeroe = $_GET['heroe'];
	$idMundo = $_GET['idMundo'];

	$t = DaoTokenAdmin::getDao()->porToken($token);
	if ($t != null)
	{
		if (isset($_GET['comida']))
			$comida = $_GET['comida'];
		else
			$comida = null;
		if (isset($_GET['madera']))
			$madera = $_GET['madera'];
		else
			$madera = null;
		if (isset($_GET['magos']))
			$magos = $_GET['magos'];
		else
			$magos = null;
		if (isset($_GET['metal']))
			$metal = $_GET['metal'];
		else
			$metal = null;
		if (isset($_GET['piedra']))
			$piedra = $_GET['piedra'];
		else
			$piedra = null;
		if (isset($_GET['rubies']))
			$rubies = $_GET['rubies'];
		else
			$rubies = null;
		if (isset($_GET['soldados']))
			$soldados = $_GET['soldados'];
		else
			$soldados = null;
		
		if ($nombreHeroe==null && $idMundo==null)
			echo json_encode(array ("tipo"=>"error", "msn" =>"badParams"));
		if ( UtilWeb::setRecursos($nombreHeroe,$idMundo,$comida,$madera,$magos,$metal,$piedra,$rubies,$soldados))
			echo json_encode(array ("tipo"=>"ok"));
		else
			echo json_encode(array ("tipo"=>"error", "msn" =>"noExisteHeroe"));
	}
	else{
		echo json_encode(array ("tipo"=>"error", "msn" =>"badToken"));
	}
