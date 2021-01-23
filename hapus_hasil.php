<?php
require('koneksi.php');

$sql="DELETE FROM hasil WHERE tanggal ='$_GET[tanggal]'";
if ($koneksi->query($sql)=== TRUE) {
	echo "<script>alert('HAPUS BERHASIL');window.location = 'lihat_nilai.php';</script>";
}else{
	echo "Error:" . $sql . "<br>" . $koneksi->error;
}
?>