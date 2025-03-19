<?php
session_start();
include_once "sesi_petugas.php";
$modul=(isset($_GET['m']))?$_GET['m']:"awal";
$jawal="Petugas || INV Petugas";
switch($modul){
    case 'awal': default: $aktif="Beranda"; $judul="Beranda $jawal"; include "awal.php"; break;
    case 'barangMasuk': $aktif="Barang Masuk"; $judul="Modul Barang Masuk "; include "modul/barangMasuk/index.php"; break;
    case 'my_profile': $aktif="My Profile"; $judul="My Profile"; include "modul/my_profile/index.php"; break;
    case 'operator': $aktif="Operator"; $judul="Operator"; include "modul/operator/index.php"; break;
    case 'statusOperator': $aktif="Status Operator"; $judul="Status Operator"; include "modul/statusOperator/index.php"; break;
    case 'rapot_opr': $aktif="Rapot Operator"; $judul="Rapot Operator "; include "modul/rapot_opr/index.php"; break;
    case 'batanganUnit': $aktif="Batangan Unit"; $judul="Batangan Unit "; include "modul/batanganUnit/index.php"; break;
    case 'biayaLain': $aktif="Biaya Lain Lain"; $judul="Biaya Lain Lain "; include "modul/biayaLain/index.php"; break;
    case 'mutasi': $aktif="Pengajuan Mutasi"; $judul="Pengajuan Mutasi "; include "modul/mutasi/index.php"; break;
}

?>
