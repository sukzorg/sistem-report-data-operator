<?php
// Sertakan pustaka FPDF dan koneksi
require('../fungsi/fpdf.php');
include('../koneksi.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi cabang dari sesi
$cabang_admin = $_SESSION['cabanginv2'];

// Hitung total data berdasarkan cabang
$data = mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE penempatan = '$cabang_admin'");
$jumlah_data = mysqli_num_rows($data);

// Cek parameter untuk print all atau berdasarkan id_laporan
if (isset($_GET['print']) && $_GET['print'] == 'all') {
    // Ambil semua data laporan
    $query = mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE penempatan = '$cabang_admin'");
} else {
    // Ambil data berdasarkan id_laporan
    $id_laporan = isset($_GET['id_laporan']) ? $_GET['id_laporan'] : null;

    if (!$id_laporan) {
        die('ID Laporan tidak ditemukan.');
    }

    $query = mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE id_laporan = '" . mysqli_real_escape_string($koneksi, $id_laporan) . "'");
    $data_laporan = mysqli_fetch_assoc($query);

    if (!$data_laporan) {
        die('Data Laporan tidak ditemukan.');
    }
}

// Buat instance FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // L = Landscape, A4 = Ukuran Kertas
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header Laporan
$pdf->Cell(0, 10, 'Rapot Data Operator', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200); // Warna latar belakang header
$header = [
    'No', 'Nama Operator', 'No SIO', 'Penempatan', 'Tgl Kejadian', 'Kejadian',
    'Note', 'No Berita Acara', 'Foto Kejadian'
];
$widths = [10, 40, 25, 30, 30, 35, 40, 35, 30];

// Header kolom tabel
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi data ke tabel
$pdf->SetFont('Arial', '', 8);
$no = 1;

if (isset($_GET['print']) && $_GET['print'] == 'all') {
    while ($row = mysqli_fetch_assoc($query)) {
        $height = 10; // Default tinggi baris

        // Jika ada foto kejadian, atur tinggi baris lebih besar
        if (!empty($row['foto_kejadian']) && file_exists('../images/foto_kejadian/' . $row['foto_kejadian'])) {
            $height = 30; // Tinggi baris untuk foto
        }

        $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C'); // Nomor
        $pdf->Cell($widths[1], $height, $row['nama_operator_report'], 1, 0, 'L');
        $pdf->Cell($widths[2], $height, $row['no_sio_opr'], 1, 0, 'L');
        $pdf->Cell($widths[3], $height, $row['penempatan'], 1, 0, 'L');
        $pdf->Cell($widths[4], $height, $row['tgl_kejadian'], 1, 0, 'L');
        $pdf->Cell($widths[5], $height, $row['kejadian'], 1, 0, 'L');
        $pdf->Cell($widths[6], $height, $row['note'], 1, 0, 'L');
        $pdf->Cell($widths[7], $height, $row['no_berita_acara'], 1, 0, 'L');

        // Foto Kejadian
        if (!empty($row['foto_kejadian']) && file_exists('../images/foto_kejadian/' . $row['foto_kejadian'])) {
            $pdf->Cell($widths[8], $height, '', 1, 0, 'C');
            $pdf->Image('../images/foto_kejadian/' . $row['foto_kejadian'], $pdf->GetX() - $widths[8] + 5, $pdf->GetY() + 2, 20, 20);
        } else {
            $pdf->Cell($widths[8], $height, 'Tidak Ada', 1, 0, 'C'); // Menampilkan teks jika gambar tidak ada
        }
        $pdf->Ln();
    }
} else {
    $height = 10; // Default tinggi baris

    if (!empty($data_laporan['foto_kejadian']) && file_exists('../images/foto_kejadian/' . $data_laporan['foto_kejadian'])) {
        $height = 30; // Tinggi baris untuk foto
    }

    $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C'); // Nomor
    $pdf->Cell($widths[1], $height, $data_laporan['nama_operator_report'], 1, 0, 'L');
    $pdf->Cell($widths[2], $height, $data_laporan['no_sio_opr'], 1, 0, 'L');
    $pdf->Cell($widths[3], $height, $data_laporan['penempatan'], 1, 0, 'L');
    $pdf->Cell($widths[4], $height, $data_laporan['tgl_kejadian'], 1, 0, 'L');
    $pdf->Cell($widths[5], $height, $data_laporan['kejadian'], 1, 0, 'L');
    $pdf->Cell($widths[6], $height, $data_laporan['note'], 1, 0, 'L');
    $pdf->Cell($widths[7], $height, $data_laporan['no_berita_acara'], 1, 0, 'L');

    // Foto Kejadian
    if (!empty($data_laporan['foto_kejadian']) && file_exists('../images/foto_kejadian/' . $data_laporan['foto_kejadian'])) {
        $pdf->Cell($widths[8], $height, '', 1, 0, 'C');
        $pdf->Image('../images/foto_kejadian/' . $data_laporan['foto_kejadian'], $pdf->GetX() - $widths[8] + 5, $pdf->GetY() + 2, 20, 20);
    } else {
        $pdf->Cell($widths[8], $height, 'Tidak Ada', 1, 0, 'C'); // Menampilkan teks jika gambar tidak ada
    }
}

// Output file PDF
$pdf->Output('D', 'Laporan_Rapot_Operator.pdf');
?>
