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
$batas = 5; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Count total data
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
    $data = mysqli_query($koneksi, "SELECT * FROM tb_mutasi_operator WHERE penempatan_opr_baru = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_mutasi_operator");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;

// Query dengan pencarian dan pagination
if (isset($_POST['go'])) {
    $cari = $_POST['cari'];
    $cari = htmlspecialchars(trim($cari)); // Sanitasi input pencarian untuk mencegah SQL Injection
    
    if ($jabatan_admin == "Korcap") {
        // Pencarian data hanya dari cabang yang sesuai jika jabatan Korcap
        $query = "SELECT * FROM tb_mutasi_operator WHERE nama_operator LIKE ? AND penempatan_opr_baru = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        
        if ($stmt) {
            $search = "%$cari%";
            mysqli_stmt_bind_param($stmt, 'ssii', $search, $cabang_admin, $halaman_awal, $batas);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            die("Query preparation failed.");
        }
    } else {
        // Pencarian tanpa filter cabang jika bukan jabatan Korcap
        $query = "SELECT * FROM tb_mutasi_operator WHERE nama_operator LIKE ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        
        if ($stmt) {
            $search = "%$cari%";
            mysqli_stmt_bind_param($stmt, 'sii', $search, $halaman_awal, $batas);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            die("Query preparation failed.");
        }
    }
} else {
    if ($jabatan_admin == "Korcap") {
        // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
        $query = "SELECT * FROM tb_mutasi_operator WHERE penempatan_opr_baru = ? LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sii', $cabang_admin, $halaman_awal, $batas);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            die("Query preparation failed.");
        }
    } else {
        // Jika jabatan selain Korcap, tampilkan seluruh data
        $query = "SELECT * FROM tb_mutasi_operator LIMIT ?, ?";
        $stmt = mysqli_prepare($koneksi, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ii', $halaman_awal, $batas);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            die("Query preparation failed.");
        }
    }
}

foreach ($result as $row):
?>
<tr>
    <td><?php echo $nomor++; ?></td>
    <td><?php echo $row['nama_operator']; ?></td>
    <td><?php echo $row['status_opr_baru']; ?></td>
    <td><?php echo $row['penempatan_opr_baru']; ?></td>
<!-- Tabel dengan tombol -->
<td>
    <a href="?m=requestMutasi&s=approved&id_operator=<?php echo $row['id_operator']; ?>"
        onclick="return confirm('Yakin Akan Melakukkan Approved Mutasi?')">
        <button class="btn btn-success">Izinkan Mutasi</button>
    </a> | 
    <a href="?m=requestMutasi&s=reject&id_operator=<?php echo $row['id_operator']; ?>"
        onclick="return confirm('Yakin Akan Melakukkan Reject Mutasi?')">
        <button class="btn btn-danger">Tolak</button>
    </a> |
    <a href="?m=requestMutasi&s=view_approved&id_operator=<?php echo $row['id_operator']; ?>">
        <i class="fa fa-search btn btn-info"></i>
    </a> 
</td>

</tr>
<?php endforeach; ?>
