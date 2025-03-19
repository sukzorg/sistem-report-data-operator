<?php
session_start();
include_once "sesi_admin.php";
$modul=(isset($_GET['m']))?$_GET['m']:"awal";
$jawal="Admin || INV Admin";
switch($modul){
    case 'awal': default: $aktif="Beranda"; $judul="Beranda $jawal"; include "awal.php"; break;
    case 'admin': $aktif="Admin"; $judul="Modul $jawal"; include "modul/admin/index.php"; break;
    case 'petugas': $aktif="Petugas"; $judul="Modul Petugas "; include "modul/petugas/index.php"; break;
    case 'operator': $aktif="Barang"; $judul="Modul Operator"; include "modul/operator/index.php"; break;
    case 'barangKeluar': $aktif="Barang Keluar"; $judul="Modul Barang Keluar "; include "modul/barangKeluar/index.php"; break;
    case 'statusOperator': $aktif="Status Operator"; $judul="Modul Status Operator "; include "modul/statusOperator/index.php"; break;
    case 'rapot_opr': $aktif="Rapot Operator"; $judul="Rapot Operator "; include "modul/rapot_opr/index.php"; break;
    case 'batanganUnit': $aktif="Batangan Unit"; $judul="Batangan Unit "; include "modul/batanganUnit/index.php"; break;
    case 'biayaLain': $aktif="Biaya Lain Lain"; $judul="Biaya Lain Lain "; include "modul/biayaLain/index.php"; break;
    case 'requestMutasi': $aktif="Request Mutasi"; $judul="Request Mutasi "; include "modul/requestMutasi/index.php"; break;

}

?>
