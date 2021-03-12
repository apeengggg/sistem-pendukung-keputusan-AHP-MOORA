<?php 
session_start();

// if (isset($_SESSION["login_adm"])) {
//   header("Location: index.php");
//   exit;
// }

require 'koneksi.php';
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password =$_POST["password"];
    // admin/operator
      $result=mysqli_query($koneksi,"SELECT * FROM user WHERE BINARY username ='$username'");
    // alternatif
      $result2=mysqli_query($koneksi,"SELECT * FROM alternatif WHERE BINARY username ='$username'");

      // LOGIN ADMIN DAN OPERATOR
      if(mysqli_num_rows($result)){
        $row= mysqli_fetch_assoc($result);
        $level = $row["level"];
        // LOGIN ADMIN
        if ($level === 'admin') {
            $id_user=$row['id_admin'];
        // CEK PASSWORD
            if(password_verify($password,$row["password"])){
          $cekSts=query("SELECT status_on FROM user WHERE id_admin='$id_user'")[0];
          // CEK APAKAH STATUS SEDANG LOGIN DI DEVICE LAIN?
          if ($cekSts['status_on']<1){
            //   print_r($cekSts); die;
            // JIKA TIDAK UBAH STATUS LOGIN MENJADI 1 DENGAN FUNGSI DIBAWAH
                status_online_admin($id_user);
                    //set session ADMIN
                    $_SESSION["login_adm"] = true;
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["level"] = $row['level'];
                    $_SESSION['id_admin']=$row['id_admin'];
                    $id = encrypt_decrypt('encrypt', $row['id_admin']);
                    $level = encrypt_decrypt('encrypt', $row['level']);
                    setcookie('level',$level,time() + (60 * 60 * 24 * 1  ));
                    setcookie('id',$id,time() + (60 * 60 * 24 * 1  ));
                    header("location: index.php");
                    exit; 	
          }else{
            // JIKA SEDANG LOGIN ATAU STATUS == 1 MAKAN TAMPILKAN NOTIF DIBAWAH
            echo " <script>
              alert('akun anda sedang online pada device lain');
             document.location.href='login2.php';
            </script> ";
          }
        }else{
        //   $nama=$row['id_admin'];
        // JIKA PERIKSA PASSWORD GAGAL
          if (isset($_SESSION['login_adm'])) {
        // TAMBAH PERCOBAAN 1X
            $_SESSION['login_adm']+=1;
              $error = true;
          }else{
          // TAMBAH PERCOBAAN 1X
              $_SESSION['login_adm']=1;
              $error = true;
          }
          // JIKA SUDAH > 3X MAKA :
          if ($_SESSION['login_adm']>3) {
            // echo $_SESSION['id_admin']; die;
            // AKAN TAMPIL INI
            echo " <script>
              alert('Akun Anda Di Blokir, Silahkan hubungi Administrator123');
             document.location.href='login2.php';
            </script> ";
        }
          }
        
          // LOGIN OPERATOR
        }else{
            $id_user=$row['id_admin'];
        if(password_verify($password,$row["password"])){
          $cekSts=query("SELECT status_on FROM user WHERE id_admin='$id_user'")[0];
          if ($cekSts['status_on']<1){
            //   print_r($cekSts); die;
                status_online_admin($id_user);	
                    $_SESSION["operator"] = true;
                    $_SESSION["username"]=$row["username"];
                    $_SESSION["level"] = $row['level'];
                    $_SESSION['id_admin']=$row['id_admin'];;
                    $id = encrypt_decrypt('encrypt', $row['id_admin']);
                    $level = encrypt_decrypt('encrypt', $row['level']);
                    setcookie('level',$level,time() + (60 * 60 * 24 * 1  ));
                    setcookie('id',$id,time() + (60 * 60 * 24 * 1  ));
                    header("location: index_op.php"); 
          }else{
            echo " <script>
              alert('akun anda sedang online pada device lain');
             document.location.href='login2.php';
            </script> ";
          }
        }else{
        //   $nama=$row['id_admin'];
          if (isset($_SESSION['operator'])) {
              $_SESSION['operator']+=1;
              $error = true;
          }else{
              $_SESSION['operator']=1;
              $error = true;
          }
          if ($_SESSION['operator']>3) {
            // echo $_SESSION['id_admin']; die;
            echo " <script>
              alert('Akun Anda Di Blokir, Silahkan hubungi Administrator');
             document.location.href='login2.php';
            </script> ";
        }
          }
        }
        
      // LOGIN ALTERNATIF
      }elseif(mysqli_num_rows($result2)){
       //cek password
       $row2= mysqli_fetch_assoc($result2);
       $id_user2=$row2['id_alternatif'];
    //    print_r($id_user2); die;
       if(password_verify($password,$row2["password"])){
         $cekSts=query("SELECT status_on FROM alternatif WHERE id_alternatif='$id_user2'")[0];
         if ($cekSts['status_on']<1){
           //   print_r($cekSts); die;
               status_online_alt($id_user2);
               $_SESSION["login_alt"] = true;
               $_SESSION["nama"]=$row2["nama"];
               $_SESSION["username"]=$row2['username'];
               $_SESSION["id_alternatif"] = $row2['id_alternatif'];
               $_SESSION["status"] = $row2['status'];
               $_SESSION["id_periode"] = $row2['id_periode'];
               $id = encrypt_decrypt('encrypt', $row2['id_alternatif']);
                $level = encrypt_decrypt('encrypt', 'alternatif');
                setcookie('level',$level,time() + (60 * 60 * 24 * 1  ));
                setcookie('id',$id,time() + (60 * 60 * 24 * 1  ));
               header("location: datadiri_alternatif.php");
         }else{
           echo " <script>
             alert('akun anda sedang online pada device lain');
            document.location.href='login2.php';
           </script> ";
         }
       }else{
       //   $nama=$row['id_admin'];
         if (isset($_SESSION['id_alternatif'])) {
             $_SESSION['id_alternatif']+=1;
             $error = true;
         }else{
             $_SESSION['id_alternatif']=1;
             $error = true;
         }
         if ($_SESSION['id_alternatif']>3) {
           // echo $_SESSION['id_admin']; die;
           echo " <script>
             alert('Akun Anda Di Blokir, Silahkan hubungi Administrator');
            document.location.href='login2.php';
           </script> ";
       }
         }
      }else{
          $error = true;
      }
  }

