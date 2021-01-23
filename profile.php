<?php 	
session_start();
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
   exit;
}
$page='profile';
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');


$id=$_SESSION['id_admin'];
$nama=$_SESSION['username'];
$lvl=$_SESSION['level'];
// var_dump($id); die;
$result=mysqli_query($koneksi, "SELECT * FROM user WHERE id_admin='$id'");
$hasil=mysqli_fetch_assoc($result);

if(isset($_POST["ubahpass"])){
	if(ubahpass($_POST)>0){
 		echo"<script>alert('password berhasil di ubah');
				document.location.href='profile.php';
 			</script>";
 }else{
		echo"<script>alert('password gagal di ubah');
				document.location.href='profile.php';
			</script> ";
 		}
	}

  if(isset($_POST["ubahusername"])){
  if(ubahusername($_POST)>0){
    echo"<script>alert('username berhasil di ubah');
        document.location.href='profile.php';
      </script>";
 }else{
    echo"<script>alert('username gagal di ubah');
        document.location.href='profile.php';
      </script> ";
    }
  }
?>
<div class="container">
	<div class="card text-center">
  		<div class="card-header">
    		<h5 class="card-title">Profile <?=$_SESSION['username'] ?></h5>
  		</div>
		  	<div class="card-body">
				<div class="input-group mb-3">
		  			<div class="input-group-prepend">
		    			<span class="input-group-text" id="basic-addon1">Username : </span>
  					</div>
  						<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?=$_SESSION['username'] ?>" readonly>
					</div>
				<div class="input-group mb-3">
  			<div class="input-group-prepend">
    	<span class="input-group-text" id="basic-addon1">Level User : </span>
  			</div>
  				<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?=$_SESSION['level'] ?>" readonly>
			</div>
   		<form method="POST">
    		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ubahpass" ><i class="fas fa-edit"></i> Ubah Password</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ubahusername" ><i class="fas fa-edit"></i> Ubah Username</button>
        <input type="hidden" name="id_admin" value="<?=$_SESSION['id_admin'];?>">
    		</form>
  		</div>
	</div>
<!-- modal ubah password -->

<div class="modal fade" id="ubahpass" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered role="document">
        <div class="modal-content ">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header modal-bg" back>
                    <h5 class="modal-title modal-text" id="modalTambahTitle">Form Ubah Password </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                          <form method="POST">
                            <input type="hidden" class="form-control mt-1" id="id_admin" name="id_admin" value="<?=$_SESSION['id_admin'] ?>" required>
                          <div class="form-group">
                            <label for="username" class="col-form-label">Username : <?=$_SESSION['username'] ?></label>
                          <!-- <input type="username" class="form-control mt-1" id="username" name="username" value="<?=$_SESSION['username'] ?>"> -->
                        </div>
                        <div class="form-group">
                            <label for="password_lama" class="col-form-label">Password Lama :</label>
                          <input type="password" class="form-control mt-1" id="password_lama" name="password_lama" required>
                        </div>                            
                              <div class="form-group">
                            <label for="password1" class="col-form-label">Password Baru :</label>
                          <input type="password" class="form-control mt-1" id="password1" name="password1" required>
                        </div>

                            <div class="form-group">
                              <label for="password2">Konfirmasi Password :</label>
                                <input  type="password" class="form-control" id="password2" name="password2" required>
                                  </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="ubahpass" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

<!-- modal ubah username -->
<div class="modal fade" id="ubahusername" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered role="document">
        <div class="modal-content ">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header modal-bg" back>
                    <h5 class="modal-title modal-text" id="modalTambahTitle">Form Ubah Username </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                          <form method="POST">
                            <input type="hidden" class="form-control mt-1" id="id_admin" name="id_admin" value="<?=$_SESSION['id_admin'] ?>" required>
                              <div class="form-group">
                            <label for="username" class="col-form-label">Username :</label>
                          <input type="username" class="form-control mt-1" id="username" name="username" value="<?=$_SESSION['username'] ?>">
                        </div>                            
<!--                               <div class="form-group">
                            <label for="password" class="col-form-label">Password Baru :</label>
                          <input type="password" class="form-control mt-1" id="password1" name="password1" required>
                        </div>

                            <div class="form-group">
                              <label for="password2">Konfirmasi Password :</label>
                                <input  type="password" class="form-control" id="password2" name="password2" required>
                                  </div> -->
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="ubahusername" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>



<?php include('template/footer.php'); ?>
</div>