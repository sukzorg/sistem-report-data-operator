<?php
// Sertakan pustaka FPDF dan koneksi database
require('../fungsi/fpdf.php');
include('../koneksi.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi cabang dari sesi
$cabang_admin = $_SESSION['cabanginv'];
$jabatan_admin = $_SESSION['jabataninv']; // Mendapatkan jabatan admin yang login

// Hitung total data berdasarkan cabang admin yang login
if ($jabatan_admin == "Korcap") {
    // Jika jabatan Korcap, tampilkan hanya data dari cabang yang sesuai
    $data = mysqli_query($koneksi, "SELECT * FROM tb_lain_lain WHERE penempatan = '$cabang_admin'");
} else {
    // Jika jabatan selain Korcap, tampilkan semua data
    $data = mysqli_query($koneksi, "SELECT * FROM tb_lain_lain");
}
$jumlah_data = mysqli_num_rows($data);

// Cek parameter untuk print semua data atau berdasarkan id_biaya
if (isset($_GET['print']) && $_GET['print'] == 'all') {
    // Jika jabatan Korcap, ambil data dari cabang yang sesuai
    if ($jabatan_admin == "Korcap") {
        $query = mysqli_query($koneksi, "SELECT * FROM tb_lain_lain WHERE penempatan = '$cabang_admin'");
    } else {
        // Admin selain Korcap bisa melihat semua data
        $query = mysqli_query($koneksi, "SELECT * FROM tb_lain_lain");
    }
} else {
     // Ambil data berdasarkan id_biaya
     $id_biaya = isset($_GET['id_biaya']) ? $_GET['id_biaya'] : null;

     if (!$id_biaya) {
         die('ID biaya tidak ditemukan.');
     }
 
     $query = mysqli_query($koneksi, "SELECT * FROM tb_lain_lain WHERE id_biaya = '" . mysqli_real_escape_string($koneksi, $id_biaya) . "'");
     $data_biaya = mysqli_fetch_assoc($query);
 
     if (!$data_biaya) {
         die('Data Biaya tidak ditemukan.');
     }
}

// Buat instance FPDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header Laporan
$pdf->Cell(0, 10, 'Laporan Biaya Lain Lain Unit Operator', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200);
$header = ['No', 'Nama Operator', 'Penempatan', 'Jenis Unit', 'Merek Unit', 'Tonase', 'No Unit', 'Keterangan Biaya', 'Waktu', 'Foto'];
$widths = [10, 40, 25, 40, 30, 20, 25, 35, 20, 35];

// Cetak Header
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi Data Tabel
$pdf->SetFont('Arial', '', 8);
$no = 1;

if (isset($_GET['print']) && $_GET['print'] == 'all') {
    while ($row = mysqli_fetch_assoc($query)) {
        $height = 10; // Default tinggi baris

        if (!empty($row['foto_keterangan']) && file_exists('../images/foto_keterangan/' . $row['foto_keterangan'])) {
            $height = 30; // Jika ada foto, tinggi baris diperbesar
        }

        // Isi data ke dalam tabel
        $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C');
        $pdf->Cell($widths[1], $height, $row['nama_operator'], 1, 0, 'L');
        $pdf->Cell($widths[2], $height, $row['penempatan'], 1, 0, 'L');
        $pdf->Cell($widths[3], $height, $row['jenis_unit'], 1, 0, 'L');
        $pdf->Cell($widths[4], $height, $row['merek_unit'], 1, 0, 'L');
        $pdf->Cell($widths[5], $height, $row['tonase'], 1, 0, 'L');
        $pdf->Cell($widths[6], $height, $row['no_unit'], 1, 0, 'L');
        $pdf->Cell($widths[7], $height, $row['keterangan_biaya'], 1, 0, 'L');
        $pdf->Cell($widths[8], $height, $row['waktu'], 1, 0, 'L');

        // Menambahkan Foto (jika ada)
        if (!empty($row['foto_keterangan']) && file_exists('../images/foto_keterangan/' . $row['foto_keterangan'])) {
            $pdf->Cell($widths[9], $height, '', 1, 0, 'C');
            $pdf->Image('../images/foto_keterangan/' . $row['foto_keterangan'], $pdf->GetX() - $widths[9] + 5, $pdf->GetY() + 2, 20, 20);
        } else {
            $pdf->Cell($widths[9], $height, 'Tidak Ada', 1, 0, 'C');
        }

        $pdf->Ln();
    }
} else {
    $height = 10; // Default tinggi baris

    if (!empty($data_biaya['foto_keterangan']) && file_exists('../images/foto_keterangan/' . $data_biaya['foto_keterangan'])) {
        $height = 30; // Jika ada foto, tinggi baris diperbesar
    }

    $pdf->Cell($widths[0], $height, $no++, 1, 0, 'C');
    $pdf->Cell($widths[1], $height, $data_biaya['nama_operator'], 1, 0, 'L');
    $pdf->Cell($widths[2], $height, $data_biaya['penempatan'], 1, 0, 'L');
    $pdf->Cell($widths[3], $height, $data_biaya['jenis_unit'], 1, 0, 'L');
    $pdf->Cell($widths[4], $height, $data_biaya['merek_unit'], 1, 0, 'L');
    $pdf->Cell($widths[5], $height, $data_biaya['tonase'], 1, 0, 'L');
    $pdf->Cell($widths[6], $height, $data_biaya['no_unit'], 1, 0, 'L');
    $pdf->Cell($widths[7], $height, $data_biaya['keterangan_biaya'], 1, 0, 'L');
    $pdf->Cell($widths[8], $height, $data_biaya['waktu'], 1, 0, 'L');

    // Menambahkan Foto (jika ada)
    if (!empty($data_biaya['foto_keterangan']) && file_exists('../images/foto_keterangan/' . $data_biaya['foto_keterangan'])) {
        $pdf->Cell($widths[9], $height, '', 1, 0, 'C');
        $pdf->Image('../images/foto_keterangan/' . $data_biaya['foto_keterangan'], $pdf->GetX() - $widths[9] + 5, $pdf->GetY() + 2, 20, 20);
    } else {
        $pdf->Cell($widths[9], $height, 'Tidak Ada', 1, 0, 'C');
    }

    $pdf->Ln();
}

// Output PDF
$pdf->Output('D', 'Laporan_Biaya_Lain_Lain_Data_Operator.pdf');
?>
