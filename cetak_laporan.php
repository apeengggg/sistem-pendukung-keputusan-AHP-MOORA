<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'koneksi.php';
$sql=query("SELECT alternatif.kode, hasil.*, alternatif.nama FROM alternatif JOIN hasil USING (id_alternatif) WHERE tanggal = '$_GET[tanggal]'");

$mpdf = new \Mpdf\Mpdf();
$krit = '<!DOCTYPE html>
<html>
<head>
      <title>Cetak Laporan</title>
      <link rel="stylesheet" href="print.css">
</head>
<body>
<table width="100%" >
<tr>
<td width="10%"><left><img src="assets1/foto/logo.png"></left></td>
<td width="80%"><h1 > Al-Irsyad School </h1>
<p> Jl. Merdeka Barat Gg. Pahlawan No. 9 Ciledug – Cirebon, Ciledug Jawa Barat, Indonesia 45188 </p></td>
<td width="10%"></td>
</tr>
</table>

<hr />
<h2> Laporan Hasil Perekrutan Guru </h2>
      <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                  <th>Rank</th>
                  <th>Keterangan</th>
            </tr>';
            $i=1;
            foreach ($sql as $row) {
                  $krit .= '<tr>
                              <td>'. $row["kode"] .'</td>
                              <td>'. $row["nama"] .'</td>
                              <td>'. $row["nilai"] .'</td>
                              <td>'. $i .'</td>
                              <td>'. $row["ket"] .'</td>
                  </tr>';
                  $i++;
            }



 $krit .=    ' </table>
 <br>
 <br>
 <br>
 
<p style="text-align: right;"><b>Penanggung Jawab</b></p>
<br>
<br>
<p style="text-align: right;"><u>Muhammad Irwan</u></p>


</body>
</html>'; 
$mpdf->WriteHTML($krit);
$mpdf->Output('laporan_rekrutmen.pdf', \Mpdf\Output\Destination::INLINE);
?>