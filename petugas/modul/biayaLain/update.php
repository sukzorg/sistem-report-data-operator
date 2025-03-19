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
    $id_biaya = mysqli_real_escape_string($koneksi, $_POST['id_biaya']);
    $nama_operator = mysqli_real_escape_string($koneksi, $_POST['nama_operator']);
    $penempatan = mysqli_real_escape_string($koneksi, $_POST['penempatan']);
    $jenis_unit = mysqli_real_escape_string($koneksi, $_POST['jenis_unit']);
    $merek_unit = mysqli_real_escape_string($koneksi, $_POST['merek_unit']);
    $tonase = mysqli_real_escape_string($koneksi, $_POST['tonase']);
    $no_unit = mysqli_real_escape_string($koneksi, $_POST['no_unit']);
    $keterangan_biaya = mysqli_real_escape_string($koneksi, $_POST['keterangan_biaya']);

    // Validasi simpan data, admin A hanya bisa menyimpan data A
    if ($cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat menambah data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }

    // Pastikan waktu ada sebelum mengaksesnya
    $waktu = isset($_POST['waktu']) ? mysqli_real_escape_string($koneksi, $_POST['waktu']) : null;

    $uploaded = false; // Variabel untuk mengecek jika ada file yang diupload
    $fotobaru = null;  // Variabel untuk menyimpan nama file baru

    // Foto Keterangan
    if (isset($_FILES['foto_keterangan']) && $_FILES['foto_keterangan']['error'] == 0) {
        $foto_keterangan = $_FILES['foto_keterangan']['name'];
        $tmp = $_FILES['foto_keterangan']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_keterangan;
        $path = "../images/foto_keterangan/" . $fotobaru;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['foto_keterangan']['type'], $allowed_types)) {
            // Validasi ukuran file
            if ($_FILES['foto_keterangan']['size'] <= 5 * 1024 * 1024) {
                if (move_uploaded_file($tmp, $path)) {
                    $uploaded = true;

                    // Hapus foto lama jika ada file baru yang diupload
                    $sql = "SELECT foto_keterangan FROM tb_lain_lain WHERE id_biaya = '$id_biaya'";
                    $query = mysqli_query($koneksi, $sql);
                    $result = mysqli_fetch_array($query);

                    if ($result['foto_keterangan']) {
                        $file_lama = "../images/foto_keterangan/" . $result['foto_keterangan'];
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
    $sql_update = "UPDATE tb_lain_lain SET 
        nama_operator = '$nama_operator', 
        penempatan = '$penempatan', 
        jenis_unit = '$jenis_unit', 
        merek_unit = '$merek_unit', 
        tonase = '$tonase', 
        no_unit = '$no_unit', 
        waktu = '$waktu', 
        keterangan_biaya = '$keterangan_biaya'";

    // Jika ada foto baru yang diupload
    if ($uploaded) {
        $sql_update .= ", foto_keterangan = '$fotobaru'";
    }

    $sql_update .= " WHERE id_biaya = '$id_biaya'";

    // Eksekusi query
    $update = mysqli_query($koneksi, $sql_update);

    if ($update) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='?m=biayaLain&s=title';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate data: " . mysqli_error($koneksi) . "');</script>";
    }
    
}
?>

