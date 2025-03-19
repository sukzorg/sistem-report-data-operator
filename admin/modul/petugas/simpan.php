<?php
include "sesi_admin.php";  // Memastikan session sudah dimulai

if (isset($_POST['simpan'])) {
    include "../koneksi.php";  // Menyertakan koneksi database

    // Ambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $nama = trim($_POST['nama']);
    $telepon = trim($_POST['telepon']);
    $cabang = trim($_POST['cabang']);

    // Pastikan user sudah login dan memiliki sesi cabang
    if (!isset($_SESSION['userinv'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
        exit;
    }

    // Ambil jabatan dan cabang dari sesi login
    $cabang_user = $_SESSION['cabanginv'];  // Cabang admin yang sedang login
    $jabatan_user = $_SESSION['jabataninv']; // Jabatan admin yang sedang login

    // Validasi input kosong
    if (empty($username) || empty($password) || empty($nama) || empty($telepon) || empty($cabang)) {
        echo "<script>alert('Semua field harus diisi! Silakan cek ulang.'); window.history.back();</script>";
        exit;
    }

    // Validasi berdasarkan jabatan admin
    if ($jabatan_user == "Korcap" && $cabang_user != $cabang) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Hash password
    $hashed_password = md5($password);

    // Cek apakah username sudah ada
    $sql = "SELECT * FROM tb_petugas WHERE username = '$username'";
    $tambah = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_row($tambah);

    if ($row) {
        echo "<script>alert('Username sudah ada! Silakan gunakan username lain.'); window.history.back();</script>";
    } else {
        // Simpan data ke database
        $sql = "INSERT INTO tb_petugas (username, password, nama, telepon, cabang) 
                VALUES ('$username', '$hashed_password', '$nama', '$telepon', '$cabang')";

        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='?m=petugas&s=awal';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data! Silakan coba lagi.'); window.history.back();</script>";
        }
    }
} else {
    echo "<script>alert('Form tidak valid!'); window.history.back();</script>";
}
?>