$query = mysqli_query($koneksi, "SELECT max(kode) as kodeterbesar FROM alternatif");
$data = mysqli_fetch_array($query);
$kodealt = $data['kodeterbesar'];
$urut = (int) substr($kodealt, 1,2);
// echo $urut; die;
$urut++;
$huruf ="A";
$kodealt =$huruf.sprintf("%02s",$urut);


if (isset($_POST["register"])) {
  // cek apakah website aktif atau menerima perekrutan ? 
  // cek kode aktif = 1, tidak aktif =2 
$cek = mysqli_query($koneksi, "SELECT status_web FROM web_set WHERE status_web=2");
if (mysqli_num_rows($cek)>0) {
  echo "<script>
      alert('TK Al-Irsyad Sedang Tidak Menerima Perekturan Guru, Anda Tidak Dapat Mendaftar Akun!');
      document.location.href = 'login.php';
        </script>";
// kalau status nya 1 / aktif/sedang menerima perekturtan
// bisa daftar
      }else{
//kalau tombol register diklik  
  if(register($_POST) > 0 ) {
    //jalankan fungsi registrasi, kalau fungsinya berhasil
    echo "<script>
      alert('user baru berhasil ditambahkan');
      document.location.href = 'login.php';
        </script>";
  }else{
    echo mysqli_error($koneksi);
  } 
}
}

$cek=count(query("SELECT * FRom nilai_alt where id_alternatif=23"));
// echo "jumlah ".$cek;
 ?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <!-- <link rel="icon" type="timage/png" href="assets1/foto/logo.png"> -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="assets1/foto/logo.png" />

</head>

<body class="bg-gradient" style="background-color: #c0c0c0">
  <?php if(isset($error)): ?>
  <P style="color: red; font-style: italic;">username/password salah</P>
  <?php  endif; ?>
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
                    <img src="assets1/foto/logo.png" class="text-center"
                      style="width: 150px; height: 100px; display: block; margin: auto;">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <form class="user">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="username"
                          placeholder="Enter Username..." autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                          id="exampleInputPassword" placeholder="Password">
                      </div>

                      <button type="submit" name="login" value="login"
                        class="btn btn-secondary btn-block">Login</button><br>
                      <hr>

                    </form>
                    <div style="float: left;">
                      <a class="small" href="" data-toggle="modal" data-target="#modalregis">Buat Akun Disini!</a>
                    </div>
                    <div style="float: right">
                      <a class="small" href="resetpass.php">Forget Password</a>
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

  <!-- modat regis -->
  <div class="modal fade" id="modalregis" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
          <div class="modal-header modal-bg" back>
            <h5 class="modal-title modal-text" id="modalTambahTitle">Form Registrasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>

              <div class="form-group">
                <input type="hidden" class="form-control mt-1" id="kode" name="kode" value="<?=$kodealt?>" readonly
                  required>
              </div>

              <div class="form-group">
                <label for="nama" class="col-form-label">NIK</label>
                <input type="text" class="form-control mt-1" id="nik" name="nik" autocomplete="off" required
                  minlength="16" maxLength="16">
              </div>

              <div class="form-group">
                <label for="nama" class="col-form-label">Nama Lengkap :</label>
                <input type="text" class="form-control mt-1" id="nama" name="nama" autocomplete="off" required>
              </div>

              <div class="form-group">
                <label for="username" class="col-form-label">Username :</label>
                <input type="text" class="form-control mt-1" id="username" name="username" autocomplete="off" required>
              </div>

              <div class="form-group">
                <label for="password" class="col-form-label">Password :</label>
                <input type="password" class="form-control mt-1" id="password" name="password" autocomplete="off"
                  required>
              </div>

              <div class="form-group">
                <label for="password2" class="col-form-label">Konfirmasi Password :</label>
                <input type="password" class="form-control mt-1" id="password2" name="password2" autocomplete="off"
                  required>
              </div>

              <div class="modal-footer" class="text-center">
                <button type="submit" name="register" class="btn btn-primary">Daftar Akun</button>
              </div>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modat reset password -->
  <!-- <div class="modal fade" id="modalresetpass" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Form Forget Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form action="resetpass.php" methode="POST">
                            <div class="form-group">
                              <label for="email">Masukan Email Anda</label>
                              <input type="email" name="email" placeholder="email" class="form-control">
                            </div>
                            <div class="modal-footer" class="text-center">
                              <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div> -->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<!-- $2y$10$nC48PuSagLBPLM69x8kLxOM6wrEeSH25NIzoGOvmTguU/PrU4Or7e -->
<!-- $2y$10$bqtWUjMax9Zqxbtsloo1WuL064hah32U14TGtzoE42lAg7vn.0zBO -->