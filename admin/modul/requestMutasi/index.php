<?php

include_once "sesi_admin.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/requestMutasi/title.php"; break;
	case 'reject': include "modul/requestMutasi/reject.php"; break;
	case 'approved': include "modul/requestMutasi/approved.php"; break;
	case 'view_approved': include "modul/requestMutasi/view_approved.php"; break;

}
?>
