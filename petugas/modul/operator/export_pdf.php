<?php
require('../fungsi/fpdf.php');
include('../koneksi.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cabang_admin = $_SESSION['cabanginv2'];

// Fungsi untuk menghitung jumlah baris
function calculateLines($pdf, $text, $maxWidth) {
    $text = trim($text);
    if($text === '') return 1;
    
    $words = explode(' ', $text);
    $currentLine = '';
    $lines = 1;
    
    foreach($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $testWidth = $pdf->GetStringWidth(trim($testLine));
        if($testWidth > $maxWidth) {
            $lines++;
            $currentLine = $word;
        } else {
            $currentLine = $testLine;
        }
    }
    return $lines;
}

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Data Operator', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header Tabel
$header = ['No', 'Nama Operator', 'NIK', 'Alamat', 'No SIO', 'Operator', 'Kelas', 'Cabang', 'Status'];
$widths = [10, 35, 30, 55, 55, 40, 20, 20, 15];
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200);

foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi Data
$pdf->SetFont('Arial', '', 8);
$lineHeight = 5; // Tinggi per baris

if (isset($_GET['print']) && $_GET['print'] == 'all') {
    $query = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE penempatan_opr = '$cabang_admin'");
    $no = 1;
    
    while ($row = mysqli_fetch_assoc($query)) {
        // Hitung tinggi baris untuk alamat
        $addressLines = calculateLines($pdf, $row['alamat'], $widths[3]);
        $rowHeight = $lineHeight * $addressLines;
        
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();
        
        // Kolom 1-3
        $pdf->MultiCell($widths[0], $rowHeight, $no++, 1, 'C');
        $pdf->SetXY($xPos + $widths[0], $yPos);
        $pdf->MultiCell($widths[1], $rowHeight, $row['nama_operator'], 1, 'L');
        $pdf->SetXY($xPos + $widths[0] + $widths[1], $yPos);
        $pdf->MultiCell($widths[2], $rowHeight, $row['nik'], 1, 'L');
        $pdf->SetXY($xPos + $widths[0] + $widths[1] + $widths[2], $yPos);
        
        // Kolom Alamat (MultiCell)
        $pdf->MultiCell($widths[3], $lineHeight, $row['alamat'], 1, 'L');
        $newY = $pdf->GetY();
        
        // Kolom 5-9
        $pdf->SetXY($xPos + array_sum(array_slice($widths,0,4)), $yPos);
        $pdf->MultiCell($widths[4], $rowHeight, $row['no_sio'], 1, 'L');
        $pdf->SetXY($xPos + array_sum(array_slice($widths,0,5)), $yPos);
        $pdf->MultiCell($widths[5], $rowHeight, $row['operator'], 1, 'L');
        $pdf->SetXY($xPos + array_sum(array_slice($widths,0,6)), $yPos);
        $pdf->MultiCell($widths[6], $rowHeight, $row['kelas_operator'], 1, 'L');
        $pdf->SetXY($xPos + array_sum(array_slice($widths,0,7)), $yPos);
        $pdf->MultiCell($widths[7], $rowHeight, $row['penempatan_opr'], 1, 'L');
        $pdf->SetXY($xPos + array_sum(array_slice($widths,0,8)), $yPos);
        $pdf->MultiCell($widths[8], $rowHeight, $row['status'], 1, 'L');
        
        $pdf->SetY(max($newY, $pdf->GetY()));
    }
} else {
    $id_operator = $_GET['id_operator'] ?? die('ID Operator tidak ditemukan.');
    $query = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE id_operator = '$id_operator'");
    $row = mysqli_fetch_assoc($query) ?? die('Data Operator tidak ditemukan.');
    
    // Hitung tinggi baris untuk alamat
    $addressLines = calculateLines($pdf, $row['alamat'], $widths[3]);
    $rowHeight = $lineHeight * $addressLines;
    
    // Output single row dengan cara yang sama seperti di atas
    // ... (implementasi serupa dengan bagian while loop di atas)
}

$pdf->Output('D', 'Laporan_Data_Operator.pdf');
?>