<?php
include "sesi_petugas.php";
if(isset($_GET['id_batangan'])){
	include "../koneksi.php";
	$id=$_GET['id_batangan'];
	$sql   = "SELECT * FROM tb_batangan WHERE id_batangan='$id'";
	$hapus = mysqli_query($koneksi,$sql);
	$r     = mysqli_fetch_array($hapus);
	
		$foto_mou=$r['foto_mou'];
		// hapus file gambar yang berhubungan dengan berita tersebut
		unlink("../images/foto_mou/$foto_mou");
		$sql1   = "DELETE FROM tb_batangan WHERE id_batangan='$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){
//			echo 'Data Kelas Berhasil di Hapus ';
//			echo '<a href="index.php">Kembali</a>';
	header("Location: ?m=batanganUnit&s=title");
	}else{
		echo 'Data Kelas GAGAL di Hapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
