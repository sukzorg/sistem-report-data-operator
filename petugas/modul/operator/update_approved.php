<?php
include '../koneksi.php';

// Pastikan user sudah login dan memiliki sesi cabang
if (!isset($_SESSION['userinv2'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

// Ambil cabang dan jabatan dari sesi login
$cabang_user = $_SESSION['cabanginv2'];  // Cabang admin yang sedang login

// Mengecek jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_operator = $_POST['id_operator'];
    $nama_operator = $_POST['nama_operator'];
    $penempatan_opr_baru = $_POST['penempatan_opr_baru'];
    $status_opr_baru = $_POST['status_opr_baru'];
    $status_approval = $_POST['status_approval'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];

    // Validasi simpan data, admin hanya bisa menyimpan data untuk cabang yang sama
    if ($cabang_user != $penempatan_opr) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Jika status tidak diisi, tetap gunakan status lama (jika ada)
    if (!$status) {
        $status = $result['status'];  // Mengambil status sebelumnya jika tidak ada input baru
    }

    // Query untuk memasukkan data mutasi ke dalam tb_mutasi_opr
    $sql_mutasi = "INSERT INTO tb_mutasi_operator (
        id_operator, 
        nama_operator, 
        penempatan_opr_baru, 
        status_opr_baru,
        status_approval,
        tgl_pengajuan, 
    ) VALUES (
        '$id_operator', 
        '$nama_operator', 
        '$penempatan_opr_baru', 
        '$status_opr_baru', 
        '$status_approval', 
        '$tgl_pengajuan', 

    )";

    // Eksekusi query
    $insert = mysqli_query($koneksi, $sql_mutasi);

    if ($insert) {
        echo "<script>alert('Data berhasil diajukan untuk mutasi');</script>";
        header('Location: ?m=operator&s=title');
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengajukan mutasi');</script>";
    }
}
?>
