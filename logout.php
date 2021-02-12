<?php 
// mengaktifkan session
session_start();
require 'koneksi.php';
// CEK APAKAH ADA SESSION ADMIN,
if (isset($_SESSION["login_adm"])) {
// JIKA ADA JALANKAN FUNGSI INI UNTUK MENGUBAH STATUS ON JADI == 0
    status_offline_admin($_SESSION["id_admin"]);
// ATAU SESSION OPERATOR
}elseif (isset($_SESSION["operator"])) {
    // JIKA ADA JALANKAN FUNGSI INI UNTUK MENGUBAH STATUS ON JADI == 0
    status_offline_admin($_SESSION["id_admin"]);
// ATAU JUGA SESSION ALTERNATIF
}else{
    // echo $_SESSION['id_alternatif']; die;
    // JIKA ADA JALANKAN FUNGSI INI UNTUK MENGUBAH STATUS ON JADI == 0
    status_offline_alt($_SESSION['id_alternatif']);
}

// menghapus semua session
session_destroy();
// mengalihkan halaman sambil mengirim pesan logout
header("location:login2.php");
?>