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
    $id_laporan = $_POST['id_laporan'];
    $nama_operator_report = $_POST['nama_operator_report'];
    $no_sio_opr = $_POST['no_sio_opr'];
    $penempatan = $_POST['penempatan'];
    $tgl_kejadian = $_POST['tgl_kejadian'];
    $kejadian = $_POST['kejadian'];
    $note = $_POST['note'];
    $no_berita_acara = $_POST['no_berita_acara'];

    // Jika jabatan admin adalah 'korcap', pastikan hanya dapat mengupdate data untuk cabang yang sesuai
    if ($jabatan_user == 'Korcap' && $cabang_user != $penempatan) {
        echo "<script>alert('Anda hanya dapat mengupdate data untuk cabang Anda sendiri!'); window.history.back();</script>";
        exit;
    }   

    // Foto Kejadian
    $uploaded = false; // Variabel untuk mengecek jika ada file yang diupload
    $fotobaru = null;  // Variabel untuk menyimpan nama file baru

    if (isset($_FILES['foto_kejadian']) && $_FILES['foto_kejadian']['error'] == 0) {
        $foto_kejadian = $_FILES['foto_kejadian']['name'];
        $tmp = $_FILES['foto_kejadian']['tmp_name'];
        $fotobaru = date('dmYHis') . $foto_kejadian;
        $path = "../images/foto_kejadian/" . $fotobaru;

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['foto_kejadian']['type'], $allowed_types)) {
            // Validasi ukuran file
            if ($_FILES['foto_kejadian']['size'] <= 5 * 1024 * 1024) {
                if (move_uploaded_file($tmp, $path)) {
                    $uploaded = true;

                    // Hapus foto lama jika ada file baru yang diupload
                    $sql = "SELECT foto_kejadian FROM tb_laporan WHERE id_laporan = '$id_laporan'";
                    $query = mysqli_query($koneksi, $sql);
                    $result = mysqli_fetch_array($query);

                    if ($result['foto_kejadian']) {
                        $file_lama = "../images/foto_kejadian/" . $result['foto_kejadian'];
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
    $sql_update = "UPDATE tb_laporan SET 
        nama_operator_report = '$nama_operator_report', 
        no_sio_opr = '$no_sio_opr', 
        penempatan = '$penempatan', 
        tgl_kejadian = '$tgl_kejadian', 
        kejadian = '$kejadian', 
        note = '$note', 
        no_berita_acara = '$no_berita_acara'";

    // Jika ada foto baru yang diupload
    if ($uploaded) {
        $sql_update .= ", foto_kejadian = '$fotobaru'";
    }

    $sql_update .= " WHERE id_laporan = '$id_laporan'";

    // Eksekusi query
    $update = mysqli_query($koneksi, $sql_update);

    if ($update) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        header('Location: ?m=rapot_opr&s=title');
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
