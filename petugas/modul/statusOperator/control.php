<?php
include '../koneksi.php';

// Fungsi untuk mencari data operator berdasarkan nama atau status
function search_operator($cari)
{
    global $koneksi;
    $cari = "%$cari%";
    $query = "SELECT * FROM tb_operator WHERE nama_operator LIKE ? OR status LIKE ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $cari, $cari);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
?>
