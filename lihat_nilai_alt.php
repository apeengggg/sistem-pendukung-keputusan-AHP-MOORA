<?php 
session_start();
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
	header("location: login.php");
	exit;
}

$page="listhasil";
require 'koneksi.php';
include('template/topbar.php');
include('template/sidebar.php');

?>
<div class="container-fluid">
	<h1 class="m-0 font-weight-bold text-dark">Lihat Hasil</h1><br>
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<div class="col-md-auto">
					<table class="table table-striped">
						<thead class="table-dark" style="background-color: #548176">
							<tr>
								<th class="text-center">Kode</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Nilai</th>
								<th class="text-center">Rank</th>
								<th class="text-center">Keterangan</th>
							</tr>
						</thead>
						<?php
    $sql="SELECT alternatif.nik, hasil.*, alternatif.nama FROM alternatif JOIN hasil USING (id_alternatif) WHERE tanggal = '$_GET[tanggal]'";
    $result = mysqli_query($koneksi, $sql);
    $i=1;
    while ($row= mysqli_fetch_assoc($result)) {
    ?>
						<tr>
							<td class="text-center"><?=$row['nik']?></td>
							<td class="text-center"><?=$row['nama']?></td>
							<td class="text-center"><?=$row['nilai']?></td>
							<td class="text-center"><?=$i?></td>
							<td class="text-center"><?=$row['ket']?></td>
						</tr>

						<?php
                        $i++;
    }
    ?>
					</table>
				</div>
			</div>
			<a href='javascript:history.back()'>
				<button class="btn btn-info float-left">
					<i class="fas fa-angle-double-left"></i> Kembali
				</button>
			</a>
			<a class="btn btn-info float-right" href="cetak_laporan.php?tanggal=<?=$_GET['tanggal'] ?>"
				target="_blank"><i class="fas fa-print"></i> Cetak</a>
		</div>
	</div>
</div>
<?php include('template/footer.php'); ?>