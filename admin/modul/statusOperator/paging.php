<?php
include 'control.php';

if (isset($_POST['go'])) {
    // Validasi input
    $cari = htmlspecialchars(trim($_POST['cari']));

    // Ambil data dari fungsi pencarian
    $data = search_operator($cari);

    if (!empty($data)) {
        foreach ($data as $row) {
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="profile-card">
                    <?php
                    // Tentukan class tambahan berdasarkan status
                    $status = strtolower($row['status']); // Ubah status ke huruf kecil untuk konsistensi
                    $statusClass = '';

                    switch ($status) {
                        case 'aktif':
                            $statusClass = 'status-green'; // Hijau
                            break;
                        case 'non aktif':
                            $statusClass = 'status-gray'; // Abu-abu
                            break;
                        case 'sp':
                            $statusClass = 'status-yellow'; // Kuning
                            break;
                        case 'blacklist':
                            $statusClass = 'status-red'; // Merah
                            break;
                        case 'mutasi':
                            $statusClass = 'status-blue'; // Biru
                            break;
                        case 'skorsing':
                            $statusClass = 'status-orange'; // Oranye
                            break;
                        default:
                            $statusClass = 'status-default'; // Default warna (hitam)
                            break;
                    }
                    ?>
                    <div class="status-badge <?php echo $statusClass; ?>">
                        <?php echo ucfirst($status); ?>
                    </div>
                    <img src="<?php echo !empty($row['foto_operator']) 
                        ? '../images/foto_operator/' . htmlspecialchars($row['foto_operator']) 
                        : '../images/admin/icon.png'; ?>"
                         alt="Profile Image" class="profile-image">
                    <div class="profile-details">
                        <h2 class="name"><?php echo htmlspecialchars($row['nama_operator']); ?></h2>
                        <p class="no_sio">No SIO: <?php echo htmlspecialchars($row['no_sio']); ?></p>
                        <p class="operator">Operator: <?php echo htmlspecialchars($row['operator']); ?></p>
                        <p class="penempatan_opr">Tempat Tugas: <?php echo htmlspecialchars($row['penempatan_opr']); ?></p>
                        <p class="tgl_masuk">Tanggal Masuk: <?php echo date("d/m/Y", strtotime($row['tgl_masuk'])); ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>Data tidak ditemukan untuk pencarian '<strong>" . htmlspecialchars($cari) . "</strong>'.</p>";
    }
}
?>
