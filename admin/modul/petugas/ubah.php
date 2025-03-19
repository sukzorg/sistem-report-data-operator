 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Data Barang</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">    

    <!-- boootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

     <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- icon dan fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- tema css -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">

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
         	$id = $_GET['id_petugas'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);

           ?>
          <ul class="nav navbar-top-links navbar-right">
            
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
            <h1 class="page-header">Edit Data Admin Cabang</h1>
          </div>
        </div>

    <div class="row">

    	<form action="?m=petugas&s=update" method="POST" enctype="multipart/form-data">
    		<input type="hidden" value="<?php echo$r['id_petugas'];?>" name="id_petugas">
        <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?php echo $r['username']; ?>" aria-describedby="emailHelp" placeholder="Masukkan Username">
  
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control" id="exampleInputEmail1"  name="password" aria-describedby="emailHelp" placeholder="Masukkan Password">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" value="<?php echo $r['nama']; ?>" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Telepon</label>
    <input type="text" class="form-control" value="<?php echo $r['telepon']; ?>" id="exampleInputEmail1" name="telepon" aria-describedby="emailHelp" placeholder="Masukkan Nomor Telepon">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
              <label for="exampleInputpenempatan">Penempatan Cabang</label>
              <select class="form-control" id="exampleInput" name="cabang" aria-describedby="cabangHelp">
                  <option value="">Pilih Cabang</option>
                  <option value="Jakarta" <?php if($r['cabang'] == "Jakarta") echo 'selected'; ?>>Jakarta</option>
                  <option value="Tangerang" <?php if($r['cabang'] == "Tangerang") echo 'selected'; ?>>Tangerang</option>
                  <option value="Cikarang" <?php if($r['cabang'] == "Cikarang") echo 'selected'; ?>>Cikarang</option>
                  <option value="Palembang" <?php if($r['cabang'] == "Palembang") echo 'selected'; ?>>Palembang</option>
                  <option value="Semarang" <?php if($r['cabang'] == "Semarang") echo 'selected'; ?>>Semarang</option>
                  <option value="Balikpapan" <?php if($r['cabang'] == "Balikpapan") echo 'selected'; ?>>Balikpapan</option>
              </select>
   </div>


</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    	
    </div>

        


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

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!--include-->
    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>
