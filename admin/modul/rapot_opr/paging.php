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
    $data = mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE penempatan = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_laporan");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;

// Query dengan pencarian dan pagination
if (isset($_POST['go'])) {
    $cari = $_POST['cari']; // Ambil input pencarian
    if ($jabatan_admin == "Korcap") {
        // Pencarian data hanya dari cabang yang sesuai jika jabatan Korcap
        $query = "SELECT * FROM tb_laporan WHERE (nama_operator_report LIKE ? OR no_sio_opr LIKE ?) AND penempatan = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssssi', $search, $search, $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Pencarian tanpa filter cabang jika bukan jabatan Korcap
        $query = "SELECT * FROM tb_laporan WHERE (nama_operator_report LIKE ? OR no_sio_opr LIKE ?) LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssii', $search, $search, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    if ($jabatan_admin == "Korcap") {
        // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
        $query = "SELECT * FROM tb_laporan WHERE penempatan = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'sii', $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Jika jabatan selain Korcap, tampilkan seluruh data
        $query = "SELECT * FROM tb_laporan LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}

// Menampilkan data
foreach ($result as $row):
?>
<tr>
    <td><?php echo $nomor++; ?></td>
    <td><?php echo htmlspecialchars($row['nama_operator_report']); ?></td>
    <td><?php echo htmlspecialchars($row['no_sio_opr']); ?></td>
    <td><?php echo htmlspecialchars($row['penempatan']); ?></td>
    <td><?php echo htmlspecialchars($row['tgl_kejadian']); ?></td>
    <td><?php echo htmlspecialchars($row['kejadian']); ?></td>
    <td><?php echo htmlspecialchars($row['note']); ?></td>
    <td><?php echo htmlspecialchars($row['no_berita_acara']); ?></td>
    
    <!-- Menampilkan foto jika ada -->
    <td>
        <a href="?m=rapot_opr&s=detail_foto&id_laporan=<?php echo $row['id_laporan']; ?>">
            <button class="btn btn-warning">Foto</button>
        </a>
    </td>
    
    <!-- Print PDF -->
    <td>
        <a href="?m=rapot_opr&s=export_pdf&id_laporan=<?php echo $row['id_laporan']; ?>">
            <i class="fa fa-print"></i> Print PDF
        </a>
    </td>
    
    <!-- Tombol Hapus dan Ubah -->
    <td>
        <a href="?m=rapot_opr&s=hapus&id_laporan=<?php echo $row['id_laporan']; ?>" 
           onclick="return confirm('Yakin Akan dihapus?')">
            <button class="btn btn-danger">Hapus</button>
        </a> | 
        <a href="?m=rapot_opr&s=ubah&id_laporan=<?php echo $row['id_laporan']; ?>"
            onclick="return confirm('Yakin Akan diedit?')">
            <button class="btn btn-primary">Ubah</button>
        </a>
    </td>
</tr>
<?php endforeach; ?>
