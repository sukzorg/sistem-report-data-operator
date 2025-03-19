<?php
include '../koneksi.php';

// Pastikan user sudah login dan memiliki sesi cabang
if (!isset($_SESSION['userinv2'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

// Mengecek jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_operator = $_POST['id_operator'];
    $nama_operator = $_POST['nama_operator'];
    $penempatan_opr_baru = $_POST['penempatan_opr_baru'];
    $status_opr_baru = $_POST['status_opr_baru'];
    $status_approval = $_POST['status_approval'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];

    // Jika status tidak diisi, tetap gunakan status lama (jika ada)
    if (empty($status_opr_baru)) {
        // Ambil status sebelumnya dari database jika tidak ada status baru
        $sql_status = "SELECT status FROM tb_mutasi_operator WHERE id_operator = '$id_operator' ORDER BY tgl_pengajuan DESC LIMIT 1";
        $result_status = mysqli_query($koneksi, $sql_status);
        if ($result_status && mysqli_num_rows($result_status) > 0) {
            $row_status = mysqli_fetch_assoc($result_status);
            $status_opr_baru = $row_status['status'];  // Mengambil status sebelumnya jika tidak ada input baru
        }
    }

    // Query untuk memasukkan data mutasi ke dalam tb_mutasi_operator
    $sql_mutasi = "INSERT INTO tb_mutasi_operator (
        id_operator, 
        nama_operator, 
        penempatan_opr_baru, 
        status_opr_baru, 
        status_approval, 
        tgl_pengajuan
    ) VALUES (
        ?, ?, ?, ?, ?, ?
    )";

    // Persiapkan statement dan bind parameter untuk menghindari SQL Injection
    if ($stmt = mysqli_prepare($koneksi, $sql_mutasi)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $id_operator, $nama_operator, $penempatan_opr_baru, $status_opr_baru, $status_approval, $tgl_pengajuan);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil diajukan untuk mutasi');</script>";
            header('Location: ?m=mutasi&s=title');
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengajukan mutasi');</script>";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Terjadi kesalahan dalam query');</script>";
    }
}
?>
