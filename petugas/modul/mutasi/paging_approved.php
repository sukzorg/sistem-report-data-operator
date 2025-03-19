<?php
// Koneksi ke database
include '../koneksi.php';

// Mendapatkan ID Operator dari URL atau request
$id_operator = isset($_GET['id_operator']) ? $_GET['id_operator'] : null;

// Pastikan ID Operator ada
if ($id_operator) {
    // Query untuk mengambil detail operator
    $sql = "SELECT * FROM tb_mutasi_operator WHERE id_operator = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id_operator);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Memastikan data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Menampilkan data operator
        while ($r = mysqli_fetch_array($result)) :
            // Cek status approval
            $status_approval = htmlspecialchars($r['status_approval']);
            
            // Jika status approval adalah 'pending', tampilkan status pending
            if ($status_approval == 'Ajukan Mutasi') {
                $ajukan_mutasi = 'Pending';  // Ganti teks kolom menjadi 'Pending' jika status approval adalah pending
            } else {
                $ajukan_mutasi = htmlspecialchars($r['status_approval']);  // Tampilkan status aslinya
            }
?>
            <tr>
                <td><?php echo htmlspecialchars($r['nama_operator']); ?></td>
                <td><?php echo htmlspecialchars($r['penempatan_opr_baru']); ?></td>
                <td><?php echo htmlspecialchars($r['status_opr_baru']); ?></td>
                <td><?php echo $ajukan_mutasi; ?></td> <!-- Tampilkan status approval atau Pending -->
                <td><?php echo htmlspecialchars($r['tgl_pengajuan']); ?></td>
            </tr>
<?php
        endwhile;
    } else {
        echo "<tr><td colspan='5'>Data tidak ditemukan.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>ID Operator tidak ditemukan.</td></tr>";
}
?>
