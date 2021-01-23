<?php
session_start();
if (!isset($_SESSION["operator"])) {
  header("Location: login.php");
  exit;
}
$page="home";
require'koneksi.php';
include('template/topbar.php');
include('template/sidebar.php');
// var_dump($_SESSION);
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body" style="background-color: #ffffff">
      <h1 class="h3 mb-4 text-judul"> Selamat Datang, <?=$_SESSION['username'] ?></h1>
        <div class="row">
          <div class="col-xl-2 col-md-5 mb-4">
            <div class="card border border-info py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                      <?php $user = query("SELECT * FROM user");
                      $jml_user = count($user); ?>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_user?> User</div>
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                <div class="col-auto">
                      <a href="Data_user.php">
                        <i class="fas fa-users fa-2x text-gray-300 "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          

      <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border border-danger py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Kriteria</div>
                  <?php $kriteria = query("SELECT * FROM kriteria");
                  $jml_kriteria = count($kriteria); ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_kriteria?> Kriteria</div>
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100"></div>
                  </div>                  
              </div>
            <div class="col-auto">
                      <a href="data_kriteria.php">
                        <i class="fas fa-list fa-2x text-gray-300 "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border border-primary py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Subkriteria</div>
                  <?php $subkriteria = query("SELECT * FROM subkriteria");
                  $jml_subkriteria = count($subkriteria); ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_subkriteria?> subkriteria</div>
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100"></div>
                  </div>  
              </div>
            <div class="col-auto">
                      <a href="data_subkriteria.php">
                        <i class="fas fa-list fa-2x text-gray-300 "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border border-warning py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Alternatif</div>
                  <?php $alternatif = query("SELECT * FROM alternatif");
                  $jml_alternatif = count($alternatif); ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_alternatif?> alternatif</div>
                    <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 5%" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100"></div>
                  </div>  
              </div>
            <div class="col-auto">
                      <a href="data_alternatif.php">
                        <i class="fas fa-user fa-2x text-gray-300 "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!--       <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border border-success py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alternatif</div>
                  <?php $alternatif = query("SELECT * FROM alternatif");
                  $jml_alternatif = count($alternatif); ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jml_alternatif?> alternatif</div>
                    <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100"></div>
                  </div>  
              </div>
            <div class="col-auto">
                      <a href="data_alternatif.php">
                        <i class="fas fa-users fa-2x text-gray-300 "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>

                  <!-- Area Chart -->
          <div class="row">
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">TK Al-Irsyad Ciledug-Cirebon</h6>
                </div>
                <div class="card-body">
                     <p>Yayasan Al Irsyad Ciledug merupakan organisasi nirlaba yang bergerak di bidang Pendidikan, Dakwah dan Sosial. Beralamatkan di Jl. Merdeka Barat Gg. Pahlawan No. 9 Ciledug - Cirebon Ciledug, Jawa Barat, Indonesia 45188. Proses perekrutan guru pada Yayasan ini yaitu, para calon guru yang telah mendaftar dan memenuhi persyaratan akan dilakukan tes sebagaimana yang telah ditentukan oleh pihak sekolah. </p>


                  </div>
                </div>
              </div>
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-3">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Sejarah AHP</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <p>AHP (Analytical Hierarchy Process) merupakan tehnik yang dikembangkan oleh Thomas L. Saaty pada 1970-an dan membantu pengambil keputusan untuk mengetahui alternatif terbaik dari banyak elemen pilihan. AHP menggunakan perbandingan berpasangan (pair wise comparison) untuk membuat suatu matriks yang menggambarkan perbandingan antara elemen yang satu dengan semua elemen yang lainnya.</p>

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                     <h6 class="m-0 font-weight-bold text-primary">Sejarah MOORA</h6>
                  </a>
                <!-- Card Content - Collapse -->
              <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    <p>Moora diperkenalkan oleh Brauers dan Zavadskas pada tahun 2006 , diterapkan untuk memecahkan banyak permasalahan ekonomi ,manajerial dan konstruksi dengan perhitungan rumus matematika dengan hasil yang tepat (Gadakh, 2011). Pada awalnya metode ini diperkenalkan oleh ,Brauers pada tahun 2004 sebagai "Multi-Objective Optimization" yang dapat digunakan untuk memecahkan berbagai masalah pengambilan keputusan yang rumit pada lingkungan pabrik.</p>

                   <p>Metode MOORA memiliki tingkat fleksibilitas dan kemudahan untuk dipahami dalam memisahkan bagian subjektif dari suatu proses evaluasi kedalam kriteria bobot keputusan dengan beberapa atribut pengambilan keputusan (Mandal , Sarkar, 2012). Metode ini memiliki tingkat selektifitas yang baik karena dapat menentukan tujuan dari kriteria yang bertentangan. Di mana kriteria dapat bernilai menguntungkan (benefit) atau yang tidak menguntungkan (cost).</p>

                   <p>Metode moora diterapkan untuk memecahkan banyak permasalahan ekonomi, manajerial dan konstruksi pada sebuah perusahaan maupun proyek. Metode ini memiliki tingkat selektifitas yang baik dalam menentukan suatu alternatif. Pendekatan yang dilakukan MOORA didefinisikan sebagai suatu proses secara bersamaan guna mengoptimalkan dua atau lebih kriteria yang saling bertentangan pada beberapa kendala (Attri and Grover, 2013).</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

  <?php include('template/footer.php'); ?>
  </div>
