<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $judul; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- boootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- icon dan fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- tema css -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">

    <!-- Link to External CSS (styles.css) -->
    <link href="../css/styles.css" rel="stylesheet">

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
          $id = $_SESSION['idinv2'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
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
              <li><a href="?m=awal.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?m=my_profile&s=awal"><i class="fa fa-user"></i> My Profile</a></li>
              <li><a href="?m=operator&s=awal"><i class="fa fa-archive"></i> Data Operator</a></li>
              <li><a href="?m=statusOperator&s=awal"><i class="fa fa-check"></i> Status Operator</a></li>
              <li><a href="?m=rapot_opr&s=awal"><i class="fa fa-sticky-note"></i> Data Rapot Operator</a></li>
              <li><a href="?m=batanganUnit&s=awal"> <i class="fa fa-book"></i> Data Batangan Unit</a></li>
              <li><a href="?m=biayaLain&s=awal"> <i class="fa fa-money"></i> Data Biaya Lain Lain</a></li>
              <li><a href="?m=mutasi&s=awal"> <i class="fa fa-rotate-right"></i> Pengajuan Mutasi</a></li>
              <li><a href="logout.php" onclick="return confirm('yakin ingin logout?')"><i class="fa fa-warning"></i> Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">My Profile</h1>
        </div>
      </div>

      <?php 
          $id = $_SESSION['idinv2'];
          include '../koneksi.php';
          
          // Query untuk mendapatkan data petugas berdasarkan ID
          $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
          $query = mysqli_query($koneksi, $sql);

          // Cek apakah query berhasil dan data ditemukan
          if ($query && mysqli_num_rows($query) > 0) {
              $r = mysqli_fetch_array($query);  // Ambil data petugas
          } else {
              $r = null;
              echo "<script>alert('Data tidak ditemukan');</script>";
          }
        ?>

      <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="profile-card">
                  <img src="../images/admin/admin.jpeg" alt="Profile Image" class="profile-image">
                  <div class="profile-details">
                    <h2 class="name"><?php echo $r['nama']; ?></h2>
                    <p class="cabang">Admin Cabang <?php echo $r['cabang']; ?></p>
                    <p class="telepon">No Telp: <?php echo $r['telepon']; ?></p>
                    <p class="cabang">Penempatan: <?php echo $r['cabang']; ?></p>
                  </div>
                </div>
              </div>
         </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p class="text-muted" style="font-size: 16px;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Sumber Rezeki</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!--include-->
    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>
