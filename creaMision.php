<?php

	require_once('inc/modelo/dao_tokenAdmin.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/tokenAdmin.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];
	$nombre = $_GET['nombre'];
	$desc = $_GET['desc'];
	$tiempo = $_GET['tiempo'];
	$nivel = $_GET['nivel'];
	$poder = $_GET['poder'];
	$fallo = $_GET['fallo'];
	$jug = $_GET['jug'];
	$rc = $_GET['rc']; //Recompensa comida
	$re = $_GET['re']; //Recompensa exp
	$rma = $_GET['rma']; //Recompensa madera
	$rme = $_GET['rme']; //Recompensa metal
	$rp = $_GET['rp']; //Recompensa piedra
	$rb = $_GET['rb']; //Recompensa rubies

	$t = DaoTokenAdmin::getDao()->porToken($token);
	
	
	if ($t != null)
	{
		if ($nombre==null || $desc==null || $tiempo == null || $nivel == null || $poder == null	||
			$fallo == null || $jug == null || $rc == null || $re == null || $rma == null ||
			$rme == null || $rp == null || $rb == null)
				echo json_encode(array ("tipo"=>"error", "msn" =>"faltanParametros"));
		else{
			$id = UtilWeb::creaMision($nombre,$desc,$tiempo, $nivel, $poder,	
			$fallo, $jug, $rc, $re, $rma,$rme, $rp, $rb)->id;
			if($id != -1)
				echo json_encode(array ("tipo"=>"ok", "id"=>$id));
			else 
				echo json_encode(array ("tipo"=>"error", "msn" =>"existeMision"));
		}
	}
	
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
