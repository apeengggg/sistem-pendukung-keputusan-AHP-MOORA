<?php 
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
   exit;
}

require 'koneksi.php';

    $pilihan = $_POST['pilih'];
    $status = $_POST['ubahstatus'];
    $jumlah_dipilih = count($pilihan);
    if ($jumlah_dipilih == 0) {
        header("location:verifikasi_alternatif.php");
    }else{
    for($x=0;$x<$jumlah_dipilih;$x++){
       $query = mysqli_query($koneksi, "UPDATE alternatif SET status=$status WHERE id_alternatif='$pilihan[$x]'");
    }
    if ($query) {
        echo "<script>
        alert('Status Alternatif Berhasil DiUbah')
        </script>";
    }else{
        echo "<script>
        alert('Status Alternatif Gagal DiUbah')
        </script>";
    }
}

?>