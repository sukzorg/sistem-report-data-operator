<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Detail Foto Sertifikat</title>

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
            <h1 class="page-header">Detail MOU</h1>
          </div>
        </div>

        <?php
        include '../koneksi.php';

        // Ambil ID operator dari parameter URL
        $id_batangan = $_GET['id_batangan'];

        // Query untuk mengambil data operator berdasarkan id_operator
        $query_batangan = mysqli_query($koneksi, "SELECT * FROM tb_batangan WHERE id_batangan = '$id_batangan'");
        $batangan = mysqli_fetch_assoc($query_batangan);
        ?>


        <!-- Menampilkan Foto MOU -->
        <section class="photo-section">
          <h4>Foto MOU</h4>
          <img src="../images/foto_mou/<?php echo $batangan['foto_mou']; ?>" class="img-thumbnail" alt="Foto MOU">
          <!-- Button Download Foto MOU -->
          <a href="../images/foto_mou/<?php echo $batangan['foto_mou']; ?>" class="btn btn-success download-btn" download>Download Foto MOU</a>
        </section>

        <!-- Kembali ke halaman sebelumnya -->
        <section class="back-button">
          <a href="?m=batanganUnit&s=awal" class="btn btn-primary">Kembali</a>
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
