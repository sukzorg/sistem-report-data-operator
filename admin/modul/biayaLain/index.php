<?php

include_once "sesi_admin.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/biayaLain/title.php"; break;
	case 'simpan': include "modul/biayaLain/simpan.php"; break;
	case 'hapus': include "modul/biayaLain/hapus.php"; break;
	case 'ubah': include "modul/biayaLain/ubah.php"; break;
	case 'update': include "modul/biayaLain/update.php"; break;
	case 'detail_foto': include "modul/biayaLain/detail_foto.php"; break;
	case 'export_pdf': include "modul/biayaLain/export_pdf.php"; break;


}
?>
