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

    // Mengambil data dari form
    $nama_operator_report = $_POST['nama_operator_report'];
    $no_sio_opr = $_POST['no_sio_opr'];
    $penempatan = $_POST['penempatan'];
    $tgl_kejadian = $_POST['tgl_kejadian'];
    $kejadian = $_POST['kejadian'];
    $note = $_POST['note'];
    $no_berita_acara = $_POST['no_berita_acara'];
    $foto_kejadian = $_FILES['foto_kejadian'];

    // Validasi apakah semua field telah diisi
    if (empty($nama_operator_report) || empty($no_sio_opr) || empty($penempatan) || empty($tgl_kejadian) || empty($kejadian) || empty($note) || empty($no_berita_acara) || empty($foto_kejadian['name'])) {
        echo "<script>alert('Harap isi semua field!'); window.history.back();</script>";
        exit;
    }

    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Tentukan folder penyimpanan foto
    $folder_kejadian = "../images/foto_kejadian/";
    $fotobaru_kejadian = date('dmYHis') . $foto_kejadian['name'];
    $lokasi_kejadian = $foto_kejadian['tmp_name'];

    // Proses upload foto
    UploadFoto($fotobaru_kejadian, $folder_kejadian, 100, $lokasi_kejadian);

    // Cek apakah laporan sudah ada
    $sql = "SELECT * FROM tb_laporan WHERE nama_operator_report = '$nama_operator_report'";
    $tambah = mysqli_query($koneksi, $sql);

    if (mysqli_fetch_row($tambah)) {
        echo "<script>alert('Rapot sudah ada!'); window.history.back();</script>";
    } else {
        // Insert data ke database
        $sql = "INSERT INTO tb_laporan (nama_operator_report, no_sio_opr, penempatan, tgl_kejadian, kejadian, note, no_berita_acara, foto_kejadian)
                VALUES ('$nama_operator_report','$no_sio_opr', '$penempatan', '$tgl_kejadian', '$kejadian', '$note', '$no_berita_acara', '$fotobaru_kejadian')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: ?m=rapot_opr&s=title");
        } else {
            echo "<script>alert('Gagal menyimpan data!'); window.history.back();</script>";
        }
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>
