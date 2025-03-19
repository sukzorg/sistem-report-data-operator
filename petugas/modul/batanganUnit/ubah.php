 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Batangan Unit Operator</title>

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
         	$id_batangan = $_GET['id_batangan'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_batangan WHERE id_batangan = '$id_batangan'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);

           ?>
          <ul class="nav navbar-top-links navbar-right">
            
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
            <h1 class="page-header">Edit Batangan Unit Operator</h1>
          </div>
        </div>

        <div class="row">

        <form action="?m=batanganUnit&s=update" method="POST" enctype="multipart/form-data">
          <div class="form-group">
          <input type="hidden" name="id_batangan" value="<?php echo $r['id_batangan'];?>" >

        </div>

        <div class ="form-group">
          <label for="exampleInputEmail1">Nama Operator</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator" value="<?php echo $r['nama_operator'];?>" aria-describedby="nama_operatorlHelp" placeholder="Masukkan Nama Operator">
          <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
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
              <small id="penempatannHelp" class="form-text text-muted">Pilih penempatan</small>
          </div>
        
        <div class="form-group">
            <label for="exampleInputoperator">Jenis Unit</label>
            <select class="form-control" id="exampleInput" name="jenis_unit" aria-describedby="jenis_unitHelp">
                <option value="">Pilih Operator</option>
                <option value="Forklift" <?php if($r['jenis_unit'] == "Forklift") echo 'selected'; ?>>Forklift</option>
                <option value="Crawler Crane" <?php if($r['jenis_unit'] == "Crawler Crane") echo 'selected'; ?>>Crawler Crane</option>
                <option value="Mobil Crane" <?php if($r['jenis_unit'] == "Mobil Crane") echo 'selected'; ?>>Mobil Crane</option>
                <option value="Roughter Crane" <?php if($r['jenis_unit'] == "Roughter Crane") echo 'selected'; ?>>Roughter Crane</option>
                <option value="TMC (Truck Mounted Crane)" <?php if($r['jenis_unit'] == "TMC (Truck Mounted Crane)") echo 'selected'; ?>>TMC (Truck Mounted Crane)</option>
                <option value="Menlift" <?php if($r['jenis_unit'] == "Menlift") echo 'selected'; ?>>Menlift</option>
                <option value="Excavator" <?php if($r['jenis_unit'] == "Excavator") echo 'selected'; ?>>Excavator</option>
                <option value="Spider" <?php if($r['jenis_unit'] == "Spider") echo 'selected'; ?>>Spider Crane</option>
                <option value="Vibro" <?php if($r['jenis_unit'] == "Vibro") echo 'selected'; ?>>Vibro</option>
            </select>
            <small id="jenis_unitHelp" class="form-text text-muted">Pilih Jenis Unit</small>
        </div>

          <div class="form-group">
            <label for="exampleInputmerek_unit">Merek Unit</label>
            <select class="form-control" id="exampleInput" name="merek_unit" aria-describedby="merek_unitHelp">
              <option value="">Pilih Merek Unit</option>
              <option value="Sany" <?php if($r['merek_unit'] == "Sany") echo 'selected'; ?>>Sany</option>
              <option value="Kato" <?php if($r['merek_unit'] == "Kato") echo 'selected'; ?>>Kato</option>
              <option value="Tadano" <?php if($r['merek_unit'] == "Tadano") echo 'selected'; ?>>Tadano</option>
              <option value="Kobelco" <?php if($r['merek_unit'] == "Kobelco") echo 'selected'; ?>>Kobelco</option>
              <option value="Hyundai" <?php if($r['merek_unit'] == "Hyundai") echo 'selected'; ?>>Hyundai</option>
              <option value="TCM" <?php if($r['merek_unit'] == "TMC") echo 'selected'; ?>>TCM</option>
              <option value="Cutter Pillar" <?php if($r['merek_unit'] == "Cutter Pillar") echo 'selected'; ?>>Cutter Pillar</option>
              <option value="Doosan" <?php if($r['merek_unit'] == "Doosan") echo 'selected'; ?>>Doosan</option>
              <option value="IHI" <?php if($r['merek_unit'] == "IHI") echo 'selected'; ?>>IHI</option>
              <option value="Zoomlion" <?php if($r['merek_unit'] == "Zoomlion") echo 'selected'; ?>>Zoomlion</option>
              <option value="Genie" <?php if($r['merek_unit'] == "Genie") echo 'selected'; ?>>Genie</option>
              <option value="JLG" <?php if($r['merek_unit'] == "JLG") echo 'selected'; ?>>JLG</option>
            </select>
            <small id="merek_unitnHelp" class="form-text text-muted">Pilih Merek Unit</small>
          </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Tonase</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="tonase" value="<?php echo $r['tonase'];?>" aria-describedby="emailHelp" placeholder="Masukkan Tonase">
          <small id="emailHelp" class="form-text text-muted">Masukkan Tonase</small>
        </div>
        
        <div class="form-group">
          <label for="exampleInputDate">No Unit</label>
          <input type="text" class="form-control" id="exampleInputDate" name="no_unit" value="<?php echo $r['no_unit'];?>" aria-describedby="no_unitHelp" placeholder="Masukkan No Unit">
          <small id="dateHelp" class="form-text text-muted">Masukan No Unit</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nama Helper </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="nama_helper" value="<?php echo $r['nama_helper'];?>" aria-describedby="nama_helperHelp" placeholder="Masukkan Nama Helper">
            <small id="emailHelp" class="form-text text-muted">Masukkan Nama Helper</small>
        </div>

         <!-- Foto Kejadian -->
        <div class="form-photo-item">
            <label for="foto_operator">Foto MOU</label>
            <hr>
            <img src="../images/foto_mou/<?php echo $r['foto_mou'];?>" height="150"><br>
            <input type="file" name="foto_mou" placeholder="Masukkan Foto" id="foto_kejadian">
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
