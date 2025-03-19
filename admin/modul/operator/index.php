<?php

include_once "sesi_admin.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/operator/title.php"; break;
	case 'simpan': include "modul/operator/simpan.php"; break;
	case 'hapus': include "modul/operator/hapus.php"; break;
	case 'ubah': include "modul/operator/ubah.php"; break;
	case 'update': include "modul/operator/update.php"; break;
	case 'detail_foto': include "modul/operator/detail_foto.php"; break;
	case 'export_pdf': include "modul/operator/export_pdf.php"; break;

}
?>
