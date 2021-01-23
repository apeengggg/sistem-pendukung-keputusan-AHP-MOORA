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
      							<th class="text-center">Tanggal Hitung</th>
      							<!-- <th class="text-center">Jumlah Alternatif</th> -->
      							<th class="text-center">Aksi</th>
								</tr>
							</thead>
<?php
							$sql="SELECT tanggal FROM hasil GROUP BY tanggal";
							$result=mysqli_query($koneksi, $sql);
							// $tanda=1;
								while ($row=mysqli_fetch_assoc($result)) {
							?>

								<tr>
									<td class="text-center"><?=$row['tanggal']?></td>
									<!-- <td class="text-center"><?=$row['jalt']?></td> -->
									<td class="text-center">
										<a href="lihat_nilai_alt.php?tanggal=<?=$row['tanggal']?>" class="btn btn-info">Lihat</a>
										<a class="btn btn-info" href="hapus_hasil.php?tanggal=<?=$row['tanggal']?>">Hapus</a>
									</td>
								</tr>
								<?php } ?>
								

						</table>
					</div>
				</div>
				<a class="btn btn-info float-right" href="cetak_laporan_semua.php" target="_blank"><i class="fas fa-print"></i> Cetak Semua</a>
			</div>
		</div>
	</div>
	  <?php include('template/footer.php'); ?>