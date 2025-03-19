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
</div>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Data Biaya Lain Lain</h1>
          </div>
        </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Tambah data
</button>

<!-- Print All -->
<a href="?m=biayaLain&s=export_pdf&print=all" class="btn btn-success">
  <i class="fa fa-print"></i> Print All
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Biaya Lain Lain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="?m=biayaLain&s=simpan" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputEmail1">Nama Operator</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator" maxlength="20" aria-describedby="emailHelp" placeholder="Masukkan Nama Operator">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
  </div>

  <div class="form-group">
  <label for="exampleInputpenempatan">Penempatan Cabang</label>
  <select class="form-control" id="exampleInput" name="penempatan" aria-describedby="penempatanHelp">
    <option value="">Pilih Cabang</option>
    <option value="Jakarta">Jakarta</option>
    <option value="Tangerang">Tangerang</option>
    <option value="Cikarang">Cikarang</option>
    <option value="Palembang">Palembang</option>
    <option value="Semarang">Semarang</option>
    <option value="Balikpapan">Balikpapan</option>
  </select>
  <small id="penempatannHelp" class="form-text text-muted">Pilih penempatan</small>
  </div>
  

  <div class="form-group">
    <label for="exampleInputjenis_unit">Jenis Unit</label>
    <select class="form-control" id="exampleInput" name="jenis_unit" aria-describedby="jenis_unitHelp">
      <option value="">Pilih Jenis Unit</option>
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
    <small id="jenis_unitnHelp" class="form-text text-muted">Pilih Jenis Unit</small>
  </div>

  <div class="form-group">
    <label for="exampleInputmerek_unit">Merek Unit</label>
    <select class="form-control" id="exampleInput" name="merek_unit" aria-describedby="merek_unitHelp">
      <option value="">Pilih Merek Unit</option>
      <option value="Sany">Sany</option>
      <option value="Kato">Kato</option>
      <option value="Tadano">Tadano</option>
      <option value="Kobelco">Kobelco</option>
      <option value="Hyundai">Hyundai</option>
      <option value="TCM">TCM</option>
      <option value="Cutter Pillar">Cutter Pillar</option>
      <option value="Doosan">Doosan</option>
      <option value="IHI">IHI</option>
      <option value="Zoomlion">Zoomlion</option>
      <option value="Genie">Genie</option>
      <option value="JLG">JLG</option>
      <option value="Lain Lain">Lain lain</option>
    </select>
    <small id="merek_unitnHelp" class="form-text text-muted">Pilih Merek Unit</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Tonase</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="tonase" aria-describedby="emailHelp" placeholder="Masukkan Tonase">
    <small id="emailHelp" class="form-text text-muted">Masukkan Tonase</small>
  </div>

  <div class="form-group">
    <label for="exampleInputDate">No Unit</label>
    <input type="text" class="form-control" id="exampleInputDate" name="no_unit" aria-describedby="no_unitHelp" placeholder="Masukkan No Unit">
    <small id="dateHelp" class="form-text text-muted">Masukan No Unit</small>
  </div>


  <div class="form-group">
    <label for="exampleInputketerangan_biaya">keterangan biaya</label>
    <select class="form-control" id="exampleInput" name="keterangan_biaya" aria-describedby="keterangan_biayaHelp">
      <option value="">Pilih Keterangan Biaya</option>
      <option value="Mel">Mel</option>
      <option value="Mel Polisi">Mel Polisi</option>
      <option value="Mel Dishub">Mel Dishub</option>
      <option value="Mel Ormas">Mel Ormas</option>
      <option value="Mel Lain lain">Mel Lain lain</option>
    </select>
    <small id="keterangan_biayanHelp" class="form-text text-muted">Pilih Keterangan Biaya</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Waktu Kejadian </label>
    <input type="date" class="form-control" id="exampleInputEmail1" name="waktu" aria-describedby="emailHelp" placeholder="Pilih Waktu Kejadian">
    <small id="emailHelp" class="form-text text-muted">Pilih Waktu Kejadian</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Foto Keterangan </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_keterangan" aria-describedby="emailHelp" placeholder="Masukkan Foto Keterangan">
    <small id="emailHelp" class="form-text text-muted">Masukan Foto Keterangan</small>
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



  <center>
    <form action="" method="POST">
    <label>Cari Informasi Biaya</label>
    <input type="text" name="cari"> <button type="submit" name="go" class="btn btn-success">Cari</button>
  </form>
</center>

                              <div class="row">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                 <th>No Biaya Laporan</th>
                                 <th>Nama Operator</th>
                                 <th>Penempatan</th>
                                 <th>Jenis Unit</th>
                                 <th>Merek Unit</th>
                                 <th>Tonase</th>
                                 <th>No Unit</th>
                                 <th>Keterangan Biaya</th>
                                 <th>Waktu</th>
                                 <th>Foto Keterangan</th>
                                 <th>Detail</th>
                                 <th>Aksi</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                           
                                           <?php 
                                            include 'paging.php';
                                            ?>

                                        </tbody>
                                    </table>
                                  
                                    <!-- Link Pagination -->
                                  <center>
                                      <ul class="pagination justify-content-center">
                                          <li class="page-item">
                                              <a class="page-link" <?php if ($halaman > 1) { echo "href='?m=biayaLain&s=awal&halaman=$previous'"; } ?>>Previous</a>
                                          </li>
                                          <?php 
                                          // Menampilkan link halaman
                                          for ($x = 1; $x <= $total_halaman; $x++) {
                                              echo "<li class='page-item'><a class='page-link' href='?m=biayaLain&s=awal&halaman=$x'>$x</a></li>";
                                          }
                                          ?>
                                          <li class="page-item">
                                              <a class="page-link" <?php if ($halaman < $total_halaman) { echo "href='?m=biayaLain&ss=awal&halaman=$next'"; } ?>>Next</a>
                                          </li>
                                      </ul>
                                  </center>
                                </div>
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
