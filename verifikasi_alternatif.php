<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
   exit;
}


$page="verifikasi";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');

  $cek=query("SELECT * FROM alternatif order by id_alternatif DESC LIMIT 0,1")[0];
  $id=$cek['id_alternatif'];
  $cekNil=query("SELECT*FROM nilai_alt where id_alternatif=$id");
  $nt=count($cekNil);

$alternatif = query ("SELECT * FROM alternatif WHERE status='0' ORDER BY id_alternatif ASC");
// $kriteria = query("SELECT * FROM kriteria");
// $subkriteria = query("SELECT * FROM subkriteria");
// $id= $_SESSION["id_alternatif"];
// tombol cari ditekan
if(isset($_POST["cari"])) {
	$alternatif = cari_menunggu($_POST["keyword"]);
}

if (isset($_POST["hapus"])) {

if(hapusalternatif ($_POST) > 0) {
  echo "
     <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'verifikasi_alternatif.php';  
     </script>
  ";
} else {
  echo "
    <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'verifikasi_alternatif.php';    
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

// ubah yang dipilih di checkbox
if (isset($_POST['ubahsemua'])) {
    $pilihan = $_POST['pilih'];
    $status = $_POST['ubahstatus'];
    $jumlah_dipilih = count($pilihan);
    
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
<!DOCTYPE html>
	<html>
		<div class="container-fluid">
  			<h1 class="m-0 font-weight-bold text-dark">Verifikasi Alternatif</h1> <br>
    			<div class="card shadow mb-4">
      			<div class="card-body"> 
  						<form action="" method="post">
  							<div class="input-group col-6 mb-3">
    							<input class="form-control" type="text" name="keyword" autofocus placeholder="masukan keyword" autocomplete="off" id="keyword">
    								<button class="btn btn-outline-secondary" type="submit" name="cari" id="tombol-cari"><i class="fas fa-search"></i> SEARCH</button>
    									<button class="btn btn-outline-info" type="submit"  value="Refresh Page" onClick="document.location.reload(true)"><i class="fas fa-sync-alt"></i> REFRESH</button>
  									</div>
  								</form>
    				  <!-- <h1>Selamat Datang, <?php echo $nama; ?></h1> -->
				  <!-- <a href="tambah_alternatif.php" class="btn btn-secondary">Tambah Data Alternatif</a> -->
				  <div id="tabel-cari" class="card-body">
  			<div class="table-responsive">
    	<div class="col-md-auto"> 
        
<form method="post">
    <table class="table table-striped">
  		<tr>
  			<th class="text-center">
              Pilih<br>
              <input type="checkbox" onchange="checkAll(this)" name="chk[]">
            </th>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
  			<th class="text-center">Nama</th>
  			<th class="text-center">Alamat</th>
  			<th class="text-center">Tanggal Lahir</th>
  		 	<th class="text-center" colspan="2">Aksi</th>
  		</tr>
			<?php $i = 1; ?>
			<?php foreach ($alternatif as $row) : 
				$tgl = $row["tgl_lahir"];
  				$t = date('d-M-Y', strtotime($tgl));
  	   ?> 
		<tr>
            <td align="center" width="40px">
                <input type="checkbox" name="pilih[]" value="<?php echo $row['id_alternatif']; ?>">
            </td>
			<td class="text-center"><?= $i; ?></td>
            <td class="text-center"><?= $row["nik"]; ?></td>
			<td class="text-center"><?= $row["nama"]; ?></td>
			<td class="text-center"><?= $row["alamat"]; ?></td>
			<td class="text-center"><?= $t; ?></td>
            <td align="center">
            <button type="submit" id="verifikasi" class="btn-xs btn-dark" data-toggle="modal"
                    data-target="#modal-xl" 
                    data-id="<?= $row['id_alternatif']; ?>">
                    <i class="fas fa-info-circle"></i>
            </button>
            </td>
		</tr>
	         <?php $i++; ?>
	       <?php endforeach; ?>
		    </table>
            <select name="ubahstatus" id="ubahstatus"required>
                <option value="">Pilih Aksi...</option>
                <option value="1">Aktifkan Semua</option>
                <option value="2">Blokir Semua</option>
            </select>
            <button type="submit" class="btn btn-primary" name="ubahsemua" id="ubahsemua">Ubah Status Verifikasi</button>
            </form>
			</div>
				</div>
					</div>
						</div>
					</div>
        </div>
      </div>



<!-- Modal -->
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
          <input type="hidden" name="id_alt" id="id_alt" readonly>
          <select name="status" id="status" class="form-control" required>
                <option value="">Pilih Status Verifikasi...</option>
                <option value="1">Aktifkan</option>
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

<script type="text/javascript">
 function checkAll(ele) {
      var checkboxes = document.getElementsByTagName('input');
      if (ele.checked) {
          for (var i = 0; i < checkboxes.length; i++) {
              if (checkboxes[i].type == 'checkbox' ) {
                  checkboxes[i].checked = true;
              }
          }
      } else {
          for (var i = 0; i < checkboxes.length; i++) {
              if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = false;
              }
          }
      }
  }
</script>














