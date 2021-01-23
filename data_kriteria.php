<?php 
session_start();
if(!isset($_SESSION["login_adm"])){
	header("location: index.php");
	exit;
}

$page = "kriteria";
include ('template/topbar.php');
include ('template/sidebar.php');
require ('koneksi.php');
$kriteria = query("SELECT * FROM kriteria");

//ketika tombol cari ditekan
if(isset($_POST["cari"])){

	$kriteria = cari2($_POST["keyword"]);
	//pas ngeklik tombol cari $kriteria akan diisi data hasil pencariandengan func cari, nah function cari dapat data dari yang diketikan user 
}
$query = mysqli_query($koneksi, "SELECT max(kode) as kodeterbesar FROM kriteria");
$data = mysqli_fetch_array($query);
$kodekrit = $data['kodeterbesar'];
$urut = (int) substr($kodekrit, 1,1);
$urut++;
$huruf ="K";
$kodekrit =$huruf.sprintf("%1s",$urut);

if(isset($_POST["tambah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  // var_dump($_POST);die; 
  //ambil data dari tiap elemen
  if (tambahkriteria($_POST) > 0 ){
      echo "     
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'data_kriteria.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal ditambahkan');
        document.location.href = 'data_kriteria.php';
      </script>
      ";
  }
}
if (isset($_POST["hapus"])) {
  // var_dump($_POST);
// $id = $_GET["id_kriteria"];

if (hapuskriteria ($_POST) > 0) {
  echo "
     <script>
      alert('Data Gagal Dihapus!');
      document.location.href = 'data_kriteria.php'; 
     </script>
  ";
} else {
  echo "
    <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'data_kriteria.php';     
    </script>
  ";
  }
}
//mengubah data kriteria
if(isset($_POST["ubah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  //var_dump($_POST) 
  //ambil data dari tiap elemen
  if (ubahkriteria($_POST) > 0 ){
      echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'data_kriteria.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'data_kriteria.php';
      </script>
      ";
  }
}

?>
<div class="container-fluid">
  <h1 class="m-0 font-weight-bold text-dark">Data Kriteria</h1> <br>
    <div class="card shadow mb-4">
      <div class="card-body"> 
	      <form action="" method="post">
          <!-- <div class="input-group col-2 mb-1 float-right"> -->
		        <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#modaltambah"><i class="fas fa-plus-square"></i> Tambah Kriteria</button>
          <!-- </div> -->
        <div class="input-group col-7 mb-3">
		<input class="form-control" type="text" name="keyword" autofocus placeholder="masukan keyword" autocomplete="off" id="keyword">
		    <button class="btn btn-outline-secondary" type="submit" name="cari" id="tombol-cari"><i class="fas fa-search"></i> SEARCH</button>
          <button class="btn btn-outline-info" type="submit"  value="Refresh Page" onClick="document.location.reload(true)"><i class="fas fa-sync-alt"></i> REFRESH</button>
        </div>
	   </form>
              
<div id="tabel-cari">
  <div class="table-responsive">
		<div class="col-md-auto">	
			<table class="table table-striped">
				<tr>
				<th class="text-center">No</th>
				<th class="text-center">Kode Kriteria</th>
				<th class="text-center">Nama Kriteria</th>
				<th class="text-center">Jenis Kriteria</th>
				<th class="text-center" colspan="2">Aksi</th>			
				</tr>
		  <?php $i = 1; ?> 
			<?php foreach ($kriteria as $row) : ?>
		<tr>
			<td class="text-center"><?= $i; ?></td>
			<td class="text-center"><?= $row['kode']; ?></td>
			<td class="text-center"><?= $row['nama_kriteria']; ?></td>
			<td class="text-center"><?= $row['jenis_kriteria']; ?></td>
			<td class="text-center">
			<!-- <a class="btn btn-secondary" href="ubah_kriteria.php?id_kriteria=<?= $row["id_kriteria"];?>"><i class="far fa-edit"></i> Ubah</a> -->
      <form method="POST">
        <button type="button" id="ubah" name="ubah" class="btn btn-secondary" data-toggle="modal" data-target="#modaledit<?= $row['id_kriteria']; ?>" ><i class="fas fa-edit"></i> Ubah</button>
          <input type="hidden" name="id_kriteria" value="<?=$row['id_kriteria'];?>">
            <button type="submit" name="hapus" class="btn btn-info" onclick="return confirm ('yakin hapus <?=$row['nama_kriteria'] ?>?');"><i class="far fa-trash-alt"></i> Hapus</button>
          </form>
		    </td>
	  </tr>
	<?php $i++; ?>
	<?php endforeach; ?>
	</table>
    </div>
      </div>
        </div>
          <form action="data_subkriteria.php">
            <button class="btn btn-info float-right"><i class="fas fa-angle-double-right"></i> Lanjut Ke Data Subkriteria
              </button>
                </form>
              </div>
             </div>



<!-- modal untuk tambah kriteria -->
<div class="modal fade" id="modaltambah" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Form Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>

                            <div class="form-group">
                              <label for="id" class="col-form-label">No Referensi :</label>
                                <select class="custom-select" name="id" id="id" value="<?= $kriteria["id"]; ?>">
                                    <option disabled></option>
                                    <option value="1">1 (tidak memiliki subkriteria)</option>
                                    <option value="2">2 (memiliki subkriteria)</option>
                                </select> 
                            </div>

                            <div class="form-group">
                              <label>Kode Kriteria</label>
                              <input type="text" class="form-control mt-1" id="kode" name="kode" value="<?=$kodekrit?>" readonly required>
                            </div>

                            <div class="form-group">
                              <label for="nama_kriteria" class="col-form-label">Nama Kriteria :</label>
                              <input type="text" class="form-control mt-1" id="nama_kriteria" name="nama_kriteria" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                              <label for="jenis_kriteria" class="col-form-label">Jenis Kriteria :</label>
                              <select class="custom-select" name="jenis_kriteria" id="jenis_kriteria" value="<?= $kriteria["jenis_kriteria"]; ?>">
                                  <option disabled></option>
                                  <option value="Benefit">Benefit</option>
                                  <option value="Cost">Cost</option>
                              </select> 
                            </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal Edit Data -->
              <?php foreach ($kriteria as $row)  : ?>
              <div class="modal fade" id="modaledit<?=$row['id_kriteria'] ?>" tabindex="-2" role="dialog" aria-labelledby="modalEditDataTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <form method="post" enctype="multipart/form-data">
                       <div class="modal-header modal-bg" back>
                         <h5 class="modal-title modal-text" id="modalEditDataTitle">Form Edit Kriteria <?=$row['nama_kriteria']?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <form>
                          <input type="hidden" name="id_kriteria" class="form-control" value="<?=$row['id_kriteria'] ?>">
                          <input type="hidden" name="id" class="form-control" value="<?=$row['id'] ?>">

                          <div class="form-group"> 
                            <label>Kode Kriteria : </label>
                            <input type="text" name="jenis_kriteria" class="form-control" value="<?=$row['kode'] ?>" disabled>
                          </div>
                            <div class="form-group">
                              <label for="id" class="col-form-label">No Referensi :</label>
                                <select class="custom-select" name="id" id="id" value="<?= $kriteria["id"]; ?>">
                                    <option disabled></option>
                                    <option value="1">1 (tidak memiliki subkriteria)</option>
                                    <option value="2">2 (memiliki subkriteria)</option>
                                </select> 
                            </div>
                          <div class="form-group"> 
                            <label>Nama Kriteria : </label>
                            <input type="text" name="nama_kriteria" class="form-control" value="<?=$row['nama_kriteria'] ?>" required>
                          </div>
                          <div class="form-group">
                              <label for="jenis_kriteria" class="col-form-label">Jenis Kriteria :</label>
                              <select class="custom-select" name="jenis_kriteria" id="jenis_kriteria" value="<?= $kriteria["jenis_kriteria"]; ?>">
                                  <option disabled></option>
                                  <option value="Benefit">Benefit</option>
                                  <option value="Cost">Cost</option>
                              </select> 
                            </div>

                         <div class="modal-footer">
                           <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                           <button type="submit" name="ubah" class="btn btn-primary">Update</button>
                         </div>
                       </form>
                     </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>   

  <?php include('template/footer.php'); ?>

</div>









