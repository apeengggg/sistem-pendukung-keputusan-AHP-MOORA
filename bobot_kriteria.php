<?php
session_start();
if (!isset($_SESSION["login_adm"])) {
  header("Location: login.php");
  exit;
}
$page="perhitungan";
include('template/topbar.php');
include('template/sidebar.php');
require('koneksi.php');
?>

  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="m-0 font-weight-bold text-dark">Perhitungan AHP</h1> <br>

          <!-- isi content -->
              <div class="card shadow mb-4">
<?php
showtabelperbandingan ('kriteria','kriteria');
?>
</div>
</div>
<?php include('template/footer.php'); ?>
