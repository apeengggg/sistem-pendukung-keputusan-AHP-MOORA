<?php 
session_start();
if(!isset($_SESSION["login_adm"])){
	header("location: index.php");
	exit;

}

$page="user";
require 'koneksi.php';
include('template/topbar.php');
include('template/sidebar.php');
$user = query("SELECT * FROM user");

//ketika tombol cari ditekan
if(isset($_POST["cari"])){

	$user = cari($_POST["keyword"]);
}


if(isset($_POST["ubah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  //var_dump($_POST) 
  //ambil data dari tiap elemen
  if (ubahlevel($_POST) > 0 ){
      echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'Data_user.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'Data_user.php';
      </script>
      ";
  }
}


if(isset($_POST["hapus"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  //var_dump($_POST) 
  //ambil data dari tiap elemen
  if (hapususer($_POST) > 0 ){
      echo "
      <script>
        alert('data berhasil dihapus');
        document.location.href = 'Data_user.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal dihapus');
        document.location.href = 'Data_user.php';
      </script>
      ";
  }
}



if (isset($_POST["tambah"])) {
//kalau tombol register diklik  
  if(tambahuser($_POST) > 0 ) {
    //jalankan fungsi registrasi, kalau fungsinya berhasil
    echo "<script>
      alert('user baru berhasil');
      document.location.href = 'Data_user.php';
        </script>";
  }else{
    echo mysqli_error($koneksi);
  } 
}


?>
<!DOCTYPE html>
<html>
<div class="container-fluid">
     <h1 class="m-0 font-weight-bold text-secondary">Data User</h1><br>
    <div class="card shadow mb-4">
<div class="card-body"> 
<form action="" method="post">
    <div class="input-group col-2 mb-3 float-right">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modaltambahadm"><i class="fas fa-plus-square"></i> Tambah User</button>
  </div>
  <div class="input-group col-7 mb-3">
    <input class="form-control" type="text" name="keyword" autofocus placeholder="masukan keyword" autocomplete="off" id="keyword">
    <button class="btn btn-outline-secondary" type="submit" name="cari" id="tombol-cari"><i class="fas fa-search"></i> SEARCH</button>
    <button class="btn btn-outline-info" type="submit"  value="Refresh Page" onClick="document.location.reload(true)"><i class="fas fa-sync-alt"></i> REFRESH</button>
  </div>
  </form>

<div id="tabel-cari" class="card-body">
  <div class="table-responsive">
    <div class="col-md-auto"> 
      <table class="table table-striped">
			<tr>
			<th>No</th>
			<!-- <th>Id Admin</th> -->
			<th class="text-center">Username</th>
			<th class="text-center">Level User</th>
			<th class="text-center" colspan="2">Aksi</th>		
			</tr>

		<?php $i = 1; ?>
		<?php foreach ($user as $row) : ?>
	<tr>
		<td><?= $i; ?></td>
			<!-- <td><?= $row["id_admin"]; ?></td> -->
			<td class="text-center"><?= $row["username"]; ?></td>
			<td class="text-center"><?= $row["level"]; ?></td>
			<td class="text-center">
			<!-- <a class="btn btn-secondary" href="ubah_user.php?id_admin=<?= $row["id_admin"];?>"><i class="far fa-edit"></i> Ubah</a> -->
      <form method="POST">
      <button type="button"  class="btn btn-secondary" data-toggle="modal" data-target="#modaleditpass<?= $row['id_admin']; ?>"><i class="fas fa-edit"></i>Ubah Level</button>
      <input type="hidden" name="id_admin" value="<?=$row['id_admin'];?>">
			<button class="btn btn-info" name="hapus" type="submit" onclick="return confirm ('yakin hapus <?=$row['username']?>?');"><i class="far fa-trash-alt"></i> hapus</button>
    </form>
		</td>
	</tr>
	<?php $i++; ?> 
	<?php endforeach; ?>

	</table>
</div>
</div>
</div>
</div>
</div>

<!-- Modal Edit Data -->
            <?php foreach ($user as $row)  : ?>
              <div class="modal fade" id="modaleditpass<?= $row['id_admin']; ?>" tabindex="-2" role="dialog" aria-labelledby="modalEditDataTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <form method="post" enctype="multipart/form-data">
                       <div class="modal-header modal-bg" back>
                         <h5 class="modal-title modal-text" id="modalEditDataTitle">Ubah Level User <?=$row["username"]?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <form>
                          <input type="hidden" name="id_admin" class="form-control" value="<?=$row['id_admin'] ?>">
                          <!-- <input type="hidden" name="nama_kriteria" class="form-control" value="<?=$row['nama_kriteria'] ?>"> -->

                          <div class="form-group"> 
                            <label>Username : <b><?=$row['username']?></b></label>
                          </div>

                          <!-- <div class="form-group"> 
                            <label>Password : </label>
                            <input type="password" name="password" class="form-control" value="<?=$row['password'] ?>" required>
                          </div> -->

                         <div class="form-group">
                          <label for="jenis_kriteria" class="col-form-label">Level User :</label>
                              <select name="level" class="form-control">
                                  <option value="admin"<?php if($row['level']=="admin") {echo "selected";} ?>>Admin</option>
                                  <option value="operator"<?php if($row['level']=="operator") {echo "selected";} ?>>Operator</option>
                              </select> 
                            </div>

                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" name="ubah" class="btn btn-primary">Update</button>
                         </div>
                       </form>
                     </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>	

                <!-- modal tambah user admin -->
                <div class="modal fade" id="modaltambahadm" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Form Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                              <label for="username" class="col-form-label">Username :</label>
                              <input type="text" class="form-control mt-1" id="username" name="username" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                              <label for="password" class="col-form-label">Password :</label>
                              <input type="password" class="form-control mt-1" id="password" name="password" autocomplete="off" required>
                            </div>


                            <div class="form-group">
                              <label for="password" class="col-form-label">Konfirmasi Password :</label>
                              <input type="password" class="form-control mt-1" id="password2" name="password2" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control mt-1" id="level" name="level" value="operator">
                            </div>
      
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>


</body>
<?php include('template/footer.php'); ?>
</html>