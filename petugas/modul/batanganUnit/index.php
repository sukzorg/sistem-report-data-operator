<?php

include_once "sesi_petugas.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/batanganUnit/title.php"; break;
	case 'simpan': include "modul/batanganUnit/simpan.php"; break;
	case 'hapus': include "modul/batanganUnit/hapus.php"; break;
	case 'ubah': include "modul/batanganUnit/ubah.php"; break;
	case 'update': include "modul/batanganUnit/update.php"; break;
	case 'detail_foto': include "modul/batanganUnit/detail_foto.php"; break;
	case 'export_pdf': include "modul/batanganUnit/export_pdf.php"; break;


}
?>
