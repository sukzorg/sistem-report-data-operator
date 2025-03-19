<?php
function UploadFoto($namafile, $folder, $ukuran, $lokasi) {
    $fileupload = $folder . $namafile;

    // Pindahkan file yang di-upload
    if (move_uploaded_file($lokasi, $fileupload)) {
        // Identitas file asli (menggunakan GD library untuk manipulasi gambar)
        $gbr_asli = imagecreatefromjpeg($fileupload);
        $lebar = imageSX($gbr_asli);
        $tinggi = imageSY($gbr_asli);
        
        // Simpan dalam versi dikecilkan
        $thumb_lebar = $ukuran;
        $thumb_tinggi = ($thumb_lebar / $lebar) * $tinggi;

        // Proses perubahan dimensi ukuran
        $gbr_thumb = imagecreatetruecolor($thumb_lebar, $thumb_tinggi);
        imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $thumb_lebar, $thumb_tinggi, $lebar, $tinggi);

        // Hapus gambar di memori komputer
        imagedestroy($gbr_asli);
        imagedestroy($gbr_thumb);
    }
}

function kecilkangambar($gambar, $lebar = 0, $tinggi = 0) {
    if ($lebar == 0 && $tinggi == 0) $lebar = 50;
    $im1 = imagecreatefromjpeg($gambar);
    $lebar1 = imagesx($im1);
    $tinggi1 = imagesy($im1);
    $lebar2 = 0;
    $tinggi2 = 0;
    if ($lebar > 0 && $lebar1 > $lebar) {
        $lebar2 = $lebar;
        $tinggi2 = ($lebar2 / $lebar1) * $tinggi1;
        $tinggi2 = round($tinggi2);
    } elseif ($tinggi > 0 && $tinggi1 > $tinggi) {
        $tinggi2 = $tinggi;
        $lebar2 = ($tinggi2 / $tinggi1) * $lebar1;
        $lebar2 = round($lebar2);
    }

    if ($lebar2 < $lebar1 || $tinggi2 < $tinggi1) {
        $im2 = imagecreatetruecolor($lebar2, $tinggi2);
        imagecopyresized($im2, $im1, 0, 0, 0, 0, $lebar2, $tinggi2, $lebar1, $tinggi1);
        imagejpeg($im2, $gambar, 90);
    }
}
?>
