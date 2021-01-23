<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
    exit;
}

$page="Web Setting";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');

if (isset($_POST["update"])) {
    $kode = $_POST["aktif"];
    // var_dump($kode); die;
    $ubah = mysqli_query($koneksi, "UPDATE web_set SET status_web='$kode'");
    if ($ubah) {
       echo "
     <script>
      alert('Pengaturan Website Berhasil di Ubah');
      document.location.href = 'web_setting.php';  
     </script>
  ";
    }else{
        echo "
     <script>
      alert('Pengaturan Website Gagal di Ubah');
      document.location.href = 'web_setting.php';  
     </script>
  ";
    }
}


?>
<!DOCTYPE html>
<html>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>Pengaturan Website Untuk Perektrutan</h1>
            <?php
            // ambil pengaturan saat ini
            $set = mysqli_query($koneksi, "SELECT status_web FROM web_set");
            $result = mysqli_fetch_assoc($set);
            $data = $result['status_web'];
            if ($data == 1) {
             $hasil = 'Aktif';
            }else{
             $hasil = 'Tidak Aktif';
            }
            ?>
            <h5>Pengaturan Saat Ini: <b> <?= $hasil ?> </b> </h5>
            <form action="" method="POST">

            <input type="radio" id="aktif" name="aktif" value="1">
            <label for="aktif">Aktif</label><br>

            <input type="radio" id="nonaktif" name="aktif" value="2">
            <label for="nonaktif">Non Aktif</label><br>

            <button type="submit" name="update" id="update" class="btn btn-primary">
                Ubah Pengaturan
            </button>
            </form>
        </div>
    </div>
</div>

<?php include('template/footer.php'); ?>
</div>