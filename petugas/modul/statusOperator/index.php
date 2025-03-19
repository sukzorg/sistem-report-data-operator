<?php

include_once "sesi_petugas.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/statusOperator/title.php"; break;
	case 'paging': include "modul/statusOperator/paging.php"; break;
	case 'control': include "modul/statusOperator/control.php"; break;
	
}
?>
