<?php 
require 'koneksi.php';

if (isset($_POST["register"])) {
//kalau tombol register diklik	
	if(register($_POST) > 0 ) {
		//jalankan fungsi registrasi, kalau fungsinya berhasil
		echo "<script>
			alert('user baru berhasil');
			document.location.href = 'login.php';
				</script>";
	}else{
		echo mysqli_error($koneksi);
	}	
}



 ?>
<!DOCTYPE html>
<html>
<head>
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<title> Halaman Registrasi</title>
	<style>
		label{
			display: block;
		}

	</style>
</head>
<body>
<form action="" method="POST">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-transparent mb-0"><h5 class="text-center">Please <span class="font-weight-bold text-secondary">REGISTRASI</span></h5></div>
            <div class="card-body">
                <div class="form-group">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password">
                </div>
                <!-- <div class="form-group custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                </div> -->
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-secondary">Registrasi</button> 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- <form action="" method="post">
	<ul>
		<li>
			<label for="username">username : </label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">password : </label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="password2">konfirmasi password :</label>
			<input type="password" name="password2" id="password2">
		</li>
		<li>
			<button type="submit" name="register">Register</button>
		</li>
	</ul> -->
</form>
</body>
</html>