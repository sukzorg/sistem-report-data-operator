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

// Mengambil id_operator dari URL
$id_operator = isset($_GET['id_operator']) ? $_GET['id_operator'] : '';

// Cek apakah id_operator ada dan valid
if (!empty($id_operator)) {
    // Melakukan update status mutasi menjadi "Ditolak"
    $update_query = "UPDATE tb_mutasi_operator 
                     SET status_approval = 'Ditolak' 
                     WHERE id_operator = ?";
    $stmt = $koneksi->prepare($update_query);  // Gunakan $koneksi yang konsisten
    $stmt->bind_param("i", $id_operator);

    if ($stmt->execute()) {
        // Hapus data dari tb_mutasi_operator setelah status ditolak
        $delete_query = "DELETE FROM tb_mutasi_operator WHERE id_operator = ?";
        $delete_stmt = $koneksi->prepare($delete_query);
        $delete_stmt->bind_param("i", $id_operator);

        if ($delete_stmt->execute()) {
            // Menampilkan alert "Permintaan Mutasi Ditolak" dan mengarahkan kembali ke halaman sebelumnya
            echo '<script type="text/javascript">
                    alert("Permintaan Mutasi Ditolak");
                    window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
                  </script>';
            exit(); // Menghentikan eksekusi lebih lanjut
        } else {
            echo "Gagal menghapus data mutasi operator!";
        }
    } else {
        echo "Terjadi kesalahan saat menolak mutasi!";
    }
} else {
    echo "ID operator tidak ditemukan.";
}
?>
