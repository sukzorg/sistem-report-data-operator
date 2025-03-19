<?php
error_reporting(0);
include "sesi_admin.php";

if (isset($_POST['simpan'])) {
    include "../koneksi.php";

    // Ambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $telepon = trim($_POST['telepon']);
    $cabang = trim($_POST['cabang']);

    // Pastikan user login dan memiliki sesi cabang
    if (!isset($_SESSION['userinv'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
        exit;
    }

    // Ambil cabang dari sesi login
    $cabang_user = $_SESSION['cabanginv'];

    // Validasi data kosong
    if (empty($username) || empty($password) || empty($nama) || empty($jabatan) || empty($telepon) || empty($cabang)) {
        echo "<script>alert('Semua field harus diisi! Silakan cek ulang.'); window.history.back();</script>";
        exit; // Menghentikan eksekusi lebih lanjut
    }

    // Jika jabatan adalah Korcap, pastikan cabang yang dimasukkan sesuai dengan cabang user
    if ($jabatan == 'Korcap' && $cabang != $cabang_user) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit; // Menghentikan eksekusi lebih lanjut
    }

    // Hash password
    $hashed_password = md5($password);

    // Cek username
    $sql = "SELECT * FROM tb_admin WHERE username = '$username'";
    $tambah = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_row($tambah);

    if ($row) {
        echo "<script>alert('Username sudah ada! Silakan gunakan username lain.'); window.history.back();</script>";
    } else {
        // Simpan data ke database
        $sql = "INSERT INTO tb_admin (username, password, nama, jabatan, telepon, cabang) 
                VALUES ('$username', '$hashed_password', '$nama', '$jabatan', '$telepon', '$cabang')";
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='?m=admin&s=awal';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data! Silakan coba lagi.'); window.history.back();</script>";
        }
    }
}
?>
