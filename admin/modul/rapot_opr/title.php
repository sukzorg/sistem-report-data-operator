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
            <h1 class="page-header">Data Rapot Operator</h1>
          </div>
        </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Tambah data
</button>

<!-- Print All -->
<a href="?m=rapot_opr&s=export_pdf&print=all" class="btn btn-success">
  <i class="fa fa-print"></i> Print All
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Rapot Opertator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?m=rapot_opr&s=simpan" method="POST" enctype="multipart/form-data">
        <div class="form-group">
    <label for="exampleInputEmail1">Nama Operator</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_operator_report" maxlength="20" aria-describedby="emailHelp" placeholder="Masukkan Nama Operator">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nama Operator</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Nomer SIO </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="no_sio_opr" aria-describedby="emailHelp" placeholder="Masukkan No SIO">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nomer SIO</small>
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
  <label for="exampleInputDate">Tanggal Kejadian</label>
  <input type="date" class="form-control" id="exampleInputDate" name="tgl_kejadian" aria-describedby="dateHelp" placeholder="Pilih tanggal">
  <small id="dateHelp" class="form-text text-muted">Pilih tanggal yang sesuai</small>
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Kejadian </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="kejadian" aria-describedby="emailHelp" placeholder="Masukkan Kejadian">
    <small id="emailHelp" class="form-text text-muted">Masukkan Isi Kejadian</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Note </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="note" aria-describedby="emailHelp" placeholder="Masukkan Note">
    <small id="emailHelp" class="form-text text-muted">Masukkan Note</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">No Berita Acara </label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="no_berita_acara" aria-describedby="emailHelp" placeholder="Masukkan No Berita Acara">
    <small id="emailHelp" class="form-text text-muted">Masukkan No Berita Acara</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Foto Kejadian </label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="foto_kejadian" aria-describedby="emailHelp" placeholder="Masukkan Foto Kejadian">
    <small id="emailHelp" class="form-text text-muted">Masukkan Foto Kejadian</small>
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
    <label>Cari Raport Operator</label>
    <input type="text" name="cari"> <button type="submit" name="go" class="btn btn-success">Cari</button>
  </form>
</center>

                              <div class="row">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                 <th>No Laporan</th>
                                 <th>Nama Operator</th>
                                 <th>Nomer SIO</th>
                                 <th>Penempatan</th>
                                 <th>Tanggal Kejadian</th>
                                 <th>Kejadian</th>
                                 <th>Note</th>
                                 <th>No Berita Acara</th>
                                 <th>Foto Kejadian</th>
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
                                              <a class="page-link" <?php if ($halaman > 1) { echo "href='?m=rapot_opr&s=awal&halaman=$previous'"; } ?>>Previous</a>
                                          </li>
                                          <?php 
                                          // Menampilkan link halaman
                                          for ($x = 1; $x <= $total_halaman; $x++) {
                                              echo "<li class='page-item'><a class='page-link' href='?m=rapot_opr&s=awal&halaman=$x'>$x</a></li>";
                                          }
                                          ?>
                                          <li class="page-item">
                                              <a class="page-link" <?php if ($halaman < $total_halaman) { echo "href='?m=rapot_opr&ss=awal&halaman=$next'"; } ?>>Next</a>
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
