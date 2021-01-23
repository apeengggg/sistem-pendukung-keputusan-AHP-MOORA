<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'koneksi.php';

if (isset($_POST["email"])) {



    $emailto = $_POST["email"];
    $code = uniqid(true);
    $query = mysqli_query($koneksi,"INSERT INTO reset_password (code,email) VALUES ('$code', '$emailto')");
    if (!$query) {
        exit("errorrrrrrrrrrrrrr");
    }
    // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'aayhumairoh29@gmail.com';                     // SMTP username
        $mail->Password   = 'hilink_2903';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('aayhumairoh29@gmail.com', 'Perekrutan Guru Al Irsyad');
        $mail->addAddress("$emailto");     // Add a recipient
        $mail->addReplyTo('no-replyaayhumairoh29@gmail.com', 'No Reply');

        // Content
        $url="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/ganti_pass.php?code=$code";
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Link Reset Password';
        $mail->Body    = "<h1>Reset Password</h1> Silahkan klik link berikut <a href='$url'>link ini </a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "
            <script>
                alert('Link Reset Password Sudah Dikirim Ke Email Anda, silahkan cek');
                document.location.href = 'login.php';
            </script>
            ";
        // echo 'Link Reset Password Sudah Dikirim Ke Email Anda, silahkan cek';
    } catch (Exception $e) {
        echo "
            <script>
                alert('email tidak terkirim. Mailer Error : {$mail->ErrorInfo}');
                document.location.href = 'login.php';
            </script>
            ";
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
}


?>
<!-- <form method="POST">
    <input type="text" name="email" placeholder="email" autocomplete="off">
    <br>
    <br>
    <input type="submit" name="submit" value="reset email">
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
                        <h1 class="h4 text-gray-900 mb-4">Masukan Email Terdaftar</h1>
                    </div>
                <form class="user" action="" method="POST">
              <div class="form-group">
            <input type="email" name="email" class="form-control form-control-user" id="exampleInputPassword" placeholder="email">
        </div>
    <button type="submit" name="submit" value="kirim" class="btn btn-secondary btn-block">Kirim</button><br>
</form>
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