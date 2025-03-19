<?php 
include '../koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pastikan session 'cabanginv2' sudah diatur
if (!isset($_SESSION['cabanginv2'])) {
    die("Cabang tidak ditemukan. Silakan login kembali.");
}
$cabang_admin = $_SESSION['cabanginv2'];

// Set batas data per halaman
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Query untuk menghitung total data berdasarkan cabang
$query_count = "SELECT COUNT(*) as total FROM tb_batangan WHERE penempatan = ?";
$stmt_count = mysqli_prepare($koneksi, $query_count);
mysqli_stmt_bind_param($stmt_count, 's', $cabang_admin);
mysqli_stmt_execute($stmt_count);
$result_count = mysqli_stmt_get_result($stmt_count);
$row_count = mysqli_fetch_assoc($result_count);
$jumlah_data = $row_count['total']; // Total jumlah data

// Menghitung total halaman
$total_halaman = ceil($jumlah_data / $batas);

// Jika form pencarian disubmit
if (isset($_POST['go'])) {
    $cari = mysqli_real_escape_string($koneksi, $_POST['cari']); // Sanitasi input pengguna
    
    // Query untuk mencari berdasarkan nama_operator dan no_unit
    $query_data = "SELECT * FROM tb_batangan WHERE penempatan = ? 
                   AND (nama_operator LIKE ? OR no_unit LIKE ?) LIMIT ?, ?";
    
    $stmt_data = mysqli_prepare($koneksi, $query_data);
    $search_term = "%" . $cari . "%";
    mysqli_stmt_bind_param($stmt_data, 'ssssi', $cabang_admin, $search_term, $search_term, $halaman_awal, $batas);
} else {
    // Query normal untuk mengambil data dengan filter cabang
    $query_data = "SELECT * FROM tb_batangan WHERE penempatan = ? LIMIT ?, ?";
    $stmt_data = mysqli_prepare($koneksi, $query_data);
    mysqli_stmt_bind_param($stmt_data, 'sii', $cabang_admin, $halaman_awal, $batas);
}

// Eksekusi query
mysqli_stmt_execute($stmt_data);
$result_data = mysqli_stmt_get_result($stmt_data);

// Menampilkan data
$nomor = $halaman_awal + 1;
while ($row = mysqli_fetch_assoc($result_data)): ?>
    <tr>
        <td><?php echo $nomor++; ?></td>
        <td><?php echo htmlspecialchars($row['nama_operator']); ?></td>
        <td><?php echo htmlspecialchars($row['penempatan']); ?></td>
        <td><?php echo htmlspecialchars($row['jenis_unit']); ?></td>
        <td><?php echo htmlspecialchars($row['merek_unit']); ?></td>
        <td><?php echo htmlspecialchars($row['tonase']); ?></td>
        <td><?php echo htmlspecialchars($row['no_unit']); ?></td>
        <td><?php echo htmlspecialchars($row['nama_helper']); ?></td>
        <td>
            <a href="?m=batanganUnit&s=detail_foto&id_batangan=<?php echo $row['id_batangan']; ?>">
                <button class="btn btn-warning">View</button>
            </a>
        </td>
        <td>
            <a href="?m=batanganUnit&s=export_pdf&id_batangan=<?php echo $row['id_batangan']; ?>">
                <i class="fa fa-print"></i> Print PDF
            </a>
        </td>
        <td>
            <a href="?m=batanganUnit&s=hapus&id_batangan=<?php echo $row['id_batangan']; ?>" 
               onclick="return confirm('Yakin Akan dihapus?')">
               <button class="btn btn-danger">Hapus</button>
            </a> | 
            <a href="?m=batanganUnit&s=ubah&id_batangan=<?php echo $row['id_batangan']; ?>"
                onclick="return confirm('Yakin Akan diubah?')">
               <button class="btn btn-primary">Ubah</button>
            </a>
        </td>
    </tr>
<?php endwhile; ?>
