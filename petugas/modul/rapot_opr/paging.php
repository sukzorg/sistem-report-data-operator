<?php 
include '../koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi cabang dari sesi
$cabang_admin = $_SESSION['cabanginv2']; // Pastikan session 'cabanginv2' sudah di-set dengan benar

// Set batas data per halaman
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0; // Menentukan halaman pertama

$previous = $halaman - 1;
$next = $halaman + 1;

// Query untuk menghitung total data berdasarkan cabang
$query_count = "SELECT COUNT(*) as total FROM tb_laporan WHERE penempatan = ?";
$stmt_count = mysqli_prepare($koneksi, $query_count);
mysqli_stmt_bind_param($stmt_count, 's', $cabang_admin);
mysqli_stmt_execute($stmt_count);
$result_count = mysqli_stmt_get_result($stmt_count);
$row_count = mysqli_fetch_assoc($result_count);
$jumlah_data = $row_count['total']; // Total jumlah data

// Menghitung total halaman
$total_halaman = ceil($jumlah_data / $batas);

if (isset($_POST['go'])) {
    // Jika form pencarian disubmit
    $cari = mysqli_real_escape_string($koneksi, $_POST['cari']); // Melakukan sanitasi pada input pengguna
    
    // Query untuk mencari berdasarkan nama_operator_report atau no_sio_opr
    $query_search = "SELECT * FROM tb_laporan WHERE penempatan = ? 
                     AND (nama_operator_report LIKE ? OR no_sio_opr LIKE ?) LIMIT ?, ?";
    
    $stmt_search = mysqli_prepare($koneksi, $query_search);
    $search_term = "%" . $cari . "%";
    mysqli_stmt_bind_param($stmt_search, 'ssssi', $cabang_admin, $search_term, $search_term, $halaman_awal, $batas);
    mysqli_stmt_execute($stmt_search);
    $result_data = mysqli_stmt_get_result($stmt_search);
} else {
    // Query normal untuk mengambil data dengan LIMIT untuk pagination
    $query_data = "SELECT * FROM tb_laporan WHERE penempatan = ? LIMIT ?, ?";
    $stmt_data = mysqli_prepare($koneksi, $query_data);
    mysqli_stmt_bind_param($stmt_data, 'sii', $cabang_admin, $halaman_awal, $batas);
    mysqli_stmt_execute($stmt_data);
    $result_data = mysqli_stmt_get_result($stmt_data);
}


// Menampilkan data
$nomor = $halaman_awal + 1;
while ($row = mysqli_fetch_assoc($result_data)): ?>
    <tr>
        <td><?php echo $nomor++; ?></td> <!-- Nomor urut -->
        <td><?php echo $row['nama_operator_report']; ?></td>
        <td><?php echo $row['no_sio_opr']; ?></td>
        <td><?php echo $row['penempatan']; ?></td>
        <td><?php echo $row['tgl_kejadian']; ?></td>
        <td><?php echo $row['kejadian']; ?></td>
        <td><?php echo $row['note']; ?></td>
        <td><?php echo $row['no_berita_acara']; ?></td>
        <td>
            <a href="?m=rapot_opr&s=detail_foto&id_laporan=<?php echo $row['id_laporan']; ?>">
                <button class="btn btn-warning">View</button>
            </a>
        </td>
        <td>
            <a href="?m=rapot_opr&s=export_pdf&id_laporan=<?php echo $row['id_laporan']; ?>">
                <i class="fa fa-print"></i> Print PDF
            </a>
        </td>
        <td>
            <a href="?m=rapot_opr&s=hapus&id_laporan=<?php echo $row['id_laporan'];?>" 
               onclick="return confirm('Yakin Akan dihapus?')">
               <button class="btn btn-danger">Hapus</button>
            </a> | 
            <a href="?m=rapot_opr&s=ubah&id_laporan=<?php echo $row['id_laporan'];?>"
                onclick="return confirm('Yakin Akan diubah?')">
               <button class="btn btn-primary">Ubah</button>
            </a>
        </td>
    </tr>
<?php endwhile; ?>
