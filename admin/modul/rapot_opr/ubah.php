 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Rapot Operator</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- boootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

     <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- icon dan fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- tema css -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    <link href="../css/ubah.css" rel="stylesheet">
    

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
         	$id_laporan = $_GET['id_laporan'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_laporan WHERE id_laporan = '$id_laporan'";
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
            <h1 class="page-header">Edit Rapot Operator</h1>
          </div>
        </div>

        <div class="row">

        <form action="?m=rapot_opr&s=update" method="POST" enctype="multipart/form-data">
          <div class="form-group">
          <input type="hidden" name="id_laporan" value="<?php echo $r['id_laporan'];?>" >

        </div>

        <div class ="form-group">
          <label for="exampleInputEmail1">Nama Operator</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator_report" value="<?php echo $r['nama_operator_report'];?>" aria-describedby="nama_operator_reportlHelp" placeholder="Masukkan Nama Operator">
          <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">No Sio </label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="no_sio_opr" value="<?php echo $r['no_sio_opr'];?>" aria-describedby="no_sio_oprlHelp" placeholder="Masukan Nomer Sio">
          <small id="emailHelp" class="form-text text-muted">Masukkan No Sio</small>
        </div>

        <div class="form-group">
              <label for="exampleInputpenempatan">Penempatan Cabang</label>
              <select class="form-control" id="exampleInput" name="penempatan" aria-describedby="penempatanHelp">
                  <option value="">Pilih Cabang</option>
                  <option value="Jakarta" <?php if($r['penempatan'] == "Jakarta") echo 'selected'; ?>>Jakarta</option>
                  <option value="Tangerang" <?php if($r['penempatan'] == "Tangerang") echo 'selected'; ?>>Tangerang</option>
                  <option value="Cikarang" <?php if($r['penempatan'] == "Cikarang") echo 'selected'; ?>>Cikarang</option>
                  <option value="Palembang" <?php if($r['penempatan'] == "Palembang") echo 'selected'; ?>>Palembang</option>
                  <option value="Semarang" <?php if($r['penempatan'] == "Semarang") echo 'selected'; ?>>Semarang</option>
                  <option value="Balikpapan" <?php if($r['penempatan'] == "Balikpapan") echo 'selected'; ?>>Balikpapan</option>
              </select>
              <small id="penempatanHelp" class="form-text text-muted">Pilih penempatan</small>
          </div>

        <div class="form-group">
              <label for="exampleInputDate">Tanggal Kejadian</label>
              <input type="date" class="form-control" id="exampleInputDate" name="tgl_kejadian" aria-describedby="dateHelp" 
                    value="<?php echo isset($r['tgl_kejadian']) ? $r['tgl_kejadian'] : ''; ?>" placeholder="Pilih tanggal">
              <small id="dateHelp" class="form-text text-muted">Pilih tanggal yang sesuai</small>
          </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Kejadian</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="kejadian" value="<?php echo $r['kejadian'];?>" aria-describedby="kejadianlHelp" placeholder="Masukan Kejadian">
          <small id="emailHelp" class="form-text text-muted">Masukan Kejadian</small>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Note</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="note" value="<?php echo $r['note'];?>" aria-describedby="notelHelp" placeholder="Masukan Note">
          <small id="emailHelp" class="form-text text-muted">Masukan Note</small>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">No Berita Acara</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="no_berita_acara" value="<?php echo $r['no_berita_acara'];?>" aria-describedby="notelHelp" placeholder="Masukan No Berita Acara">
          <small id="emailHelp" class="form-text text-muted">Masukan No Berita Acara</small>
        </div>

         <!-- Foto Kejadian -->
        <div class="form-photo-item">
            <label for="foto_operator">Foto Kejadian</label>
            <hr>
            <img src="../images/foto_kejadian/<?php echo $r['foto_kejadian'];?>" height="150"><br>
            <input type="file" name="foto_kejadian" placeholder="Masukkan Foto" id="foto_kejadian">
            <small class="form-text text-muted">Masukkan Foto</small>
        </div>

          <!-- Action -->
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
            <p class="text-muted" style="font-size: 16px;">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Sumber Rezeki</p>
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
