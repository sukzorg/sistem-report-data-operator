 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Data Operator</title>

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
         	$id_operator = $_GET['id_operator'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_operator WHERE id_operator = '$id_operator'";
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
            <h1 class="page-header">Edit Data Operator</h1>
          </div>
        </div>

    <div class="row">

    	<form action="?m=operator&s=update" method="POST" enctype="multipart/form-data">
      <div class="form-group">
      <input type="hidden" name="id_operator" value="<?php echo $r['id_operator'];?>" >

    </div>

        <div class ="form-group">
          <label for="exampleInputEmail1">Nama Operator</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator" value="<?php echo $r['nama_operator'];?>" aria-describedby="namalHelp" placeholder="Masukkan Nama Operator">
          <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">NIK (Nomer Induk KTP) </label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="nik" value="<?php echo $r['nik'];?>" aria-describedby="niklHelp" placeholder="Masukkan NIK (Nomer Induk KTP)">
          <small id="emailHelp" class="form-text text-muted">Masukkan NIK (Nomer Induk KTP)</small>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alamat </label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" value="<?php echo $r['alamat'];?>"aria-describedby="emailHelp" placeholder="Masukkan Alamat Lengkap">
          <small id="emailHelp" class="form-text text-muted">Masukkan Alamat</small>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">No Telphone </label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="no_telp" value="<?php echo $r['no_telp'];?>"aria-describedby="emailHelp" placeholder="Masukkan No Telphone">
          <small id="emailHelp" class="form-text text-muted">Masukkan Nomer Telphone</small>
        </div>
       
        <div class="form-group">
          <label for="exampleInputEmail1">No SIO</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="no_sio" value="<?php echo $r['no_sio'];?>" aria-describedby="niklHelp" placeholder="Masukkan no SIO">
          <small id="emailHelp" class="form-text text-muted">Masukkan no SIO</small>
        </div>

        <div class="form-group">
          <label for="exampleInputoperator">Jenis SIO</label>
          <select class="form-control" id="exampleInput" name="jenis_sio" aria-describedby="jenis_sioHelp">
            <option value="">Pilih Jenis SIO</option>
            <option value="Disnaker" <?php if($r['jenis_sio'] == "Disnaker") echo 'selected'; ?>>Disnaker</option>
            <option value="BNSP" <?php if($r['jenis_sio'] == "BNSP") echo 'selected'; ?>>BNSP</option>
            <option value="Migas" <?php if($r['jenis_sio'] == "Migas") echo 'selected'; ?>>Migas</option>
          </select>
          <small id="jenis_sioHelp" class="form-text text-muted">Pilih Jenis SIO </small>
        </div>
        
        <div class="form-group">
            <label for="exampleInputoperator">Operator</label>
            <select class="form-control" id="exampleInput" name="operator" aria-describedby="operatorHelp">
                <option value="">Pilih Operator</option>
                <option value="Forklift" <?php if($r['operator'] == "Forklift") echo 'selected'; ?>>Forklift</option>
                <option value="Crawler Crane" <?php if($r['operator'] == "Crawler Crane") echo 'selected'; ?>>Crawler Crane</option>
                <option value="Mobil Crane" <?php if($r['operator'] == "Mobil Crane") echo 'selected'; ?>>Mobil Crane</option>
                <option value="Roughter Crane" <?php if($r['operator'] == "Roughter Crane") echo 'selected'; ?>>Roughter Crane</option>
                <option value="TMC (Truck Mounted Crane)" <?php if($r['operator'] == "TMC (Truck Mounted Crane)") echo 'selected'; ?>>TMC (Truck Mounted Crane)</option>
                <option value="Menlift" <?php if($r['operator'] == "Menlift") echo 'selected'; ?>>Menlift</option>
                <option value="Excavator" <?php if($r['operator'] == "Excavator") echo 'selected'; ?>>Excavator</option>
                <option value="Spider" <?php if($r['operator'] == "Spider") echo 'selected'; ?>>Spider Crane</option>
                <option value="Vibro" <?php if($r['operator'] == "Vibro") echo 'selected'; ?>>Vibro</option>
            </select>
            <small id="operatornHelp" class="form-text text-muted">Pilih Jenis Operator</small>
        </div>

        <div class="form-group">
          <label for="exampleInputoperator">Kelas Operator</label>
          <select class="form-control" id="exampleInput" name="kelas_operator" aria-describedby="kelas_operatorHelp">
            <option value="">Pilih Kelas</option>
            <option value="Kelas 1" <?php if($r['kelas_operator'] == "Kelas 1") echo 'selected'; ?>>Kelas 1</option>
            <option value="Kelas 2" <?php if($r['kelas_operator'] == "Kelas 2") echo 'selected'; ?>>Kelas 2</option>
            <option value="Kelas 3" <?php if($r['kelas_operator'] == "Kelas 3") echo 'selected'; ?>>Kelas 3</option>
          </select>
          <small id="kelas_operatornHelp" class="form-text text-muted">Pilih Jenis Kelas Operator</small>
        </div>
         
        <div class="form-photo-container">
                <!-- Foto KTP -->
                <div class="form-photo-item">
                    <label for="foto_ktp">Foto KTP</label>
                    <img src="../images/foto_ktp/<?php echo $r['foto_ktp'];?>" height="150"><br>
                    <input type="file" name="foto_ktp" placeholder="Masukkan Foto" id="foto_ktp">
                </div>

                <!-- Foto SIO -->
                <div class="form-photo-item">
                    <label for="foto_sio">Foto SIO</label>
                    <img src="../images/foto_sio/<?php echo $r['foto_sio'];?>" height="150"><br>
                    <input type="file" name="foto_sio" placeholder="Masukkan Foto" id="foto_sio">
                </div>

                <!-- Foto SIM -->
                <div class="form-photo-item">
                    <label for="foto_sio">Foto SIM</label>
                    <img src="../images/foto_sim/<?php echo $r['foto_sim'];?>" height="150"><br>
                    <input type="file" name="foto_sim" placeholder="Masukkan Foto" id="foto_sim">
                </div>

                <!-- Foto Sertifikat Depan -->
                <div class="form-photo-item">
                    <label for="foto_sertifikat_dpn">Foto Sertifikat Depan</label>

                    <img src="../images/sertifikat/<?php echo $r['foto_sertifikat_dpn'];?>" height="150"><br>
                    <input type="file" name="foto_sertifikat_dpn" placeholder="Masukkan Foto" id="foto_sertifikat_dpn">
                </div>

                <!-- Foto Sertifikat Belakang -->
                <div class="form-photo-item">
                    <label for="foto_sertifikat_blk">Foto Sertifikat Belakang</label>
                    <img src="../images/sertifikat/<?php echo $r['foto_sertifikat_blk'];?>" height="150"><br>
                    <input type="file" name="foto_sertifikat_blk" placeholder="Masukkan Foto" id="foto_sertifikat_blk">
                </div>

                <!-- Foto Sertifikat Belakang -->
                <div class="form-photo-item">
                    <label for="foto_operator">Foto Operator</label>
                    <img src="../images/foto_operator/<?php echo $r['foto_operator'];?>" height="150"><br>
                    <input type="file" name="foto_operator" placeholder="Masukkan Foto" id="foto_operator">
                </div>

            </div>

          <div class="form-group">
              <label for="exampleInputpenempatan">Penempatan Cabang</label>
              <select class="form-control" id="exampleInput" name="penempatan_opr" aria-describedby="penempatanHelp">
                  <option value="">Pilih Cabang</option>
                  <option value="Jakarta" <?php if($r['penempatan_opr'] == "Jakarta") echo 'selected'; ?>>Jakarta</option>
                  <option value="Tangerang" <?php if($r['penempatan_opr'] == "Tangerang") echo 'selected'; ?>>Tangerang</option>
                  <option value="Cikarang" <?php if($r['penempatan_opr'] == "Cikarang") echo 'selected'; ?>>Cikarang</option>
                  <option value="Palembang" <?php if($r['penempatan_opr'] == "Palembang") echo 'selected'; ?>>Palembang</option>
                  <option value="Semarang" <?php if($r['penempatan_opr'] == "Semarang") echo 'selected'; ?>>Semarang</option>
                  <option value="Balikpapan" <?php if($r['penempatan_opr'] == "Balikpapan") echo 'selected'; ?>>Balikpapan</option>
              </select>
              <small id="penempatannHelp" class="form-text text-muted">Pilih penempatan</small>
          </div>

          <div class="form-group">
              <label for="exampleInputDate">Tanggal</label>
              <input type="date" class="form-control" id="exampleInputDate" name="tgl_masuk" aria-describedby="dateHelp" 
                    value="<?php echo isset($r['tgl_masuk']) ? $r['tgl_masuk'] : ''; ?>" placeholder="Pilih tanggal">
              <small id="dateHelp" class="form-text text-muted">Pilih tanggal yang sesuai</small>
          </div>


          <div class="form-group">
              <label for="exampleInputstatus">Status</label>
              <select class="form-control" id="exampleInput" name="status" aria-describedby="statusHelp" disabled>
                  <option value="">Pilih Status</option>
                  <option value="Aktif" <?php if($r['status'] == "Aktif") echo 'selected'; ?>>Aktif</option>
                  <option value="Non Aktif" <?php if($r['status'] == "Non Aktif") echo 'selected'; ?>>Non Aktif</option>
                  <option value="SP" <?php if($r['status'] == "SP") echo 'selected'; ?>>SP</option>
                  <option value="Mutasi" <?php if($r['status'] == "Mutasi") echo 'selected'; ?>>Mutasi</option>
                  <option value="Blacklist" <?php if($r['status'] == "Blacklist") echo 'selected'; ?>>Blacklist</option>
                  <option value="Skorsing" <?php if($r['status'] == "Skorsing") echo 'selected'; ?>>Skorsing</option>
              </select>
              <small id="statusHelp" class="form-text text-muted">Pilih status</small>
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
