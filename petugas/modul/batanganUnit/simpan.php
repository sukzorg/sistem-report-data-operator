<?php
include '../koneksi.php';

    // Pastikan user sudah login dan memiliki sesi cabang
    if (!isset($_SESSION['userinv2'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
        exit;
    }

        // Ambil cabang dan jabatan dari sesi login
        $cabang_user = $_SESSION['cabanginv2'];  // Cabang admin yang sedang login

// Cek apakah form disubmit
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $nama_operator = mysqli_real_escape_string($koneksi, $_POST['nama_operator']);
    $penempatan = mysqli_real_escape_string($koneksi, $_POST['penempatan']);
    $jenis_unit = mysqli_real_escape_string($koneksi, $_POST['jenis_unit']);
    $merek_unit = mysqli_real_escape_string($koneksi, $_POST['merek_unit']);
    $tonase = mysqli_real_escape_string($koneksi, $_POST['tonase']);
    $no_unit = mysqli_real_escape_string($koneksi, $_POST['no_unit']);
    $nama_helper = mysqli_real_escape_string($koneksi, $_POST['nama_helper']);
    $foto_mou = $_FILES['foto_mou']['name'];

    // Validasi jika ada field kosong
    if (empty($nama_operator) || empty($penempatan) || empty($jenis_unit) || empty($merek_unit) || empty($tonase) || empty($no_unit) || empty($nama_helper) || empty($foto_mou)) {
        echo "<script>alert('Harap isi semua field dan upload foto MOU!'); window.history.back();</script>";
        exit;
    }

    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Proses upload foto mou
    $tmp_name = $_FILES['foto_mou']['tmp_name'];
    $upload_dir = '../images/foto_mou/';
    $target_file = $upload_dir . basename($foto_mou);

    if (move_uploaded_file($tmp_name, $target_file)) {
        // Hanya ambil nama file untuk disimpan di database
        $nama_file = basename($foto_mou);

        // Simpan nama file ke database
        $sql = "INSERT INTO tb_batangan (nama_operator, penempatan, jenis_unit, merek_unit, tonase, no_unit, nama_helper, foto_mou) 
                VALUES ('$nama_operator', '$penempatan', '$jenis_unit', '$merek_unit', '$tonase', '$no_unit', '$nama_helper', '$nama_file')";

        if (mysqli_query($koneksi, $sql)) {
            // Redirect ke halaman utama atau halaman sukses
            echo "<script>alert('Data berhasil disimpan!'); window.location.href='?m=batanganUnit&s=awal';</script>";
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload foto MOU. Pastikan file valid dan coba lagi.'); window.history.back();</script>";
    }
}
?>
