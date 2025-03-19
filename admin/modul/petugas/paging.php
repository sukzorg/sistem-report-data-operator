<?php
include '../koneksi.php';

// Pastikan session_start() dipanggil
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Mendapatkan username admin yang login dari session
$username = $_SESSION['userinv'];

// Ambil data admin berdasarkan username
$query = "SELECT * FROM tb_admin WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$admin = mysqli_fetch_assoc($result);

// Mendapatkan cabang admin yang login
$cabang_admin = isset($admin['cabang']) ? $admin['cabang'] : ''; // Menyimpan cabang admin
$jabatan_admin = isset($admin['jabatan']) ? $admin['jabatan'] : ''; // Menyimpan jabatan admin

// Batas data per halaman
$batas = 5;

// Menentukan halaman yang aktif (default halaman pertama)
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Menentukan halaman awal berdasarkan halaman aktif
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// Menentukan halaman sebelumnya dan berikutnya
$previous = $halaman - 1;
$next = $halaman + 1;

// Query untuk mendapatkan jumlah total data petugas, disesuaikan dengan cabang admin
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, tampilkan hanya petugas yang ada di cabang tersebut
    $data = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE cabang = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan semua data petugas
    $data = mysqli_query($koneksi, "SELECT * FROM tb_petugas");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

// Query untuk menampilkan data petugas sesuai dengan batasan halaman dan cabang admin
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai
    $data_petugas = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE cabang = '$cabang_admin' LIMIT $halaman_awal, $batas");
} else {
    // Jika jabatan selain Korcap, tampilkan semua data petugas
    $data_petugas = mysqli_query($koneksi, "SELECT * FROM tb_petugas LIMIT $halaman_awal, $batas");
}

$nomor = $halaman_awal + 1;
?>

<!-- Menampilkan data petugas -->
<?php while ($row = mysqli_fetch_array($data_petugas)) { ?>
<tr>
    <td><?php echo $nomor++; ?></td> <!-- Ganti id_petugas dengan nomor urut -->
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['telepon']; ?></td>
    <td><?php echo $row['cabang']; ?></td>
    <td>
        <a href="index.php?m=petugas&s=hapus&id_petugas=<?php echo $row['id_petugas']; ?>" onclick="return confirm('Yakin Akan dihapus?')">
            <button class="btn btn-danger">Hapus</button>
        </a> | 
        <a href="index.php?m=petugas&s=ubah&id_petugas=<?php echo $row['id_petugas']; ?>" onclick="return confirm('Yakin Akan diubah?')">
            <button class="btn btn-primary">Ubah</button>
        </a>
    </td>
</tr>
<?php } ?>
