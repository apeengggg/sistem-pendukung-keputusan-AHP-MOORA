<?php 
// mengaktifkan session
session_start();
require 'koneksi.php';
if (isset($_SESSION["login_adm"])) {
    status_offline_admin($_SESSION["id_admin"]);
}elseif (isset($_SESSION["operator"])) {
    status_offline_admin($_SESSION["id_admin"]);
}else{
    // echo $_SESSION['id_alternatif']; die;
    status_offline_alt($_SESSION['id_alternatif']);
}

// menghapus semua session
session_destroy();
// mengalihkan halaman sambil mengirim pesan logout
header("location:login2.php");
?>