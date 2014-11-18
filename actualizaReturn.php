<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/modelo/dao_recursos.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');
	
	$token = $_GET['token'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		$recursos = UtilWeb::getRecursos($t);
		$misionTerminada = UtilWeb::terminoMision($t);
		$edificionTerminado = UtilWeb::actualizaEdificio($t);		
		$notificaciones = UtilWeb::getNotificaciones($t);
		echo json_encode(array("tipo"=>"ok","recursos" => $recursos, 
			"misionTerminada" => $misionTerminada, "edificioTerminado" =>$edificionTerminado
			, "notificaciones" => $notificaciones ));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));
