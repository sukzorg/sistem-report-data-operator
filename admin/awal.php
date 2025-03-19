<?php 
  include '../koneksi.php';
  if (!isset($_SESSION["idinv"])) {
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Beranda </title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Icon dan Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Tema CSS -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    
  </head>

  <body>
    <!-- Menu -->
    <div id="wrapper">

      <!-- Navigation Bar -->
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
                <form action="logout.php" onclick="return confirm('yakin ingin logout?');" method="post">
                  <button class="btn btn-default" type="submit" name="keluar">
                    <i class="fa fa-sign-out"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>

        <!-- Sidebar Menu -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li><a href="?m=awal.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?m=admin&s=awal"><i class="fa fa-user"></i> Data Super Admin</a></li>
              <li><a href="?m=petugas&s=awal"><i class="fa fa-users"></i> Data Admin Cabang</a></li>
              <li><a href="?m=operator&s=awal"><i class="fa fa-archive"></i> Data Operator</a></li>
              <li><a href="?m=statusOperator&s=awal"><i class="fa fa-check"></i> Status Operator</a></li>
              <li><a href="?m=rapot_opr&s=awal"><i class="fa fa-sticky-note"></i> Data Rapot Operator</a></li>
              <li><a href="?m=batanganUnit&s=awal"><i class="fa fa-book"></i> Data Batangan Unit</a></li>
              <li><a href="?m=biayaLain&s=awal"><i class="fa fa-money"></i> Data Biaya Lain Lain</a></li>
              <li><a href="?m=requestMutasi&s=awal"><i class="fa fa-bookmark"></i> Data Request Mutasi</a></li>
              <li><a href="logout.php" onclick="return confirm('yakin ingin logout?')"><i class="fa fa-warning"></i> Logout</a></li>
            </ul>
          </div>
        </div>

      </nav>

        <!-- Page Wrapper -->
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Selamat Datang, <?php echo $r['nama']; ?></h1>
            </div>
          </div>

          <!-- Panels for Stats -->
          <div class="row">
              <!-- Jumlah Super Admin -->
              <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                  <div class="panel panel-yellow">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-users fa-4x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <?php
                                  include_once "../koneksi.php";

                                  // Mulai session untuk mengambil data session
                                  if (session_status() === PHP_SESSION_NONE) {
                                      session_start();
                                  }

                                  // Ambil informasi jabatan pengguna yang login dari session
                                  $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                  $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                  // Cek jika yang login adalah Korcap (A)
                                  if ($jabatan_user == "Korcap") {
                                      // Query untuk menghitung jumlah data berdasarkan penempatan cabang yang sesuai dengan pengguna
                                      $sql = "SELECT count(id_admin) as jadmin FROM tb_admin WHERE cabang = '$penempatan_user'";
                                      $query = mysqli_query($koneksi, $sql);
                                      $r = mysqli_fetch_assoc($query);
                                      echo "<h3>" . $r['jadmin'] . "</h3>";
                                  } else {
                                      // Jika yang login adalah IT (B), tampilkan semua data
                                      $sql = "SELECT count(id_admin) as jadmin FROM tb_admin";
                                      $query = mysqli_query($koneksi, $sql);
                                      $r = mysqli_fetch_assoc($query);
                                      echo "<h3>" . $r['jadmin'] . "</h3>";
                                  }
                                  ?>
                                  <div>Jumlah Super Admin</div>
                              </div>
                          </div>
                      </div>
                      <a href="#">
                          <div class="panel-footer">
                              <span class="pull-left"><a href="?m=admin&s=awal">View Details</a></span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>


            <!-- Jumlah Data Operator -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-archive fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah data operator berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan semua data operator
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Data Operator</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Panel 3 -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah operator dengan status 'SP' berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'SP' AND penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh operator dengan status 'SP'
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'SP'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Operator SP</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Panel 4 -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah operator dengan status 'Mutasi' berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Mutasi' AND penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh operator dengan status 'Mutasi'
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Mutasi'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Operator Mutasi</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Operator Aktif -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah operator dengan status 'Aktif' berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Aktif' AND penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh operator dengan status 'Aktif'
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Aktif'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Operator Aktif</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Operator Non Aktif -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah operator dengan status 'Non Aktif' berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Non Aktif' AND penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh operator dengan status 'Non Aktif'
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Non Aktif'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Operator Non Aktif</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Operator Blacklist -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah operator dengan status 'Non Aktif' berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Blacklist' AND penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh operator dengan status 'Non Aktif'
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_operator WHERE status = 'Blacklist'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Operator Blacklist</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=operator&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Data Batangan -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah data batangan berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_batangan) as jbatangan FROM tb_batangan WHERE penempatan = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jbatangan'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh data batangan
                                    $sql = "SELECT count(id_batangan) as jbatangan FROM tb_batangan";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jbatangan'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Data Batangan</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=batanganUnit&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Data Biaya Lain-lain -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah data batangan berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(id_biaya) as jbiaya FROM tb_lain_lain WHERE penempatan = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jbiaya'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh data batangan
                                    $sql = "SELECT count(id_biaya) as jbiaya FROM tb_lain_lain";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jbiaya'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Data Biaya Lain-lain</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=biayaLain&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!-- Jumlah Request Data Mutasi -->
            <div class="col-lg-3 col-md-6 col-xs-12 mb-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bookmark fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                include_once "../koneksi.php";

                                // Mulai session untuk mengambil data session
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                // Ambil informasi jabatan pengguna yang login dari session
                                $jabatan_user = isset($_SESSION['jabataninv']) ? $_SESSION['jabataninv'] : ''; // Ambil jabatan dari session
                                $penempatan_user = isset($_SESSION['cabanginv']) ? $_SESSION['cabanginv'] : ''; // Ambil penempatan dari session

                                // Cek jika yang login adalah Korcap (A)
                                if ($jabatan_user == "Korcap") {
                                    // Query untuk menghitung jumlah data pengajuan mutasi berdasarkan penempatan cabang yang sesuai dengan pengguna
                                    $sql = "SELECT count(m.id_operator) as jopr 
                                            FROM tb_mutasi_operator m
                                            JOIN tb_operator o ON m.id_operator = o.id_operator
                                            WHERE o.penempatan_opr = '$penempatan_user'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                } else {
                                    // Jika yang login adalah IT (B), tampilkan jumlah seluruh data pengajuan mutasi tanpa filter penempatan
                                    $sql = "SELECT count(id_operator) as jopr FROM tb_mutasi_operator";
                                    $query = mysqli_query($koneksi, $sql);
                                    $r = mysqli_fetch_assoc($query);
                                    echo "<h3>" . $r['jopr'] . "</h3>";
                                }
                                ?>
                                <div>Jumlah Request Data Mutasi</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="?m=requestMutasi&s=awal">View Details</a></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
      </div>
    </div> <!-- End Page Wrapper -->


      <!-- Footer -->
      <footer class="text-center">
        <div class="footer-below">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <p class="text-muted" style="font-size: 16px;">Copyright&copy; <script>document.write(new Date().getFullYear());</script>Sumber Rezeki</p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div> <!-- End Wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>
