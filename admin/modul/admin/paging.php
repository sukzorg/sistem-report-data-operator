<?php
include '../koneksi.php';

// Pastikan session_start() hanya dipanggil sekali
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Mendapatkan username admin yang login
$username = $_SESSION['userinv'];

// Ambil data admin berdasarkan username
$query = "SELECT * FROM tb_admin WHERE username = '$username'"; 
$result = mysqli_query($koneksi, $query);
$admin = mysqli_fetch_assoc($result);

// Mendapatkan jabatan dan cabang admin yang login
$jabatan = isset($admin['jabatan']) ? $admin['jabatan'] : ''; 
$cabang = isset($admin['cabang']) ? $admin['cabang'] : '';

$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Menampilkan jumlah data sesuai dengan cabang admin jika jabatan Korcap
if ($jabatan == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai dengan jabatan "Korcap"
    $data = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE cabang = '$cabang' AND jabatan = 'Korcap'");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_admin");
}

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

// Menampilkan data admin sesuai dengan cabang jika jabatan Korcap
if ($jabatan == "Korcap") {
    // Jika jabatan Korcap, hanya tampilkan data dari cabang yang sesuai dan jabatan yang sesuai
    $data_karyawan = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE cabang = '$cabang' AND jabatan = 'Korcap' LIMIT $halaman_awal, $batas");
} else {
    // Jika jabatan selain Korcap, tampilkan seluruh data
    $data_karyawan = mysqli_query($koneksi, "SELECT * FROM tb_admin LIMIT $halaman_awal, $batas");
}

$nomor = $halaman_awal + 1;

while ($row = mysqli_fetch_array($data_karyawan)) {
    // Cek jika peran admin saat ini adalah Korcap dan mereka mencoba melihat data selain Korcap di cabang mereka
    if ($jabatan == "Korcap" && ($row['jabatan'] != "Korcap" || $row['cabang'] != $cabang)) {
        continue;  // Lewati jika data tidak sesuai jabatan atau cabang
    }
?>
<tr>
    <td><?php echo $nomor++; ?></td> <!-- Ganti id_admin dengan nomor urut -->
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['jabatan']; ?></td>
    <td><?php echo $row['telepon']; ?></td>
    <td><?php echo $row['cabang']; ?></td>
    <td>
        <a href="index.php?m=admin&s=hapus&id_admin=<?php echo $row['id_admin']; ?>" onclick="return confirm('Yakin Akan dihapus?')">
            <button class="btn btn-danger">Hapus</button>
        </a> | 
        <a href="index.php?m=admin&s=ubah&id_admin=<?php echo $row['id_admin']; ?>" onclick="return confirm('Yakin Akan diubah?')">
            <button class="btn btn-primary">Ubah</button>
        </a>
    </td>
</tr>
<?php } ?>
