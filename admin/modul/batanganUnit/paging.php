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

// Set batas data per halaman
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0; // Menentukan halaman pertama

$previous = $halaman - 1;
$next = $halaman + 1;

// Count total data untuk pagination
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
    $data = mysqli_query($koneksi, "SELECT * FROM tb_batangan WHERE penempatan = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_batangan");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;

// Query dengan pencarian dan pagination
if (isset($_POST['go'])) {
    $cari = $_POST['cari']; // Ambil input pencarian
    if ($jabatan_admin == "Korcap") {
        // Pencarian data hanya dari cabang yang sesuai jika jabatan Korcap
        $query = "SELECT * FROM tb_batangan WHERE (nama_operator LIKE ? OR no_unit LIKE ?) AND penempatan = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssssi', $search, $search, $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Pencarian tanpa filter cabang jika bukan jabatan Korcap
        $query = "SELECT * FROM tb_batangan WHERE (nama_operator LIKE ? OR no_unit LIKE ?) LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssii', $search, $search, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    if ($jabatan_admin == "Korcap") {
        // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
        $query = "SELECT * FROM tb_batangan WHERE penempatan = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'sii', $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Jika jabatan selain Korcap, tampilkan seluruh data
        $query = "SELECT * FROM tb_batangan LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}

// Menampilkan data
while ($row = mysqli_fetch_assoc($result)):
?>
<tr>
    <td><?php echo $nomor++; ?></td> <!-- Ganti id_admin dengan nomor urut -->
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
        <a href="?m=batanganUnit&s=hapus&id_batangan=<?php echo $row['id_batangan'];?>" 
           onclick="return confirm('Yakin Akan dihapus?')">
           <button class="btn btn-danger">Hapus</button>
        </a> | 
        <a href="?m=batanganUnit&s=ubah&id_batangan=<?php echo $row['id_batangan'];?>"
            onclick="return confirm('Yakin Akan diubah?')">
           <button class="btn btn-primary">Ubah</button>
        </a>
    </td>
</tr>
<?php endwhile; ?>
