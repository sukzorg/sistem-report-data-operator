<?php
session_start(); // Memulai session untuk memeriksa apakah admin sudah login
include '../koneksi.php';

// Pastikan admin sudah login dengan cek session
if (!isset($_SESSION['idinv'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
    exit();
}

    // Ambil jabatan dan cabang dari sesi login
    $cabang_user = $_SESSION['cabanginv'];  // Cabang admin yang sedang login
    $jabatan_user = $_SESSION['jabataninv']; // Jabatan admin yang sedang login

//proses input
if (isset($_POST['simpan'])) {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Password baru
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $telepon = $_POST['telepon'];
    $cabang = $_POST['cabang'];

    // Validasi data kosong
    if (empty($username) || empty($nama) || empty($jabatan) || empty($telepon) || empty($cabang)) {
        echo "<script>alert('Semua field harus diisi! Silakan cek ulang.'); window.history.back();</script>";
        exit; // Menghentikan eksekusi lebih lanjut
    }

    // Validasi berdasarkan jabatan admin
    if ($jabatan_user == "Korcap" && $cabang_user != $cabang) {
        echo "<script>alert('Anda hanya dapat memperbarui data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Cek apakah password kosong
    if (empty($password)) {
        // Jika password tidak diubah, ambil password yang lama dari database
        $sql_password = "SELECT password FROM tb_admin WHERE id_admin = '$id_admin'";
        $result = mysqli_query($koneksi, $sql_password);
        $row = mysqli_fetch_assoc($result);
        $password_md5 = $row['password']; // Menggunakan password lama
    } else {
        // Jika password diisi, maka di-hash dan update data
        $password_md5 = md5($password);
    }

    // Proses ubah data ke Database
    $sql_f = "UPDATE tb_admin SET username='$username', password='$password_md5', nama='$nama', jabatan='$jabatan', telepon='$telepon', cabang='$cabang' WHERE id_admin='$id_admin'";

    $ubah = mysqli_query($koneksi, $sql_f);
    if ($ubah) {
        echo "<script>alert('Ubah Data Dengan ID Admin  ".$id_admin." Berhasil') </script>";
        header('Location:?m=admin&s=awal');
    } else {
        echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');</script>";
    }
}
?>
