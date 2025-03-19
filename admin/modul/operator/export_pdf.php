<?php
require('../fungsi/fpdf.php');
include('../koneksi.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['userinv'];
$query = "SELECT * FROM tb_admin WHERE username = '$username'"; 
$result = mysqli_query($koneksi, $query);
$admin = mysqli_fetch_assoc($result);

$jabatan_admin = isset($admin['jabatan']) ? $admin['jabatan'] : '';
$cabang_admin = isset($admin['cabang']) ? $admin['cabang'] : '';

if ($jabatan_admin == "Korcap") {
    $data = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE penempatan_opr = '$cabang_admin'");
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM tb_operator");
}
$jumlah_data = mysqli_num_rows($data);

if (isset($_GET['print']) && $_GET['print'] == 'all') {
    if ($jabatan_admin == "Korcap") {
        $query = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE penempatan_opr = '$cabang_admin'");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM tb_operator");
    }
} else {
    $id_operator = $_GET['id_operator'] ?? null;
    if (!$id_operator) die('ID Operator tidak ditemukan.');
    
    $query = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE id_operator = '$id_operator'");
    $data_operator = mysqli_fetch_assoc($query);
    if (!$data_operator) die('Data Operator tidak ditemukan.');
}

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Fungsi untuk hitung jumlah baris
function calculateNumberOfLines($pdf, $text, $columnWidth) {
    $text = trim($text);
    if ($text === '') return 1;
    
    $words = explode(' ', $text);
    $currentLine = '';
    $lines = 1;
    
    foreach ($words as $word) {
        $testLine = $currentLine === '' ? $word : $currentLine . ' ' . $word;
        $testWidth = $pdf->GetStringWidth($testLine);
        if ($testWidth > $columnWidth) {
            $lines++;
            $currentLine = $word;
        } else {
            $currentLine = $testLine;
        }
    }
    return $lines;
}

// Header
$pdf->Cell(0, 10, 'Laporan Data Operator', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200);
$header = ['No', 'Nama Operator', 'NIK', 'Alamat', 'No SIO', 'Operator', 'Kelas', 'Cabang', 'Status'];
$widths = [10, 35, 30, 55, 55, 40, 20, 20, 15];

foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi Data
$pdf->SetFont('Arial', '', 8);
$no = 1;

if (isset($_GET['print']) && $_GET['print'] == 'all') {
    while ($row = mysqli_fetch_assoc($query)) {
        $alamat = $row['alamat'];
        $columnWidth = 55;
        $numLines = calculateNumberOfLines($pdf, $alamat, $columnWidth);
        $lineHeight = 5;
        $cellHeight = $numLines * $lineHeight;
        $yBefore = $pdf->GetY();

        // Kolom 1-3
        $pdf->Cell(10, $cellHeight, $no++, 1, 0, 'C');
        $pdf->Cell(35, $cellHeight, $row['nama_operator'], 1, 0, 'L');
        $pdf->Cell(30, $cellHeight, $row['nik'], 1, 0, 'L');

        // Kolom Alamat (MultiCell)
        $xAlamat = $pdf->GetX();
        $yAlamat = $pdf->GetY();
        $pdf->MultiCell(55, $lineHeight, $alamat, 1, 'L');
        
        // Reset posisi untuk kolom berikutnya
        $pdf->SetXY($xAlamat + 55, $yBefore);

        // Kolom 5-9
        $pdf->Cell(55, $cellHeight, $row['no_sio'], 1, 0, 'L');
        $pdf->Cell(40, $cellHeight, $row['operator'], 1, 0, 'L');
        $pdf->Cell(20, $cellHeight, $row['kelas_operator'], 1, 0, 'L');
        $pdf->Cell(20, $cellHeight, $row['penempatan_opr'], 1, 0, 'L');
        $pdf->Cell(15, $cellHeight, $row['status'], 1, 1, 'L');
    }
} else {
    $alamat = $data_operator['alamat'];
    $columnWidth = 55;
    $numLines = calculateNumberOfLines($pdf, $alamat, $columnWidth);
    $lineHeight = 5;
    $cellHeight = $numLines * $lineHeight;
    $yBefore = $pdf->GetY();

    // Kolom 1-3
    $pdf->Cell(10, $cellHeight, 1, 1, 0, 'C');
    $pdf->Cell(35, $cellHeight, $data_operator['nama_operator'], 1, 0, 'L');
    $pdf->Cell(30, $cellHeight, $data_operator['nik'], 1, 0, 'L');

    // Kolom Alamat (MultiCell)
    $xAlamat = $pdf->GetX();
    $yAlamat = $pdf->GetY();
    $pdf->MultiCell(55, $lineHeight, $alamat, 1, 'L');
    
    // Reset posisi untuk kolom berikutnya
    $pdf->SetXY($xAlamat + 55, $yBefore);

    // Kolom 5-9
    $pdf->Cell(55, $cellHeight, $data_operator['no_sio'], 1, 0, 'L');
    $pdf->Cell(40, $cellHeight, $data_operator['operator'], 1, 0, 'L');
    $pdf->Cell(20, $cellHeight, $data_operator['kelas_operator'], 1, 0, 'L');
    $pdf->Cell(20, $cellHeight, $data_operator['penempatan_opr'], 1, 0, 'L');
    $pdf->Cell(15, $cellHeight, $data_operator['status'], 1, 1, 'L');
}

$pdf->Output('D', 'Laporan_Data_Operator.pdf');
?>