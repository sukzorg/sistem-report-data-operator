<?php
include '../koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cabanginv'])) {
    header('Location: login.php');
    exit();
}

$cabang_admin = $_SESSION['cabanginv'];
$jabatan_admin = $_SESSION['jabataninv']; // Mendapatkan jabatan admin yang login

// Mengambil data dari URL
$action = isset($_GET['s']) ? $_GET['s'] : '';
$id_operator = isset($_GET['id_operator']) ? $_GET['id_operator'] : '';

// Cek jika aksi adalah "approved"
if ($action == 'approved' && !empty($id_operator)) {
    // Melakukan update dari tb_mutasi_operator ke tb_operator
    $update_query = "UPDATE tb_operator o
                     JOIN tb_mutasi_operator m ON o.id_operator = m.id_operator
                     SET o.nama_operator = m.nama_operator, o.penempatan_opr = m.penempatan_opr_baru, o.status = m.status_opr_baru
                     WHERE o.id_operator = ?";
    
    // Siapkan dan jalankan statement
    $stmt = $koneksi->prepare($update_query);
    $stmt->bind_param("i", $id_operator);

    if ($stmt->execute()) {
        // Jika data di tb_operator berhasil diperbarui, hapus data yang terkait di tb_mutasi_operator
        $delete_query = "DELETE FROM tb_mutasi_operator WHERE id_operator = ?";
        $delete_stmt = $koneksi->prepare($delete_query);
        $delete_stmt->bind_param("i", $id_operator);

        if ($delete_stmt->execute()) {
            // Pengalihan kembali ke halaman sebelumnya setelah sukses dengan alert
            echo '<script type="text/javascript">
                    alert("Data berhasil di approve");
                    window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
                  </script>';
            exit(); // Pastikan eksekusi dihentikan setelah redirect
        } else {
            echo "Mutasi telah diizinkan, tetapi gagal menghapus data di mutasi operator!";
        }
    } else {
        echo "Terjadi kesalahan saat mengizinkan mutasi!";
    }
} 

?>
