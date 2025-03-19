<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pengajuan Mutasi Operator</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Icon dan Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Tema CSS -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    <link href="../css/cekmutasi.css" rel="stylesheet">
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
            include '../koneksi.php';
            ?>

            <ul class="nav navbar-top-links navbar-right">
                <!-- Menu kanan jika diperlukan -->
            </ul>

            <!-- Menu Samping -->
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
                        <li><a href="logout.php" onclick="return confirm('Yakin ingin logout?')"><i class="fa fa-warning"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengajuan Mutasi Operator</h1>
                </div>
            </div>

            <div class="row">
                <!-- Profile Card -->
                <div class="profile-container">
                    <h2>Detail Profil</h2>
                    <table>
                        <!-- Menampilkan header tabel (th) yang berfungsi sebagai label -->
                        <thead>
                            <tr>
                                <th>Nama Operator</th>
                                <th>Penempatan Operator Baru</th>
                                <th>Status Operator Baru</th>
                                <th>Status Approval</th>
                                <th>Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'paging_approved.php'; ?> <!-- Menyertakan file paging untuk menampilkan data operator -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.history.back()">Close</button>
            </div>
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

