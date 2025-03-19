<?php
include "sesi_petugas.php";
if (isset($_POST['simpan'])) {
    include "../koneksi.php";
    include "../fungsi/upload.php";

    // Pastikan user sudah login dan memiliki sesi cabang
    if (!isset($_SESSION['userinv2'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
        exit;
    }

    // Ambil cabang dan jabatan dari sesi login
    $cabang_user = $_SESSION['cabanginv2'];  // Cabang admin yang sedang login

    // Ambil data dari form
    $nama_operator = trim($_POST['nama_operator']);
    $nik = trim($_POST['nik']);
    $alamat = trim($_POST['alamat']);
    $no_telp = trim($_POST['no_telp']);
    $no_sio = trim($_POST['no_sio']);
    $jenis_sio = trim($_POST['jenis_sio']);
    $operator = trim($_POST['operator']);
    $kelas_operator = trim($_POST['kelas_operator']);
    $penempatan_opr = trim($_POST['penempatan_opr']);
    $tgl_masuk = trim($_POST['tgl_masuk']);
    $status = trim($_POST['status']);

    // Validasi input kosong
    if (
        empty($nama_operator) || empty($nik) || empty($alamat) || empty($no_telp) ||
        empty($no_sio) || empty($jenis_sio) || empty($operator) || empty($kelas_operator) ||
        empty($penempatan_opr) || empty($tgl_masuk) || empty($status)
    ) {
        echo "<script>alert('Semua field harus diisi! Silakan cek ulang.'); window.history.back();</script>";
        exit;
    }
    
    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan_opr) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Folder penyimpanan file
    $folder_ktp = "../images/foto_ktp/";
    $folder_sio = "../images/foto_sio/";
    $folder_sim = "../images/foto_sim/";
    $folder_sertifikat = "../images/sertifikat/";
    $folder_opr = "../images/foto_operator/";

    // Array untuk menyimpan nama file baru
    $uploaded_files = [];

    // Fungsi upload file dengan validasi tipe file
    function upload_file($file, $folder, &$uploaded_files)
    {
        if ($file['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowed_types)) {
                echo "<script>alert('Tipe file tidak diizinkan. Hanya JPG dan PNG.'); window.history.back();</script>";
                exit;
            }

            $new_file_name = date('dmYHis') . $file['name'];
            $file_path = $folder . $new_file_name;
            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $uploaded_files[] = $new_file_name;
                return $new_file_name;
            } else {
                echo "<script>alert('Gagal mengupload file: " . $file['name'] . "'); window.history.back();</script>";
                exit;
            }
        }
        return null; // Mengembalikan null jika tidak ada file atau terjadi error
    }

    // Proses upload hanya file yang diinginkan
    $fotobaru_ktp = isset($_FILES['foto_ktp']) ? upload_file($_FILES['foto_ktp'], $folder_ktp, $uploaded_files) : null;
    $fotobaru_sio = isset($_FILES['foto_sio']) ? upload_file($_FILES['foto_sio'], $folder_sio, $uploaded_files) : null;
    $fotobaru_sim = isset($_FILES['foto_sim']) ? upload_file($_FILES['foto_sim'], $folder_sim, $uploaded_files) : null;
    $fotobaru_dpn = isset($_FILES['foto_sertifikat_dpn']) ? upload_file($_FILES['foto_sertifikat_dpn'], $folder_sertifikat, $uploaded_files) : null;
    $fotobaru_blk = isset($_FILES['foto_sertifikat_blk']) ? upload_file($_FILES['foto_sertifikat_blk'], $folder_sertifikat, $uploaded_files) : null;
    $fotobaru_opr = isset($_FILES['foto_operator']) ? upload_file($_FILES['foto_operator'], $folder_opr, $uploaded_files) : null;

    // Set default value jika foto tidak di-upload
    $fotobaru_ktp = $fotobaru_ktp ?? '';  // Jika tidak ada foto KTP, set kosong
    $fotobaru_sio = $fotobaru_sio ?? '';  // Jika tidak ada foto SIO, set kosong
    $fotobaru_sim = $fotobaru_sim ?? '';  // Jika tidak ada foto SIM, set kosong
    $fotobaru_dpn = $fotobaru_dpn ?? '';  // Jika tidak ada foto sertifikat depan, set kosong
    $fotobaru_blk = $fotobaru_blk ?? '';  // Jika tidak ada foto sertifikat belakang, set kosong
    $fotobaru_opr = $fotobaru_opr ?? '';  // Jika tidak ada foto operator, set kosong

    // Cek apakah operator sudah ada
    $sql_check = "SELECT * FROM tb_operator WHERE nama_operator = ?";
    $stmt_check = mysqli_prepare($koneksi, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 's', $nama_operator);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "<script>alert('Operator sudah ada!'); window.history.back();</script>";
        exit;
    }

    // Insert data ke database
    $sql_insert = "INSERT INTO tb_operator 
        (nama_operator, nik, alamat, no_telp, no_sio, jenis_sio, operator, kelas_operator, foto_ktp, foto_sio, foto_sim, foto_sertifikat_dpn, foto_sertifikat_blk, foto_operator, penempatan_opr, tgl_masuk, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param(
        $stmt_insert,
        'sssssssssssssssss',
        $nama_operator,
        $nik,
        $alamat,
        $no_telp,
        $no_sio,
        $jenis_sio,
        $operator,
        $kelas_operator,
        $fotobaru_ktp,
        $fotobaru_sio,
        $fotobaru_sim,
        $fotobaru_dpn,
        $fotobaru_blk,
        $fotobaru_opr,
        $penempatan_opr,
        $tgl_masuk,
        $status
    );

    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='?m=operator&s=awal';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!'); window.history.back();</script>";
    }

    // Tutup statement
    mysqli_stmt_close($stmt_check);
    mysqli_stmt_close($stmt_insert);
} else {
    echo "<script>alert('Form tidak valid!'); window.history.back();</script>";
}
?>
