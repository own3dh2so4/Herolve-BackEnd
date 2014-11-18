<?php 

require_once('inc/modelo/dao_mundo.php');
require_once('inc/modelo/mundo.php');
require_once('util/utilWeb.php');
require_once('inc/util.php');
require_once('inc/common.php');


$mundos = UtilWeb::getMundos();
echo json_encode(array ("tipo"=>"ok", "mundos" => $mundos));


