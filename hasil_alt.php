<?php 
session_start();
if(!isset($_SESSION["login_alt"])){
   header("location: index.php");
   exit;

}

$page="hasil";
require 'koneksi.php';
include('template/topbar.php');
include('template/sidebaralt.php');

?>
<div class="container-fluid">
  	<h1 class="m-0 font-weight-bold text-dark">Hasil Akhir</h1><br>
   	<div class="card shadow mb-4">
      	<div class="card-body"> 
      		<div class="table-responsive">
					<div class="col-md-auto">	
						<table class="table table-striped">
      					<thead class="table-dark" style="background-color: #4682B4">
      						<tr>
      							<th class="text-center">Kode</th>
      							<th class="text-center">Nama</th>
      							<th class="text-center">Rank</th>
                           <!-- <th class="text-center">Tanggal</th> -->
      						</tr>
      					</thead>
      						<?php
      						$sql="SELECT alternatif.kode, alternatif.nama, hasil.nilai FROM alternatif JOIN hasil USING (id_alternatif)";
							  $result = mysqli_query($koneksi, $sql);
							  if (mysqli_num_rows($result)==0) {
							?>
							<td class="text-center" colspan="3">Data Anda Belum Diseleksi</td>
							<?php 
							  }else{
                        	$i=1;
      							while ($row= mysqli_fetch_assoc($result)) {

      						?>
      						<tr>
      							<td class="text-center"><?=$row['kode']?></td>
      							<td class="text-center"><?=$row['nama']?></td>
      							<td class="text-center"><?=$i?></td>
                          <!--  <td class="text-center"><?=$row['tanggal']?></td> -->
      						</tr>
      				<?php
                        $i++;
					 }
					}
                     ?>
      				</table>
      			</div>
      		</div>
      	</div>
      </div>
  </div>
  <?php include('template/footer.php'); ?>


