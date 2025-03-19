<?php 
include 'sesi_admin.php';  // Memastikan session sudah dimulai

if (isset($_POST['simpan'])) {
    include '../koneksi.php';  // Menyertakan koneksi database

    // Ambil data dari form
    $id_petugas = trim($_POST['id_petugas']);
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

    // Validasi input kosong (kecuali password)
    if (empty($username) || empty($nama) || empty($telepon) || empty($cabang)) {
        echo "<script>alert('Semua field kecuali password harus diisi! Silakan cek ulang.'); window.history.back();</script>";
        exit;
    }

    // Validasi berdasarkan jabatan admin
    if ($jabatan_user == "Korcap" && $cabang_user != $cabang) {
        echo "<script>alert('Anda hanya dapat memperbarui data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Jika password kosong, hanya update field lain
    if (empty($password)) {
        $sql = "UPDATE tb_petugas 
                SET username='$username', nama='$nama', telepon='$telepon', cabang='$cabang' 
                WHERE id_petugas='$id_petugas'";
    } else {
        // Hash password jika diisi
        $hashed_password = md5($password);
        $sql = "UPDATE tb_petugas 
                SET username='$username', password='$hashed_password', nama='$nama', telepon='$telepon', cabang='$cabang' 
                WHERE id_petugas='$id_petugas'";
    }

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='?m=petugas&s=awal';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data! Silakan coba lagi.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Form tidak valid!'); window.history.back();</script>";
}
?>
