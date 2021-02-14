<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
   exit;
}


if (isset($_POST['periode'])) {
  $id = $_POST['per'];
  // // $a = $_POST['a'];
  // var_dump($_POST); die;
  header("location: alt_detail.php?id=$id");
}

$page="alternatif";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');

  $cek=query("SELECT * FROM alternatif WHERE status='1' ORDER BY id_alternatif DESC LIMIT 0,1")[0];
  $id=$cek['id_alternatif'];
  $cekNil=query("SELECT * FROM nilai_alt INNER JOIN alternatif ON alternatif.id_alternatif=nilai_alt.id_alternatif WHERE nilai_alt.id_alternatif=$id AND alternatif.status=1 ");
  $nt=count($cekNil);

$alternatif = query ("SELECT * FROM alternatif WHERE status='1' ORDER BY id_alternatif ASC");
// $kriteria = query("SELECT * FROM kriteria");
// $subkriteria = query("SELECT * FROM subkriteria");
// $id= $_SESSION["id_alternatif"];
// tombol cari ditekan
if(isset($_POST["cari"])) {
	$alternatif = cari5($_POST["keyword"]);
}

if (isset($_POST["hapus"])) {

if(hapusalternatif ($_POST) > 0) {
  echo "
     <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'data_alternatif.php';  
     </script>
  ";
} else {
  echo "
    <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'data_alternatif.php';    
    </script>
  ";
}
}

// fungsi ubah status verifikasi
if (isset($_POST['ubah'])) {
  // var_dump($_POST); die;
  $id = $_POST['id_alt'];
  $status = $_POST['status'];

  // ubah status verifikasi
  $query = mysqli_query($koneksi, "UPDATE alternatif SET status='$status' WHERE id_alternatif='$id'");
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
<!DOCTYPE html>
	<html>
		<div class="container-fluid">
  			<h1 class="m-0 font-weight-bold text-dark">Data Alternatif</h1> <br>
    			<div class="card shadow mb-4">
      			<div class="card-body"> 
  						<!-- <form action="" method="post">
  							<div class="input-group col-6 mb-3">
    							<input class="form-control" type="text" name="keyword" autofocus placeholder="masukan keyword" autocomplete="off" id="keyword">
    								<button class="btn btn-outline-secondary" type="submit" name="cari" id="tombol-cari"><i class="fas fa-search"></i> SEARCH</button>
    									<button class="btn btn-outline-info" type="submit"  value="Refresh Page" onClick="document.location.reload(true)"><i class="fas fa-sync-alt"></i> REFRESH</button>
  									</div>
  								</form> -->
    				  <!-- <h1>Selamat Datang, <?php echo $nama; ?></h1> -->
				  <!-- <a href="tambah_alternatif.php" class="btn btn-secondary">Tambah Data Alternatif</a> -->
				  <div id="tabel-cari" class="card-body">
  			<div class="table-responsive">
    	<div class="col-md-auto"> 
      <h3>Pilih Periode Penerimaan</h3>
      <?php 
      // get periode on db
      $period = mysqli_query($koneksi, "SELECT * FROM periode");
      // $data = mysqli_fetch_array($period);

      ?>
      <form action="" method="post">
      <!-- <input type="text" name="a" id="a"> -->
        <select class="form-control" name="per" id="per" required>
        <option value="">Pilih Periode...</option>
        <!-- <option value="1">Pilih Periode... 1</option> -->
        <?php
          while ($data=mysqli_fetch_array($period)) {
            $tgl = date('d-M-Y', strtotime($data['tanggal']));
            if ($data['status']==1) {
              $status = 'Aktif';
            }else{
              $status = 'Tidak Aktif';
            }
          ?>
          <option value="<?=$data['id_periode']?>">Dibuat : <?= $tgl?> [Tahun Ajaran : <?=$data['tahun_awal']?>/<?=$data['tahun_akhir']?>] [Status : <?=$status?>]</option>
          <?php
          }
        ?>
        </select>
        <br>
        <button type="submit" id="periode" name="periode" class="btn btn-success">Lihat Alternatif</button>
        </form>
			</div>
				</div>
					</div>
						</div>
					</div>
        </div>
      </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Jumlah Alternatif Yang Diterima</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <form method="POST" action="perhitungan2.php">
          <label>Jumlah Alternatif </label>
          <input class="form-control mt-1" type="number" name="jml">
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">kirim</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- !-- Modal -->
<div class="modal fade" id="modal-xl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Alternatif</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <form method="POST">
          <label>Status Verifikasi</label>
          <input type="text" name="id_alt" id="id_alt" readonly>
          <select name="status" id="status" class="form-control" required>
                <option value="">Pilih Status Verifikasi...</option>
                <option value="2">Blokir</option>
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary toastrDefaultSuccess" name="ubah" id="ubah">Ubah Status Verifikasi</button>
      </div>
      </form>
    </div>
  </div>
</div>

								<?php include('template/footer.php'); ?>
									</div>

<script>
// detail data
$(document).on("click", "#verifikasi", function () {
    let id = $(this).data('id');
    $("#modal-xl #id_alt").val(id);
  });
</script>













