<?php
include '../koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi cabang dari sesi
$cabang_admin = $_SESSION['cabanginv2'];

// Konfigurasi pagination
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Hitung total data berdasarkan cabang
$data = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE penempatan_opr = '$cabang_admin'");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;

// Query untuk mengambil data operator dengan pembatasan cabang dan pencarian berdasarkan nama atau NIK
if (isset($_POST['go'])) {
    $cari = mysqli_real_escape_string($koneksi, $_POST['cari']);
    // Pencarian berdasarkan nama atau NIK operator
    $data_operator = mysqli_query($koneksi, "
        SELECT * 
        FROM tb_operator 
        WHERE penempatan_opr = '$cabang_admin' 
        AND (nama_operator LIKE '%$cari%' OR nik LIKE '%$cari%')
        LIMIT $halaman_awal, $batas
    ");
} else {
    $data_operator = mysqli_query($koneksi, "
        SELECT * 
        FROM tb_operator 
        WHERE penempatan_opr = '$cabang_admin'
        LIMIT $halaman_awal, $batas
    ");
}

// Tampilkan data operator
foreach ($data_operator as $row) :
?>
<tr>
    <td><?php echo $nomor++; ?></td>
    <td><?php echo $row['nama_operator']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['penempatan_opr']; ?></td>
    <td>
        <a href="?m=mutasi&s=form_approved&id_operator=<?php echo $row['id_operator']; ?>">
            <button class="btn btn-success">Ajukan Mutasi</button>
        </a> | 
        <a href="?m=mutasi&s=view_approved&id_operator=<?php echo $row['id_operator']; ?>">
            <button class="btn btn-info">Cek Mutasi</button>
        </a>
    </td>

</tr>
<?php endforeach; ?>


