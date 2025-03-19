 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pengajuan Mutasi Operator</title>

    <!-- Favicon -->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- boootstrap -->
    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

     <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- icon dan fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- tema css -->
    <link href="../css/tampilanadmin.css" rel="stylesheet">
    <link href="../css/mutasi.css" rel="stylesheet">
    

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
            <h1 class="page-header">Pengajuan Mutasi Operator</h1>
        </div>
    </div>

    <div class="row">
        <form action="?m=mutasi&s=update_approved" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="id_operator" value="<?php echo $r['id_operator']; ?>">
            </div>

            <div class="container">
                <!-- Form Ajukan Mutasi -->
                <div class="form-container">
                    <h2>Form Ajukan Mutasi</h2>
                    
                    <!-- Form Group Nama Operator -->
                    <div class="form-group">
                        <label for="nama_operator">Nama Operator</label>
                        <input type="text" class="form-control" id="nama_operator" name="nama_operator" value="<?php echo $r['nama_operator'];?>" placeholder="Masukkan Nama Operator" required>
                        <small id="namaHelp" class="form-text text-muted">Masukkan Nama Operator</small>
                    </div>

                    <!-- Form Group Penempatan Operator Baru -->
                    <div class="form-group">
                        <label for="penempatan_opr_baru">Penempatan Operator Baru</label>
                        <select class="form-control" id="penempatan_opr_baru" name="penempatan_opr_baru" required>
                            <option value="">Pilih Cabang</option>
                            <option value="Jakarta" <?php if($r['penempatan_opr'] == "Jakarta") echo 'selected'; ?>>Jakarta</option>
                            <option value="Tangerang" <?php if($r['penempatan_opr'] == "Tangerang") echo 'selected'; ?>>Tangerang</option>
                            <option value="Cikarang" <?php if($r['penempatan_opr'] == "Cikarang") echo 'selected'; ?>>Cikarang</option>
                            <option value="Palembang" <?php if($r['penempatan_opr'] == "Palembang") echo 'selected'; ?>>Palembang</option>
                            <option value="Semarang" <?php if($r['penempatan_opr'] == "Semarang") echo 'selected'; ?>>Semarang</option>
                            <option value="Balikpapan" <?php if($r['penempatan_opr'] == "Balikpapan") echo 'selected'; ?>>Balikpapan</option>
                        </select>
                    </div>

                    <!-- Form Group Status Operator Baru -->
                    <div class="form-group">
                        <label for="status_opr_baru">Status Operator Baru</label>
                        <select class="form-control" id="status_opr_baru" name="status_opr_baru" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" <?php if($r['status'] == "Aktif") echo 'selected'; ?>>Aktif</option>
                            <option value="Non Aktif" <?php if($r['status'] == "Non Aktif") echo 'selected'; ?>>Non Aktif</option>
                            <option value="SP" <?php if($r['status'] == "SP") echo 'selected'; ?>>SP</option>
                            <option value="Mutasi" <?php if($r['status'] == "Mutasi") echo 'selected'; ?>>Mutasi</option>
                            <option value="Blacklist" <?php if($r['status'] == "Blacklist") echo 'selected'; ?>>Blacklist</option>
                            <option value="Skorsing" <?php if($r['status'] == "Skorsing") echo 'selected'; ?>>Skorsing</option>
                        </select>
                    </div>

                    <!-- Form Group Status Approval -->
                    <div class="form-group">
                        <label for="status_approval">Status Approval</label>
                        <select class="form-control" id="status_approval" name="status_approval" required>
                            <option value="">Pilih Status Approval</option>
                            <option value="Ajukan Mutasi">Ajukan Mutasi</option>
                        </select>
                    </div>

                    <!-- Form Group Tanggal Pengajuan -->
                    <div class="form-group">
                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" name="simpan" class="btn-submit">Ajukan Mutasi</button>
                </div>

                <!-- Profile Detail -->
                <div class="profile-container">
                    <h2>Detail Profil</h2>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $r['nama_operator']; ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?php echo $r['nik']; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?php echo $r['alamat']; ?></td>
                        </tr>
                        <tr>
                            <th>No. Telp</th>
                            <td><?php echo $r['no_telp']; ?></td>
                        </tr>
                        <tr>
                            <th>No. SIO</th>
                            <td><?php echo $r['no_sio']; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis SIO</th>
                            <td><?php echo $r['jenis_sio']; ?></td>
                        </tr>
                        <tr>
                            <th>Operator</th>
                            <td><?php echo $r['operator']; ?></td>
                        </tr>
                        <tr>
                            <th>Kelas Operator</th>
                            <td><?php echo $r['kelas_operator']; ?></td>
                        </tr>
                        <tr>
                            <th>Penempatan Operator</th>
                            <td><?php echo $r['penempatan_opr']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td><?php echo $r['tgl_masuk']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
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

    <!--include-->
    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>

