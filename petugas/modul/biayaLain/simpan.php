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
    $keterangan_biaya = mysqli_real_escape_string($koneksi, $_POST['keterangan_biaya']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu']);
    $foto_keterangan = $_FILES['foto_keterangan']['name'];

    // Validasi jika ada field kosong
    if (empty($nama_operator) || empty($penempatan) || empty($jenis_unit) || empty($merek_unit) || empty($tonase) || empty($no_unit) || empty($keterangan_biaya) || empty($waktu) || empty($foto_keterangan)) {
        echo "<script>alert('Harap isi semua field dan upload foto keterangan!'); window.history.back();</script>";
        exit;
    }

    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }
    
    // Proses upload foto keterangan
    $tmp_name = $_FILES['foto_keterangan']['tmp_name'];
    $upload_dir = '../images/foto_keterangan/';
    $target_file = $upload_dir . basename($foto_keterangan);

    if (move_uploaded_file($tmp_name, $target_file)) {
        // Hanya ambil nama file untuk disimpan di database
        $nama_file = basename($foto_keterangan);

        // Simpan nama file ke database
        $sql = "INSERT INTO tb_lain_lain (nama_operator, penempatan, jenis_unit, merek_unit, tonase, no_unit, keterangan_biaya, waktu, foto_keterangan) 
                VALUES ('$nama_operator', '$penempatan', '$jenis_unit', '$merek_unit', '$tonase', '$no_unit', '$keterangan_biaya','$waktu', '$nama_file')";

        if (mysqli_query($koneksi, $sql)) {
            // Redirect ke halaman utama atau halaman sukses
            echo "<script>alert('Data berhasil disimpan!'); window.location.href='?m=biayaLain&s=awal';</script>";
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload foto Keterangan. Pastikan file valid dan coba lagi.'); window.history.back();</script>";
    }
}
?>
