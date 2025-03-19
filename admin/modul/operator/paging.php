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

// Pagination
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Count total data
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
    $data = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE penempatan_opr = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_operator");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;

// Query with search and pagination
if (isset($_POST['go'])) {
    $cari = $_POST['cari'];
    if ($jabatan_admin == "Korcap") {
        // Pencarian data hanya dari cabang yang sesuai jika jabatan Korcap
        $query = "SELECT * FROM tb_operator WHERE (nama_operator LIKE ? OR nik LIKE ?) AND penempatan_opr = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssssi', $search, $search, $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Pencarian tanpa filter cabang jika bukan jabatan Korcap
        $query = "SELECT * FROM tb_operator WHERE (nama_operator LIKE ? OR nik LIKE ?) LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        $search = "%$cari%";
        mysqli_stmt_bind_param($stmt, 'ssii', $search, $search, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    if ($jabatan_admin == "Korcap") {
        // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
        $query = "SELECT * FROM tb_operator WHERE penempatan_opr = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'sii', $cabang_admin, $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Jika jabatan selain Korcap, tampilkan seluruh data
        $query = "SELECT * FROM tb_operator LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $halaman_awal, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}

foreach ($result as $row):
?>
<tr>
    <td><?php echo $nomor++; ?></td>
    <td><?php echo htmlspecialchars($row['nama_operator']); ?></td>
    <td><?php echo htmlspecialchars($row['nik']); ?></td>
    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
    <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
    <td><?php echo htmlspecialchars($row['no_sio']); ?></td>
    <td><?php echo htmlspecialchars($row['jenis_sio']); ?></td>
    <td><?php echo htmlspecialchars($row['operator']); ?></td>
    <td><?php echo htmlspecialchars($row['kelas_operator']); ?></td>

    <?php
    $photos = ['KTP', 'SIO', 'SIM', 'Sertifikat Depan', 'Sertifikat Belakang', 'Operator'];
    foreach ($photos as $photo) {
        echo '<td><a href="?m=operator&s=detail_foto&id_operator='.$row['id_operator'].'" class="btn btn-warning">Lihat Foto '.$photo.'</a></td>';
    }
    ?>

    <td><?php echo htmlspecialchars($row['penempatan_opr']); ?></td>
    <td><?php echo htmlspecialchars($row['tgl_masuk']); ?></td>
    <td><a href="?m=rapot_opr&s=title.php" class="btn btn-info">Report</a></td>
    <td><?php echo htmlspecialchars($row['status']); ?></td>
    <td>
        <a href="?m=statusOperator&s=awal&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-success">Lihat Detail</a>
        <a href="?m=operator&s=export_pdf&id_operator=<?php echo $row['id_operator']; ?>"><i class="fa fa-print"></i> Print PDF</a>
    </td>
    <td><a href="index.php?m=operator&s=hapus&id_operator=<?php echo $row['id_operator'];?>" onclick="return confirm('Yakin Akan dihapus?')"><button class="btn btn-danger">Hapus</button></a> |
        <a href="index.php?m=operator&s=ubah&id_operator=<?php echo $row['id_operator'];?>" onclick="return confirm('Yakin Akan diubah?')"><button class="btn btn-primary">Ubah</button></a>
    </td>
</tr>
<?php endforeach; ?>
