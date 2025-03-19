<?php
include '../koneksi.php';

// Pastikan user sudah login dan memiliki sesi cabang
if (!isset($_SESSION['userinv'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

// Ambil cabang dan jabatan dari sesi login
$cabang_user = $_SESSION['cabanginv'];  // Cabang admin yang sedang login
$jabatan_user = $_SESSION['jabataninv']; // Jabatan admin yang sedang login

// Mengecek jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_batangan = mysqli_real_escape_string($koneksi, $_POST['id_batangan']);
    $nama_operator = mysqli_real_escape_string($koneksi, $_POST['nama_operator']);
    $penempatan = mysqli_real_escape_string($koneksi, $_POST['penempatan']);
    $jenis_unit = mysqli_real_escape_string($koneksi, $_POST['jenis_unit']);
    $merek_unit = mysqli_real_escape_string($koneksi, $_POST['merek_unit']);
    $tonase = mysqli_real_escape_string($koneksi, $_POST['tonase']);
    $no_unit = mysqli_real_escape_string($koneksi, $_POST['no_unit']);
    $nama_helper = mysqli_real_escape_string($koneksi, $_POST['nama_helper']);

    $uploaded = false; // Variabel untuk mengecek jika ada file yang diupload
    $fotobaru = null;  // Variabel untuk menyimpan nama file baru

    // Jika jabatan admin adalah 'korcap', pastikan hanya dapat mengupdate data untuk cabang yang sesuai
    if ($jabatan_user == 'Korcap' && $cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat mengupdate data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }   

    // Foto Mou
    if (isset($_FILES['foto_mou']) && $_FILES['foto_mou']['error'] == 0) {
        $foto_mou = $_FILES['foto_mou']['name'];
        $tmp = $_FILES['foto_mou']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_mou;
        $path = "../images/foto_mou/" . $fotobaru;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['foto_mou']['type'], $allowed_types)) {
            // Validasi ukuran file
            if ($_FILES['foto_mou']['size'] <= 5 * 1024 * 1024) {
                if (move_uploaded_file($tmp, $path)) {
                    $uploaded = true;

                    // Hapus foto lama jika ada file baru yang diupload
                    $sql = "SELECT foto_mou FROM tb_batangan WHERE id_batangan = '$id_batangan'";
                    $query = mysqli_query($koneksi, $sql);
                    $result = mysqli_fetch_array($query);

                    if ($result['foto_mou']) {
                        $file_lama = "../images/foto_mou/" . $result['foto_mou'];
                        if (file_exists($file_lama)) {
                            unlink($file_lama);
                        }
                    }
                } else {
                    echo "<script>alert('Gagal mengupload foto');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Ukuran file terlalu besar');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Tipe file tidak diperbolehkan');</script>";
            exit;
        }
    }

    // Update data ke database
    $sql_update = "UPDATE tb_batangan SET 
        nama_operator = '$nama_operator', 
        penempatan = '$penempatan', 
        jenis_unit = '$jenis_unit', 
        merek_unit = '$merek_unit', 
        tonase = '$tonase', 
        no_unit = '$no_unit', 
        nama_helper = '$nama_helper'";

    // Jika ada foto baru yang diupload
    if ($uploaded) {
        $sql_update .= ", foto_mou = '$fotobaru'";
    }

    $sql_update .= " WHERE id_batangan = '$id_batangan'";

    // Eksekusi query
    $update = mysqli_query($koneksi, $sql_update);

    if ($update) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='?m=batanganUnit&s=title';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
