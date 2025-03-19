<?php
include "sesi_admin.php";
if(isset($_GET['id_operator'])){
	include "../koneksi.php";
	$id=$_GET['id_operator'];
	$sql   = "SELECT * FROM tb_operator WHERE id_operator='$id'";
	$hapus = mysqli_query($koneksi,$sql);
	$r     = mysqli_fetch_array($hapus);
	
		$foto_sio=$r['foto_sio'];
		// hapus file gambar yang berhubungan dengan berita tersebut
		unlink("../images/foto_sio/$foto_sio");
		$sql1   = "DELETE FROM tb_operator WHERE id_operator='$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){
//			echo 'Data Kelas Berhasil di Hapus ';
//			echo '<a href="index.php">Kembali</a>';
	header("Location: ?m=operator&s=awal");
	}else{
		echo 'Data Kelas GAGAL di Hapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
