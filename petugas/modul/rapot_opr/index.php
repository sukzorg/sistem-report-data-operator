<?php

include_once "sesi_petugas.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/rapot_opr/title.php"; break;
	case 'simpan': include "modul/rapot_opr/simpan.php"; break;
	case 'hapus': include "modul/rapot_opr/hapus.php"; break;
	case 'ubah': include "modul/rapot_opr/ubah.php"; break;
	case 'update': include "modul/rapot_opr/update.php"; break;
	case 'detail_foto': include "modul/rapot_opr/detail_foto.php"; break;
	case 'export_pdf': include "modul/rapot_opr/export_pdf.php"; break;


}
?>
