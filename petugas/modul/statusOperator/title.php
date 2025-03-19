<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Status Operator</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    <link href="../css/style-status.css" rel="stylesheet">
    
</head>
<body>
<div id="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand">Sistem Report Data Operator</a>
        </div>

        <!-- Ambil data admin untuk navbar -->
        <?php 
        include '../koneksi.php';
        $id = $_SESSION['idinv2'];
        $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
        $query = mysqli_query($koneksi, $sql);
        $r = mysqli_fetch_array($query);
        ?>

        <!-- Navbar kanan -->
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

    <!-- Konten Utama -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Status Operator</h1>
            </div>
        </div>

        <div class="row">
            <center>
                <form action="" method="POST">
                    <label>Cari Status Operator</label>
                    <input type="text" name="cari" placeholder="">
                    <button type="submit" name="go" class="btn btn-success">Cari Status</button>
                </form>
            </center>
        </div>

        <hr>

        <div class="row">
            <?php include 'paging.php'; ?>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-muted" style="font-size: 16px;">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        Sumber Rezeki
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/css/js/bootstrap.min.js"></script>
</body>
</html>
