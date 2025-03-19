 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php  echo $judul; ?></title>

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
            <h1 class="page-header">Data Operator</h1>
          </div>
        </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Tambah data
</button>

<!-- Print All -->
<a href="?m=operator&s=export_pdf&print=all" class="btn btn-success">
  <i class="fa fa-print"></i> Print All
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Opertator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?m=operator&s=simpan" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Nama Operator</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator" maxlength="20" aria-describedby="emailHelp" placeholder="Masukkan Nama Operator">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">NIK (Nomer Induk KTP) </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nik" aria-describedby="emailHelp" placeholder="Masukkan NIK (Nomer Induk KTP)">
    <small id="emailHelp" class="form-text text-muted">Masukkan NIK (Nomer Induk KTP)</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Alamat </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" aria-describedby="emailHelp" placeholder="Masukkan Alamat Lengkap">
    <small id="emailHelp" class="form-text text-muted">Masukkan Alamat</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">No Telphone </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="no_telp" aria-describedby="emailHelp" placeholder="Masukkan No Telphone">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nomer Telphone</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">No SIO </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="no_sio" aria-describedby="emailHelp" placeholder="Masukkan No SIO">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nomer SIO</small>
  </div>
  <div class="form-group">
    <label for="exampleInputoperator">Jenis SIO</label>
    <select class="form-control" id="exampleInput" name="jenis_sio" aria-describedby="jenis_sioHelp">
    <option value="">Pilih Jenis SIO</option>
      <option value="Disnaker">Disnaker</option>
      <option value="BNSP">BNSP</option>
      <option value="Migas">Migas</option>
    </select>
    <small id="jenis_sioHelp" class="form-text text-muted">Pilih Jenis SIO </small>
  </div>
  <div class="form-group">
    <label for="exampleInputoperator">Operator</label>
    <select class="form-control" id="exampleInput" name="operator" aria-describedby="operatorHelp">
    <option value="">Pilih Operator</option>
      <option value="Forklift">Forklift</option>
      <option value="Crawler Crane">Crawler Crane</option>
      <option value="Mobil Crane">Mobil Crane</option>
      <option value="Roughter Crane">Roughter Crane</option>
      <option value="TMC (Truck Mounted Crane)">TMC (Truck Mounted Crane)</option>
      <option value="Menlift">Manlift</option>
      <option value="Exavator">Excavator</option>
      <option value="Spider">Spider Crane</option>
      <option value="Vibro">Vibro</option>
    </select>
    <small id="operatornHelp" class="form-text text-muted">Pilih Jenis Operator</small>
  </div>
  <div class="form-group">
    <label for="exampleInputoperator">Kelas Operator</label>
    <select class="form-control" id="exampleInput" name="kelas_operator" aria-describedby="kelas_operatorHelp">
    <option value="">Pilih Kelas</option>
      <option value="Kelas 1">Kelas 1</option>
      <option value="Kelas 2">Kelas 2</option>
      <option value="Kelas 2">Kelas 3</option>
    </select>
    <small id="kelas_operatornHelp" class="form-text text-muted">Pilih Jenis Kelas Operator</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto KTP </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_ktp" aria-describedby="emailHelp" placeholder="Masukkan Foto KTP">
    <small id="emailHelp" class="form-text text-muted">Masukkan Foto KTP</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto SIO </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_sio" aria-describedby="emailHelp" placeholder="Masukkan Foto SIO">
    <small id="emailHelp" class="form-text text-muted">Masukkan Foto SIO</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto SIM </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_sim" aria-describedby="emailHelp" placeholder="Masukkan Foto SIM">
    <small id="emailHelp" class="form-text text-muted">Masukkan Foto SIM</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto Sertifikat Depan </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_sertifikat_dpn" aria-describedby="emailHelp" placeholder="Masukkan Foto Sertifikat Depan">
    <small id="emailHelp" class="form-text text-muted">Masukkan Sertifikat Depan</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto Sertifikat Belakang </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_sertifikat_blk" aria-describedby="emailHelp" placeholder="Masukkan Foto Sertifikat Belakang">
    <small id="emailHelp" class="form-text text-muted">Masukkan Sertifikat Belakang</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Foto Operator </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_operator" aria-describedby="emailHelp" placeholder="Masukkan Foto Operator">
    <small id="emailHelp" class="form-text text-muted">Masukkan Foto Operator</small>
  </div>
  <div class="form-group">
  <label for="exampleInputpenempatan_opr">Penempatan Cabang</label>
  <select class="form-control" id="exampleInput" name="penempatan_opr" aria-describedby="penempatan_oprHelp">
    <option value="">Pilih Cabang</option>
    <option value="Jakarta">Jakarta</option>
    <option value="Tangerang">Tangerang</option>
    <option value="Cikarang">Cikarang</option>
    <option value="Palembang">Palembang</option>
    <option value="Semarang">Semarang</option>
    <option value="Balikpapan">Balikpapan</option>
  </select>
  <small id="penempatan_oprHelp" class="form-text text-muted">Pilih penempatan</small>
</div>
  <div class="form-group">
  <label for="exampleInputDate">Tanggal</label>
  <input type="date" class="form-control" id="exampleInputDate" name="tgl_masuk" aria-describedby="dateHelp" placeholder="Pilih tanggal">
  <small id="dateHelp" class="form-text text-muted">Pilih tanggal yang sesuai</small>
</div>
<div class="form-group">
  <label for="exampleInputstatus">Status</label>
  <select class="form-control" id="exampleInput" name="status" aria-describedby="statusHelp">
    <option value="">Pilih Status</option>
    <option value="Aktif">Aktif</option>
    <option value="Non Aktif">Non Aktif</option>
    <option value="SP">SP</option>
    <option value="Mutasi">Mutasi</option>
    <option value="Blacklist">Blacklist</option>
    <option value="Skorsing">Skorsing</option>
  </select>
  <small id="statusnHelp" class="form-text text-muted">Pilih status</small>
</div>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

<div class="row">
  <center>
    <form action="" method="POST">
    <label>Cari Operator</label>
    <input type="text" name="cari"> <button type="submit" name="go" class="btn btn-success">Cari</button>
  </form>
</center>
</div>
                              <div class="row">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                
                                 <th>No</th>
                                 <th>Nama Operator</th>
                                 <th>Nik</th>
                                 <th>Alamat</th>
                                 <th>No Telp</th>
                                 <th>No SIO</th>
                                 <th>Jenis SIO</th>
                                 <th>Operator</th>
                                 <th>Kelas Operator</th>
                                 <th>Foto KTP</th>
                                 <th>Foto SIO</th>
                                 <th>Foto SIM</th>
                                 <th>Foto Sertifikat Depan</th>
                                 <th>Foto Sertifikat Belakang</th>
                                 <th>Foto Operator</th>
                                 <th>Penempatan Cabang</th>
                                 <th>Tgl Masuk</th>
                                 <th>Report Operator</th>
                                 <th>Status</th>
                                 <th>Details</th>
                                 <th>Aksi</th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           <?php 
                                          
                                            include 'paging.php';

                                            ?>
                                        </tbody>
                                    </table>
               <center>
              <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if($halaman > 1){ echo "href='?m=operator&s=awal&halaman=$previous'"; } ?>>Previous</a>
                    </li>
                        <?php 
                        for($x=1;$x<=$total_halaman;$x++){
                            ?> 
                            <li class="page-item"><a class="page-link" href="?m=operator&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                        <?php
                    }
                    ?>              
                    <li class="page-item">
                        <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=operator&s=awal&halaman=$next'"; } ?>>Next</a>
                    </li>
            </ul>
              </center> 
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
