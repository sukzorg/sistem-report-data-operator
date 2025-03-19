<?php

include_once "sesi_petugas.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/my_profile/title.php"; break;
	case 'simpan': include "modul/my_profile/simpan.php"; break;
	case 'hapus': include "modul/my_profile/hapus.php"; break;
	case 'ubah': include "modul/my_profile/ubah.php"; break;
	case 'update': include "modul/my_profile/update.php"; break;
	
}
?>
