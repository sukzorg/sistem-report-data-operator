<?php
include "sesi_admin.php";
if(isset($_GET['id_laporan'])){
	include "../koneksi.php";
	$id=$_GET['id_laporan'];
	$sql   = "SELECT * FROM tb_laporan WHERE id_laporan='$id'";
	$hapus = mysqli_query($koneksi,$sql);
	$r     = mysqli_fetch_array($hapus);
	
		$foto_kejadian=$r['foto_kejadian'];
		// hapus file gambar yang berhubungan dengan berita tersebut
		unlink("../images/foto_kejadian/$foto_kejadian");
		$sql1   = "DELETE FROM tb_laporan WHERE id_laporan='$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){
//			echo 'Data Kelas Berhasil di Hapus ';
//			echo '<a href="index.php">Kembali</a>';
	header("Location: ?m=rapot_opr&s=title");
	}else{
		echo 'Data Kelas GAGAL di Hapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
