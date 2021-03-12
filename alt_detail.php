<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
   exit;
}

if (isset($_GET['id'])) {
    $id_p = $_GET['id'];
    // var_dump($_POST); die;
}else{
    echo "akses dicekal";
    die;
}


$page="alternatif";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');

  $cek=query("SELECT * FROM alternatif WHERE status='1' ORDER BY id_alternatif DESC LIMIT 0,1")[0];
  $id=$cek['id_alternatif'];
  $cekNil=query("SELECT * FROM nilai_alt INNER JOIN alternatif ON alternatif.id_alternatif=nilai_alt.id_alternatif WHERE nilai_alt.id_alternatif=$id AND alternatif.status=1 ");
  $nt=count($cekNil);

$alternatif = query ("SELECT * FROM alternatif WHERE status='1' AND id_periode=$id_p ORDER BY id_alternatif ASC");
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
    <table class="table table-striped">
  		<tr>
  			<th class="text-center">No</th>
        <th class="text-center">Kode</th>
  			<th class="text-center">Nama</th>
  			<th class="text-center">Alamat</th>
  			<th class="text-center">Tanggal Lahir</th>
  			<th class="text-center">Pend. Terakhir</th>
        <th class="text-center">Email</th>
        <th class="text-center">No. HP</th>
  		 	<th class="text-center">Berkas</th>
  		 	<th class="text-center">Nilai</th>
  		 	<th class="text-center" colspan="2">Aksi</th>
  		</tr>
			<?php $i = 1; ?>
			<?php foreach ($alternatif as $row) : 
				$tgl = $row["tgl_lahir"];
  				$t = date('d-M-Y', strtotime($tgl));
  	   ?> 
		<tr>
			<td class="text-center"><?= $i; ?></td>
      <td class="text-center"><?= $row["kode"]; ?></td>
			<td class="text-center"><?= $row["nama"]; ?></td>
			<td class="text-center"><?= $row["alamat"]; ?></td>
			<td class="text-center"><?= $t; ?></td>
			<td class="text-center"><?= $row["pendidikan_terakhir"]; ?></td>
      <td class="text-center"><?= $row["email"]; ?></td>
      <td class="text-center"><?= $row["no_HP"]; ?></td>
			<td class="text-center"><a href="assets1/berkas/<?= $row["Berkas"]; ?>" target="_blank">Lihat Berkas</a></td>
			<td class="text-center">
          <?php if ($nt>0):?>
<<<<<<< HEAD
        <a href="nilai_alternatif.php?id_alternatif=<?=$row['id_alternatif'] ?>">Lihat Nilai</a>
=======
        <a href="nilai_alternatif.php?id_alternatif=<?=$row['id_alternatif'] ?>" target="_blank">Lihat Nilai</a>
>>>>>>> cookie
			<?php else: ?>
    <a href="data_alternatif.php" onclick="return confirm ('Alternatif belum diinput nilai');" >Lihat Nilai</a>
      <?php endif; ?>
</td>
      <td class="text-center">
        <?php if ($_SESSION['level']=='operator') : ?>
          <button type="submit" id="verifikasi" class="btn-xs btn-dark" data-toggle="modal"
                    data-target="#modal-xl" 
                    data-id="<?= $row['id_alternatif']; ?>">
                    <i class="fas fa-info-circle"></i>
                </button>
        <form method="POST">
          <input type="hidden" name="id_alternatif" value="<?=$row['id_alternatif'];?>">
				  <!-- <a class="btn btn-secondary" href="hapus_alternatif.php?id_alternatif=<?= $row["id_alternatif"]; ?>" onclick="return confirm('yakin?');"><i class="far fa-trash-alt"></i> hapus</a> -->
          <button type="submit" name="hapus" class="btn btn-secondary" onclick="return confirm('yakin hapus <?=$row['nama']?>?');"><i class="far fa-trash-alt"></i></button>
            <?php $id=$row['id_alternatif']; $ceknilai=query("SELECT*FROM nilai_alt where id_alternatif=$id"); if (count($ceknilai)>0) :?>
              <a href="nilai_alt.php?id_alternatif=<?= $row["id_alternatif"]; ?>" type="button" class="btn btn-info "><i class="fas fa-plus-square"></i> Edit Nilai</a>
        
                <?php else: ?>
                    <a href="tambah_nilai.php?id_alternatif=<?= $row["id_alternatif"]; ?>" type="button" class="btn btn-info "><i class="fas fa-plus-square ml"></i> Tambah Nilai</a>
                  <?php endif; ?>
                </form>
                <?php else: ?>
             <form method="POST">
                <input type="hidden" name="id_alternatif" value="<?=$row['id_alternatif'];?>">
                  <button type="submit" name="hapus" class="btn btn-secondary" onclick="return confirm('yakin hapus <?=$row['nama']?>?');"><i class="far fa-trash-alt"></i></button>
                </form>
                <?php endif; ?>
			       </td>
		        </tr>
	         <?php $i++; ?>
	       <?php endforeach; ?>
		    </table>
			</div>
				</div>
					</div>

          <?php if ($_SESSION['level']==='operator') : ?>
            <?php if ($nt>0):?>
                <button class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-angle-double-right"></i> Proses Hitung </button>
    </a>
            <?php else: ?>

                <button class="btn btn-info float-right" onclick="return confirm ('Alternatif belum diinput nilai');" ><i class="fas fa-angle-double-right"></i> Proses Hitung</button>
    
    </a>
      <?php endif; ?>
      <?php endif; ?>

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
<<<<<<< HEAD
=======
          <input type="text" name="periode" value="<?=$id_p?>">
>>>>>>> cookie
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













