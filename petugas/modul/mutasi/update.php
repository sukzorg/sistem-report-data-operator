<?php
include '../koneksi.php';

// Pastikan user sudah login dan memiliki sesi cabang
if (!isset($_SESSION['userinv2'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

// Ambil cabang dan jabatan dari sesi login
$cabang_user = $_SESSION['cabanginv2'];  // Cabang admin yang sedang login

// Mengecek jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_operator = $_POST['id_operator'];
    $nama_operator = $_POST['nama_operator'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $no_sio = $_POST['no_sio'];
    $jenis_sio = $_POST['jenis_sio'];
    $operator = $_POST['operator'];
    $kelas_operator = $_POST['kelas_operator'];
    $penempatan_opr = $_POST['penempatan_opr'];
    $tgl_masuk = $_POST['tgl_masuk'];

    // Ambil status dari form, jika kosong, biarkan tetap kosong (opsional)
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan_opr) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Variabel untuk menyimpan nama file foto
    $foto_ktp = null;
    $foto_sio = null;
    $foto_sim = null;
    $foto_sertifikat_dpn = null;
    $foto_sertifikat_blk = null;
    $foto_operator = null;

    // Menghandle foto yang diupload
    if (isset($_FILES['foto_ktp']) && $_FILES['foto_ktp']['error'] == 0) {
        $foto_ktp = $_FILES['foto_ktp']['name'];
        $tmp = $_FILES['foto_ktp']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_ktp;
        $path = "../images/foto_ktp/" . $fotobaru;
        if (move_uploaded_file($tmp, $path)) {
            $foto_ktp = $fotobaru;
        }
    }

    if (isset($_FILES['foto_sio']) && $_FILES['foto_sio']['error'] == 0) {
        $foto_sio = $_FILES['foto_sio']['name'];
        $tmp = $_FILES['foto_sio']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_sio;
        $path = "../images/foto_sio/" . $fotobaru;
        if (move_uploaded_file($tmp, $path)) {
            $foto_sio = $fotobaru;
        }
    }

    if (isset($_FILES['foto_sim']) && $_FILES['foto_sim']['error'] == 0) {
        $foto_sim = $_FILES['foto_sim']['name'];
        $tmp = $_FILES['foto_sim']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_sim;
        $path = "../images/foto_sim/" . $fotobaru;
        if (move_uploaded_file($tmp, $path)) {
            $foto_sim = $fotobaru;
        }
    }

    if (isset($_FILES['foto_sertifikat_dpn']) && $_FILES['foto_sertifikat_dpn']['error'] == 0) {
        $foto_sertifikat_dpn = $_FILES['foto_sertifikat_dpn']['name'];
        $tmp = $_FILES['foto_sertifikat_dpn']['tmp_name'];
        $fotobaru_dpn = date('dmYHis') . $foto_sertifikat_dpn;
        $path_dpn = "../images/sertifikat/" . $fotobaru_dpn;
        if (move_uploaded_file($tmp, $path_dpn)) {
            $foto_sertifikat_dpn = $fotobaru_dpn;
        }
    }

    if (isset($_FILES['foto_sertifikat_blk']) && $_FILES['foto_sertifikat_blk']['error'] == 0) {
        $foto_sertifikat_blk = $_FILES['foto_sertifikat_blk']['name'];
        $tmp = $_FILES['foto_sertifikat_blk']['tmp_name'];
        $fotobaru_blk = date('dmYHis') . $foto_sertifikat_blk;
        $path_blk = "../images/sertifikat/" . $fotobaru_blk;
        if (move_uploaded_file($tmp, $path_blk)) {
            $foto_sertifikat_blk = $fotobaru_blk;
        }
    }

    if (isset($_FILES['foto_operator']) && $_FILES['foto_operator']['error'] == 0) {
        $foto_operator = $_FILES['foto_operator']['name'];
        $tmp = $_FILES['foto_operator']['tmp_name'];
        $fotobaru_operator = date('dmYHis') . $foto_operator;
        $path_operator = "../images/foto_operator/" . $fotobaru_operator;
        if (move_uploaded_file($tmp, $path_operator)) {
            $foto_operator = $fotobaru_operator;
        }
    }

    // Update data ke database, termasuk foto jika ada
    // Ambil data foto lama untuk dihapus (jika ada)
    $sql = "SELECT foto_ktp, foto_sio, foto_sim, foto_sertifikat_dpn, foto_sertifikat_blk, foto_operator, status FROM tb_operator WHERE id_operator = '$id_operator'";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_array($query);

    // Jika status tidak diisi, tetap gunakan status lama (jika ada)
    if (!$status) {
        $status = $result['status'];  // Mengambil status sebelumnya jika tidak ada input baru
    }

    // Update query untuk foto yang diupload saja
    $sql_update = "UPDATE tb_operator SET 
        nama_operator = '$nama_operator', 
        nik = '$nik', 
        alamat = '$alamat', 
        no_telp = '$no_telp', 
        no_sio = '$no_sio', 
        jenis_sio = '$jenis_sio', 
        operator = '$operator', 
        kelas_operator = '$kelas_operator', 
        penempatan_opr = '$penempatan_opr', 
        tgl_masuk = '$tgl_masuk', 
        status = '$status'";  // Menambahkan status di query update

    if ($foto_ktp) {
        // Hapus foto lama
        $file_lama = "../images/foto_ktp/" . $result['foto_ktp'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_ktp = '$foto_ktp'";
    }

    if ($foto_sio) {
        // Hapus foto lama
        $file_lama = "../images/foto_sio/" . $result['foto_sio'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_sio = '$foto_sio'";
    }

    if ($foto_sim) {
        // Hapus foto lama
        $file_lama = "../images/foto_sim/" . $result['foto_sim'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_sim = '$foto_sim'";
    }

    if ($foto_sertifikat_dpn) {
        // Hapus foto lama
        $file_lama = "../images/sertifikat/" . $result['foto_sertifikat_dpn'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_sertifikat_dpn = '$foto_sertifikat_dpn'";
    }

    if ($foto_sertifikat_blk) {
        // Hapus foto lama
        $file_lama = "../images/sertifikat/" . $result['foto_sertifikat_blk'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_sertifikat_blk = '$foto_sertifikat_blk'";
    }

    if ($foto_operator) {
        // Hapus foto lama
        $file_lama = "../images/foto_operator/" . $result['foto_operator'];
        if (file_exists($file_lama)) {
            unlink($file_lama);
        }
        $sql_update .= ", foto_operator = '$foto_operator'";
    }

    $sql_update .= " WHERE id_operator = '$id_operator'";

    // Eksekusi query
    $update = mysqli_query($koneksi, $sql_update);

    if ($update) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        header('Location: ?m=operator&s=title');
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate data');</script>";
    }
}
?>
