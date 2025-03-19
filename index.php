<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="icon" href="images/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Styles -->
    <link href="css/tampilan.css" rel="stylesheet">
    <link href="css/custom-style.css" rel="stylesheet">

    <title>Bank Data Operator</title>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

    <!-- Menu -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="sr-only">navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">Sistem Report Data Operator</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class="page-scroll"><a href="index.php">Beranda</a></li>
                    <li class="page-scroll"><a href="#tentang">Tentang Kami</a></li>
                    <li class="page-scroll dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person">Login</i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="admin/login.php" target="_blank">Login sebagai Admin</a></li>
                            <li><a href="petugas/login_petugas.php" target="_blank">Login sebagai Petugas</a></li>
                        </ul>
                    </li>
                    <li class="page-scroll"><a href="#"><i class="bi bi-list"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Carousel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img class="first-slide" src="images/Dashboard_image.jpg" alt="First slide">
            </div>
            <div class="item">
                <img class="second-slide" src="images/Dashboard_image2.jpg" alt="Second slide">
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Tentang Section -->
    <section id="tentang" class="section-margin">
        <div class="row content">
            <div class="col-lg-12 text-center">
                <div class="jumbotron">
                    <h1> Tentang Aplikasi Sistem Report Data Operator</h1><br>
                    <p>Aplikasi Sistem Report Data Operator adalah sebuah sistem yang dirancang untuk membantu dalam proses pendataan karyawan operator dalam mengelola dan mencatat data operator. Aplikasi ini dikelola didalam suatu database agar pengelolaan data karyawan lebih efektif dan efisien.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer container-fluid">
        <div class="text-center">
            <hr class="medium" style="border-top: 1px solid #ddd; width: 80%; margin: 20px auto;">
            <p class="text-muted" style="font-size: 16px;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Sumber Rezeki All rights reserved</p>
        </div>
    </footer>

    <!-- jQuery and Bootstrap JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/css/js/bootstrap.min.js"></script>
</body>
</html>
