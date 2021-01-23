<?php 
include ("koneksi.php");
if (!isset($_GET["code"])) {
  exit("cant find page");

}
$code = $_GET["code"];
$getemailquery = mysqli_query($koneksi, "SELECT email FROM reset_password WHERE code='$code' ");
if(mysqli_num_rows($getemailquery)== 0){
  exit("cant find page");

}

if(isset($_POST["password"])){
  $pw = $_POST["password"];
  $pw = password_hash($pw, PASSWORD_DEFAULT);

  $row = mysqli_fetch_array($getemailquery);
  $email = $row["email"];

  $query = mysqli_query($koneksi, "UPDATE alternatif SET password='$pw' WHERE email='$email'");

  if($query){
    $query = mysqli_query($koneksi, "DELETE FROM reset_password WHERE code='$code'");
    echo "
      <script>
        alert('password berhasil diubah');
        document.location.href = 'login.php';
      </script>
    ";
  }else{
   echo "
      <script>
        alert('terjadi kesalahan');
        document.location.href = 'login.php';
      </script>
    ";
  
  }
}
 ?>


<!-- <form method="POST">
  <input type="password" name="password" placeholder="password">
  <br><br>
  <input type="submit" name="submit" value="submit password">
  
</form> -->

 <!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reset Password</title>

  <!-- Custom fonts for this template-->
  <!-- <link rel="icon" type="timage/png" href="assets1/foto/logo.png"> -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="assets1/foto/logo.png"/>

</head>

<body class="bg-gradient" style="background-color: #c0c0c0">
  <form action="" method="post">
    <div class="container">
    <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-4">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-4 d-none d-lg">
              </div>
            <div class="col-lg-12">
              <div class="p-5">
                <img src="assets1/foto/logo.png" class="text-center" style="width: 150px; height: 100px; display: block; margin: auto;">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Masukan Password Baru</h1>
                  </div>
                <form class="user" action="" method="POST">
              <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>
              <button type="submit" name="login" value="login" class="btn btn-secondary btn-block">Reset</button><br>
            <hr>
          </form>
        <div class="text-center">
      <a class="small" href="login.php">login</a>
    </div>
      </div>
        </div>
          </div>
            </div>
        <div class="card-footer"> 
          <span class="copyright">
            Copyright ©
              <script>
            document.write(new Date().getFullYear())
              </script> Ayy
              </span>
          </div>

        </div>

      </div>

    </div>

  </div>

</form>
  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
</body>
</html>