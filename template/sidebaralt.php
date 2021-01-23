<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4682B4">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="datadiri_alternatif.php">
        <style type="text/css">
        .size {
          width: 80px;
        }
        </style>

        <div>
          <img class="size" src="assets1/foto/logo.png">
        </div>
        <div class="sidebar-brand-text">SPK<sup>AHP MOORA</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Divider -->
      <hr class="sidebar-divider">

      <li <?php if ($page=="datadiri") {
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="datadiri_alternatif.php">
          <i class="fas fa-clipboard-list"></i>
          <span>Data Diri</span></a>
      </li>

      <li <?php if ($page=="hasil") {
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="hasil_alt.php">
          <i class="fas fa-poll"></i>
          <span>Hasil Akhir</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="background-color: #B0C4DE">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['nama']?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#modalprofile">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                  </a>

              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

<?php 
$id=$_SESSION['id_alternatif'];
$nama=$_SESSION['nama'];
$username=$_SESSION['username'];
// var_dump($id); die;
$result=mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif='$id'");
$hasil=mysqli_fetch_assoc($result);

if(isset($_POST["ubahpass"])){
  // print_r($_POST); die;
  if(ubahpass2($_POST)>0){
    echo"<script>alert('password berhasil di ubah');
        document.location.href='datadiri_alternatif.php';
      </script>";
 }else{
    echo"<script>alert('password gagal di ubah');
        document.location.href='datadiri_alternatif.php';
      </script> ";
    }
  }
?>

        <div class="modal fade" id="modalprofile" tabindex="-2" role="dialog" aria-labelledby="modalEditDataTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <form method="post" enctype="multipart/form-data">
                       <div class="modal-header modal-bg" back>
                         <h5 class="modal-title modal-text" id="modalEditDataTitle">Ubah Password <?=$_SESSION['nama'] ?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <form>
                          <input type="hidden" name="id_alternatif" class="form-control" value="<?=$_SESSION['id_alternatif'] ?>">
                          <div class="form-group"> 
                            <label>Username : </label>
                            <input type="text" name="username" class="form-control" value="<?=$_SESSION['username'] ?>" required>
                          </div>
                          <div class="form-group"> 
                            <label>Password Lama : </label>
                            <input type="password" name="password_lama" class="form-control" required>
                          </div>

                          <div class="form-group"> 
                            <label>Password Baru : </label>
                            <input type="password" name="password1" class="form-control" required>
                          </div>

                          <div class="form-group"> 
                            <label>Konfirmasi Password : </label>
                            <input type="password" name="password2" class="form-control"  required>
                          </div>

                         <div class="modal-footer">
                           <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                           <button type="submit" name="ubahpass" class="btn btn-primary">Update</button>
                         </div>
                       </form>
                     </div>
                    </form>
                  </div>
                </div>
              </div>