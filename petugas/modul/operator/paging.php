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
    <td><?php echo $row['nik']; ?></td>
    <td><?php echo $row['alamat']; ?></td>
    <td><?php echo $row['no_telp']; ?></td>
    <td><?php echo $row['no_sio']; ?></td>
    <td><?php echo $row['jenis_sio']; ?></td>
    <td><?php echo $row['operator']; ?></td>
    <td><?php echo $row['kelas_operator']; ?></td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Foto KTP</a>
    </td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Foto SIO</a>
    </td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Foto SIM</a>
    </td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Sertifikat Depan</a>
    </td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Sertifikat Belakang</a>
    </td>
    <td>
        <a href="?m=operator&s=detail_foto&id_operator=<?php echo $row['id_operator']; ?>" class="btn btn-warning">Lihat Operator</a>
    </td>
    <td><?php echo $row['penempatan_opr']; ?></td>
    <td><?php echo $row['tgl_masuk']; ?></td>
    <td><a href="?m=rapot_opr&s=title.php" class="btn btn-info">Report</a></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <a href="?m=statusOperator&s=awal&id_operator==<?php echo $row['id_operator']; ?>" class="btn btn-success">Lihat Detail</a>
        <a href="?m=operator&s=export_pdf&id_operator=<?php echo $row['id_operator']; ?>">
                <i class="fa fa-print"></i> Print PDF
            </a>
    </td>
    <td>
        <a href="index.php?m=operator&s=hapus&id_operator=<?php echo $row['id_operator']; ?>" onclick="return confirm('Yakin Akan dihapus?')" class="btn btn-danger">Hapus</a>
        |
        <a href="index.php?m=operator&s=ubah&id_operator=<?php echo $row['id_operator']; ?>" onclick="return confirm('Yakin Akan diubah?')" class="btn btn-primary">Ubah</a>
    </td>
</tr>
<?php endforeach; ?>
