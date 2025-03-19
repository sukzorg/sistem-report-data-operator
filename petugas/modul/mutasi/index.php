<?php

include_once "sesi_petugas.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/mutasi/title.php"; break;
	case 'form_approved': include "modul/mutasi/form_approved.php"; break; // Title (index)
	case 'update_approved': include "modul/mutasi/update_approved.php"; break; // Controller Pengajuan Mutasi --> tb_mutasi
	case 'view_approved': include "modul/mutasi/view_approved.php"; break; // Page Menampilkan data yang diajukan

}
?>
