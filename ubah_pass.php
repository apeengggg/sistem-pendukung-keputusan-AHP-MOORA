<?php

session_start();
if(!isset($_SESSION["login_adm"])){
	header("location: index.php");
	exit;

}
$page="pass";
require ('koneksi.php');
include('template/topbar.php');
include('template/sidebar.php');
$user = query("SELECT * FROM user");

if(isset($_POST["ubah"])){
// apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
//   var_dump($_POST) 
//   ambil data dari tiap elemen
  if (ubah($_POST) > 0 ){
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
?>
<div class="container-fluid">
    <h1 class="m-0 font-weight-bold text-dark">Ubah Username Dan Password</h1><br>
    	<div class="card shadow mb-4">
			<div class="card-body"> 
			<!-- <?php foreach ($user as $row)  : ?> -->
				<form action="" method="post">
    				<div class="input-group col-7 mb-3">
    					<label>Username : </label>
    						<input class="form-control" type="text" name="username" value="<?=$user['username']?>" id="username">
    					<label>Password : </label>
    						<input class="form-control" type="password" name="username" value="<?=$user['password']?>" id="password">
    					<button class="btn btn-outline-secondary" type="submit" name="ubah" id="ubah"><i class="fas fa-search"></i> Ubah</button>
  			</form>
  			<!-- <?php endforeach; ?> -->
  		</div>
  	</div>
</div>
<?php include ('template/footer.php') ?>