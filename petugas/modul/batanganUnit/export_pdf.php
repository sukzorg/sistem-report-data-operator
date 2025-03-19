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
$data = mysqli_query($koneksi, "SELECT * FROM tb_batangan WHERE penempatan = '$cabang_admin'");
$jumlah_data = mysqli_num_rows($data);

// Cek parameter untuk print all atau berdasarkan id_batangan
if (isset($_GET['print']) && $_GET['print'] == 'all') {
    // Ambil semua data batangan
    $query = mysqli_query($koneksi, "SELECT * FROM tb_batangan WHERE penempatan = '$cabang_admin'");
} else {
    // Ambil data berdasarkan id_batangan
    $id_batangan = isset($_GET['id_batangan']) ? $_GET['id_batangan'] : null;

    if (!$id_batangan) {
        die('ID Batangan tidak ditemukan.');
    }

    $query = mysqli_query($koneksi, "SELECT * FROM tb_batangan WHERE id_batangan = '" . mysqli_real_escape_string($koneksi, $id_batangan) . "'");
    $data_batangan = mysqli_fetch_assoc($query);

    if (!$data_batangan) {
        die('Data Batangan tidak ditemukan.');
    }
}


// Buat instance FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // L = Landscape, A4 = Ukuran Kertas
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header Laporan
$pdf->Cell(0, 10, 'Data Batangan Unit Operator', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200); // Warna latar belakang header
$header = [
    'No', 'Nama Operator', 'Penempatan', 'Jenis Unit', 'Merek Unit',
    'Tonase', 'No Unit', 'Nama Helper', 'Foto MOU'
];
$widths = [10, 40, 25, 40, 30, 20, 30, 35, 35];

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

         // Jika ada foto Mou, atur tinggi baris lebih besar
         if (!empty($row['foto_mou']) && file_exists('../images/foto_mou/' . $row['foto_mou'])) {
         $height = 30; // Tinggi baris untuk foto
         }

         $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C'); // Nomor
         $pdf->Cell($widths[1], $height, $row['nama_operator'], 1, 0, 'L');
         $pdf->Cell($widths[2], $height, $row['penempatan'], 1, 0, 'L');
         $pdf->Cell($widths[3], $height, $row['jenis_unit'], 1, 0, 'L');
         $pdf->Cell($widths[4], $height, $row['merek_unit'], 1, 0, 'L');
         $pdf->Cell($widths[5], $height, $row['tonase'], 1, 0, 'L');
         $pdf->Cell($widths[6], $height, $row['no_unit'], 1, 0, 'L');
         $pdf->Cell($widths[7], $height, $row['nama_helper'], 1, 0, 'L');

        // Foto Mou
        if (!empty($row['foto_mou']) && file_exists('../images/foto_mou/' . $row['foto_mou'])) {
            $pdf->Cell($widths[8], $height, '', 1, 0, 'C');
            $pdf->Image('../images/foto_mou/' . $row['foto_mou'], $pdf->GetX() - $widths[8] + 5, $pdf->GetY() + 2, 20, 20);
        } else {
            $pdf->Cell($widths[8], $height, 'Tidak Ada', 1, 0, 'C'); // Menampilkan teks jika gambar tidak ada
        }
        $pdf->Ln();
    }
} else {
    $height = 10; // Default tinggi baris

    if (!empty($data_batangan['foto_mou']) && file_exists('../images/foto_mou/' . $data_batangan['foto_mou'])) {
        $height = 30; // Tinggi baris untuk foto
    }

    $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C'); // Nomor
    $pdf->Cell($widths[1], $height, $data_batangan['nama_operator'], 1, 0, 'L');
    $pdf->Cell($widths[2], $height, $data_batangan['penempatan'], 1, 0, 'L');
    $pdf->Cell($widths[3], $height, $data_batangan['jenis_unit'], 1, 0, 'L');
    $pdf->Cell($widths[4], $height, $data_batangan['merek_unit'], 1, 0, 'L');
    $pdf->Cell($widths[5], $height, $data_batangan['tonase'], 1, 0, 'L');
    $pdf->Cell($widths[6], $height, $data_batangan['no_unit'], 1, 0, 'L');
    $pdf->Cell($widths[7], $height, $data_batangan['nama_helper'], 1, 0, 'L');

        // Foto Mou
        if (!empty($data_batangan['foto_mou']) && file_exists('../images/foto_mou/' . $data_batangan['foto_mou'])) {
            $pdf->Cell($widths[8], $height, '', 1, 0, 'C');
            $pdf->Image('../images/foto_mou/' . $data_batangan['foto_mou'], $pdf->GetX() - $widths[8] + 5, $pdf->GetY() + 2, 20, 20);
        } else {
            $pdf->Cell($widths[8], $height, 'Tidak Ada', 1, 0, 'C'); // Menampilkan teks jika gambar tidak ada
        }
    }

// Output file PDF
$pdf->Output('D', 'Laporan_Batangan_Unit_Data_Operator.pdf');
?>
