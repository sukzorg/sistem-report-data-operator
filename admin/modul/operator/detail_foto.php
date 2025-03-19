<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Detail Foto Operator</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">    

    <!-- boootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

     <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- icon dan fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- tema css -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    <link href="../css/detail_foto.css" rel="stylesheet">


  </head>
  <body>
    <!-- Menu -->
    <div id="wrapper">

      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand">Sistem Report Data Operator</a>
          </div>

          <?php 
          $id = $_SESSION['idinv'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);

           ?>

          <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user"></i> <?php echo $r['nama']; ?>
              </a>
               <ul class="dropdown-menu dropdown-user">
                <li>
                  <form class="" action="logout.php" onclick="return confirm('yakin ingin logout?');" method="post">
                    <button class="btn btn-default" type="submit" name="keluar"><i class="fa fa-sign-out"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>

        <!-- menu samping -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
            <li>
                <a href="?m=awal.php">
                  <i class="fa fa-dashboard"></i> Beranda
                </a>
              </li>
              <li>
                <a href="?m=admin&s=awal">
                  <i class="fa fa-user"></i> Data Super Admin
                </a>
              </li>
               <li>
                <a href="?m=petugas&s=awal">
                  <i class="fa fa-users"></i> Data Admin Cabang
                </a>
              <li>
                <a href="?m=operator&s=awal">
                  <i class="fa fa-archive"></i> Data Operator
                </a>
              </li>
              <li>
                <a href="?m=statusOperator&s=awal">
                  <i class="fa fa-check"></i> Status Operator
                </a>
              </li>
              <li>
                <a href="?m=rapot_opr&s=awal">
                  <i class="fa fa-sticky-note"></i> Data Rapot Operator
                </a>
              </li>
              <li>
                <a href="?m=batanganUnit&s=awal">
                  <i class="fa fa-book"></i> Data Batangan Unit
                </a>
              </li>
              <li>
                <a href="?m=biayaLain&s=awal">
                  <i class="fa fa-money"></i> Data Biaya Lain Lain
                </a>
              </li>
              <li>
                <a href="?m=requestMutasi&s=awal">
                  <i class="fa fa-bookmark"></i> Data Request Mutasi
                </a>
              </li>
              <li>
                <a href="logout.php" onclick="return confirm('yakin ingin logout?')">
                  <i class="fa fa-warning"></i> Logout
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Detail Foto Operator</h1>
          </div>
        </div>

        <?php
        include '../koneksi.php';

        // Ambil ID operator dari parameter URL
        $id_operator = $_GET['id_operator'];

        // Query untuk mengambil data operator berdasarkan id_operator
        $query_operator = mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE id_operator = '$id_operator'");
        $operator = mysqli_fetch_assoc($query_operator);
        ?>

        <!-- Menampilkan Foto KTP -->
        <section class="photo-section">
          <h4>Foto KTP</h4>
          <img src="../images/foto_ktp/<?php echo $operator['foto_ktp']; ?>" class="img-thumbnail" alt="Foto ktp">
          <!-- Button Download Foto KTP -->
          <a href="../images/foto_ktp/<?php echo $operator['foto_ktp']; ?>" class="btn btn-success download-btn" download>Download Foto ktp</a>
        </section>

        <!-- Menampilkan Foto SIO -->
        <section class="photo-section">
          <h4>Foto SIO</h4>
          <img src="../images/foto_sio/<?php echo $operator['foto_sio']; ?>" class="img-thumbnail" alt="Foto SIO">
          <!-- Button Download Foto SIO -->
          <a href="../images/foto_sio/<?php echo $operator['foto_sio']; ?>" class="btn btn-success download-btn" download>Download Foto SIO</a>
        </section>

        <!-- Menampilkan Foto SIM -->
        <section class="photo-section">
          <h4>Foto SIM</h4>
          <img src="../images/foto_sim/<?php echo $operator['foto_sim']; ?>" class="img-thumbnail" alt="Foto SIM">
          <!-- Button Download Foto SIM -->
          <a href="../images/foto_sim/<?php echo $operator['foto_sim']; ?>" class="btn btn-success download-btn" download>Download Foto SIM</a>
        </section>

        <!-- Menampilkan Foto Sertifikat Depan -->
        <section class="photo-section">
          <h4>Foto Sertifikat Depan</h4>
          <img src="../images/sertifikat/<?php echo $operator['foto_sertifikat_dpn']; ?>" class="img-thumbnail" alt="Foto Sertifikat Depan">
          <!-- Button Download Foto Sertifikat Depan -->
          <a href="../images/sertifikat/<?php echo $operator['foto_sertifikat_dpn']; ?>" class="btn btn-success download-btn" download>Download Foto Sertifikat Depan</a>
        </section>

        <!-- Menampilkan Foto Sertifikat Belakang -->
        <section class="photo-section">
          <h4>Foto Sertifikat Belakang</h4>
          <img src="../images/sertifikat/<?php echo $operator['foto_sertifikat_blk']; ?>" class="img-thumbnail" alt="Foto Sertifikat Belakang">
          <!-- Button Download Foto Sertifikat Belakang -->
          <a href="../images/sertifikat/<?php echo $operator['foto_sertifikat_blk']; ?>" class="btn btn-success download-btn" download>Download Foto Sertifikat Belakang</a>
        </section>

        <!-- Menampilkan Foto Operator -->
        <section class="photo-section">
          <h4>Foto Operator</h4>
          <img src="../images/foto_operator/<?php echo $operator['foto_operator']; ?>" class="img-thumbnail" alt="Foto Operator">
          <!-- Button Download Foto operator -->
          <a href="../images/foto_operator/<?php echo $operator['foto_operator']; ?>" class="btn btn-success download-btn" download>Download Foto Operator</a>
        </section>


        <!-- Kembali ke halaman sebelumnya -->
        <section class="back-button">
          <a href="?m=operator&s=awal" class="btn btn-primary">Kembali</a>
        </section>
      </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p class="text-muted" style="font-size: 16px;">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Sumber Rezeki</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="../vendor/js/bootstrap.min.js"></script>

  </body>
</html>
