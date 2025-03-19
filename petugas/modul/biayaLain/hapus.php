<?php
include "sesi_petugas.php";
if(isset($_GET['id_biaya'])){
	include "../koneksi.php";
	$id=$_GET['id_biaya'];
	$sql   = "SELECT * FROM tb_lain_lain WHERE id_biaya='$id'";
	$hapus = mysqli_query($koneksi,$sql);
	$r     = mysqli_fetch_array($hapus);
	
		$foto_keterangan=$r['foto_keterangan'];
		// hapus file gambar yang berhubungan dengan berita tersebut
		unlink("../images/foto_keterangan/$foto_keterangan");
		$sql1   = "DELETE FROM tb_lain_lain WHERE id_biaya='$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){
//			echo 'Data Kelas Berhasil di Hapus ';
//			echo '<a href="index.php">Kembali</a>';
	header("Location: ?m=biayaLain&s=title");
	}else{
		echo 'Data Kelas GAGAL di Hapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
