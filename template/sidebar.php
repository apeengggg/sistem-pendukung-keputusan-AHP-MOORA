<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3c8574 ">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
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
      <hr class="sidebar-divider">

      <!-- Heading -->
<?php if ($_SESSION['level']=='admin') : ?>
      <div class="sidebar-heading">
        DASHBOARD
      </div>
<!-- Nav Item - index-->
      <li <?php if($page == "home"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="index.php">
          <i class="fas fa-house-user"></i>
          <span>Home</span></a>
      </li>

      <?php else: ?>

      <div class="sidebar-heading">
        DASHBOARD
      </div>
<!-- Nav Item - index-->
      <li <?php if($page == "home"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="index_op.php">
          <i class="fas fa-house-user"></i>
          <span>Home</span></a>
      </li>

    <?php endif; ?>

      <?php if ($_SESSION['level']=='admin') : ?>

      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        AHP-MOORA
      </div>

<!-- Nav Item alternatif-->
      <li <?php if($page == "Web Setting"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="web_setting.php">
          <i class="fas fa-cog"></i>
          <span>Web Setting</span></a>
      </li>

      <li <?php if($page == "alternatif"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="data_alternatif.php">
          <i class="fas fa-user-friends"></i>
          <span>Alternatif</span></a>
      </li>

      <!-- Nav Item - kriteria -->
      <li <?php if($page == "kriteria"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="data_kriteria.php">
          <i class="fas fa-clipboard-list"></i>
          <span>Kriteria</span></a>
      </li>

      <!-- Nav Item subkriteria-->
      <li <?php if($page == "subkriteria"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="data_subkriteria.php">
          <i class="fas fa-clipboard-list"></i>
          <span>SubKriteria</span></a>
      
      </li>

      <!-- Nav Item perhitungan-->
      <li <?php if($page == "perhitungan"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="bobot_kriteria.php">
          <i class="fas fa-calculator"></i>
          <span>Perhitungan</span></a>
      </li>

      <!-- Nav Item perhitungan-->
      <li <?php if($page == "listhasil"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="lihat_nilai.php">
          <i class="fas fa-calculator"></i>
          <span>List Hasil Akhir</span></a>
      </li>


      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        DATA USER
      </div>
      <li <?php if($page == "user"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="Data_user.php">
          <i class="fas fa-users"></i>
          <span>User</span></a>
      </li>

      <?php else: ?>

      <!-- Nav Item alternatif-->
      <li <?php if($page == "alternatif"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="data_alternatif.php">
          <i class="fas fa-user-friends"></i>
          <span>Alternatif</span></a>
      </li>

      <!-- Nav Item perhitungan-->
      <li <?php if($page == "hasil"){
        echo "class='nav-item active disabled' ";
      } else {
        echo "class='nav-item disabled'";
      } ?> >
        <a class="nav-link disabled" href="perhitungan2.php">
          <i class="fas fa-calculator"></i>
          <span>Hasil Akhir</span></a>
      </li>


      <!-- Nav Item perhitungan-->
      <li <?php if($page == "listhasil"){
        echo "class='nav-item active'";
      } else {
        echo "class='nav-item'";
      } ?> >
        <a class="nav-link" href="lihat_nilai.php">
          <i class="fas fa-calculator"></i>
          <span>List Hasil Akhir</span></a>
      </li>
<?php endif; ?>

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
      <div id="content" style="background-color:#a2c5bb" >

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION["username"]?></span>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">
              <i class="fas fa-user mr-2 text-gray-400"></i>
                  Profile
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