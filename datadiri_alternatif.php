<?php  
session_start();
if (!isset($_SESSION["login_alt"])) {
  header("Location: login.php");
  exit;
}

$id = $_SESSION["id_alternatif"];
$nama =$_SESSION["nama"];

$page="datadiri";
require'koneksi.php';
include('template/topbar.php');
include('template/sidebaralt.php');

$alternatif =mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif='$id'") or die (mysqli_error($koneksi));
if (mysqli_num_rows($alternatif)== 0) {
  echo '<script>
  alert("data tidak ditemukan !!!!!!")
  </script>';
}else{
  $alt = mysqli_fetch_assoc($alternatif);
}

//cek apa tombol submit telah dipencet
if(isset($_POST["tambah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  //ambil data dari tiap elemen
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $tgl_lahir = $_POST["tgl_lahir"];
  $usia = $_POST["usia"];
  $pendidikan = $_POST["pendidikan_terakhir"];
  $ipk = $_POST["ipk"];
  $no = $_POST["no_HP"];
  $email = $_POST["email"];
  $allowed_text = array('pdf');
  $berkas = $_FILES["Berkas"]["name"];
  $file_ext = pathinfo($berkas, PATHINFO_EXTENSION);
  // $file_ext = strtolower(end(explode('.', $berkas)));
  $file_size = $_FILES["Berkas"]["size"];
  $tmp_berkas = $_FILES["Berkas"]["tmp_name"];
if (in_array($file_ext, $allowed_text)===true){
  if($file_size < 1044070){
     $newberkas = $nama.'-'.$berkas;
     $tmp_new = 'assets1/berkas/'.$newberkas;
      if (move_uploaded_file($tmp_berkas, $tmp_new)){ 
        $update = mysqli_query($koneksi, "UPDATE alternatif SET 
          nama='$nama',
          alamat ='$alamat',
          tgl_lahir = '$tgl_lahir',
          Usia = '$usia',
          pendidikan_terakhir = '$pendidikan',
          ipk = '$ipk',
          no_HP = '$no',
          email = '$email',
          size = '$file_size',
          Berkas = '$newberkas' WHERE id_alternatif = '$id'") or die (mysqli_error($koneksi));
        if ($update) {
          echo '
      <script>
      alert("Data Berhasil Ditambahkan")
      </script>'; 
        }else {
      echo '
  <script>
  alert("Data gagal ditambahkan")
  </script>';
  }
}else{
   echo '
  <script>
  alert("Berkas gagal diunggah")
  </script>'; 
    }
}else {
echo '
  <script>
  alert("Berkas harus< 1mb")
  </script>';
  }
} else {
 echo '
  <script>
  alert("Berkas harus PDF")
  </script>'; 
    }
}
 ?>

  <div class="container-fluid">
    <h1 class="m-0 font-weight-bold text-dark">Data Diri</h1> <br>
      <h2 class="h3 mb-4 text-judul"> Selamat Datang, <?=$_SESSION['nama'] ?> ^_^. Silahkan Isi Data Diri</h2>
        <div class="card shadow mb-4">
          <div class="card-body">
            <form action="" method="post">
              <div class="input-group col-2 mb-3 float-right">
                <button type="button" class="btn btn-secondary float-right " data-toggle="modal" data-target="#modaltambahalt"><i class="fas fa-plus-square"></i> Isi Data Diri</button>
            </div>
          </form>
          <!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#modaltambahalt" id="tambah"><i class="fas fa-plus"></i> Tambah Data Diri</button><br> -->
               <div class="table-responsive">
            <div class="col-md-auto"> 
         <table class="table table-striped">
            <tr>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tanggal Lahir</th>
              <th>Pend. Terakhir</th>
              <th>No. HP</th>
              <th>Email</th>
              <th>Berkas</th>
              <!-- <th>Aksi</th> -->
            </tr>

                <?php foreach ($alternatif as $row) : 
                $tgl = $row["tgl_lahir"];
                $t = date('d-M-Y', strtotime($tgl));
                ?> 
            
            <tr>
              <td><?= $row["nama"]; ?></td>
              <td><?= $row["alamat"]; ?></td>
              <td><?= $t; ?></td>
              <td><?= $row["pendidikan_terakhir"]; ?></td>
              <td><?= $row["no_HP"]; ?></td>
              <td><?= $row["email"]; ?></td>
              <td><a href="assets1/berkas/<?= $row["Berkas"]; ?>">Lihat Berkas</a></td>
<!--              <td>
                <form method="POST">
                  <button type="button" id="tambah" name="tambah" class="btn btn-secondary" data-toggle="modal" data-target="#modalubah"><i class="fas fa-edit"></i>Ubah</button>
                </form>
              </td> -->
            </tr>
  <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </div>


<!-- modal tambah data diri -->

<div class="modal fade" id="modaltambahalt" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered role="document">
        <div class="modal-content ">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header modal-bg" back>
                    <h5 class="modal-title modal-text" id="modalTambahTitle">Form Data Diri</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                          <form>
                            <input type="hidden" class="form-control mt-1" id="id_alternatif" name="id_alternatif"  required>
                              <div class="form-group">
                            <label for="nama" class="col-form-label">Nama :</label>
                          <input type="text" class="form-control mt-1" id="nama" name="nama" value="<?= $alt['nama']?> " required>
                        </div>

                            <div class="form-group">
                              <label for="alamat">Alamat :</label>
                                <textarea  type="text" class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                  </div>

                                      <div class="form-group">
                                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir :</label>
                                          <input type="date" class="form-control mt-1" id="tgl_lahir" name="tgl_lahir"  required>
                                            </div>
                                            <div class="form-group">
                                              <label for="usia" class="col-form-label">Usia :</label>
                                                <input type="text" class="form-control mt-1" id="usia" name="usia"  required>
                                            </div>

                                          <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir </label><br>
                                      <div class="form-check-inline">
                                    <!-- <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="D3"> -->
                                     <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="D3">
                                  <label> D3</label> 
                                </div>
                            <div class="form-check-inline">
                                <!-- <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="S1"> -->
                                  <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="S1">
                                <!-- <input type="hidden" class="form-check-input" name="cntoh" id="cntoh" value="80"> -->
                                <label> S1</label>  
                            </div>
                          <div class="form-check-inline">
                            <!-- <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="S2"> -->
                             <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="S2">
                            <label> S2</label>  
                          </div>
                        </div>
                              <div class="form-group">
                            <label for="ipk" class="col-form-label">IPK :</label>
                          <input type="text" class="form-control mt-1" id="ipk" name="ipk" placeholder="Gunakan Nilai Desimal dengan Tanda (.)" required>
                        </div>
                              <div class="form-group">
                            <label for="no_HP" class="col-form-label">No HP :</label>
                          <input type="text" class="form-control mt-1" id="no_HP" name="no_HP" required>
                        </div>
                              <div class="form-group">
                            <label for="email" class="col-form-label">Email :</label>
                          <input type="email" class="form-control mt-1" id="email" name="email" required>
                        </div>

                          <div class="form-group">
                            <label for="Berkas" >Berkas Persyaratan : </label>
                              <input type="file" class="form-control-file" name="Berkas" id="Berkas">
                              <div class="small">format file PDF, maks 5mb</div>
                          </div>

                            <div class="modal-footer">
                              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

<!-- modal edit data diri --> 

<div class="modal fade" id="modalubah" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered role="document">
                  <div class="modal-content ">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Form Data Diri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>
                            <input type="hidden" class="form-control mt-1" id="id_alternatif" name="id_alternatif"  required>
                            <div class="form-group">
                              <label for="nama" class="col-form-label">Nama :</label>
                              <input type="text" class="form-control mt-1" id="nama" name="nama" value="<?= $alt['nama']?> " required>
                            </div>

                            <div class="form-group">
                              <label for="alamat">Alamat :</label>
                              <textarea  type="text" class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                              <label for="tgl_lahir" class="col-form-label">Tanggal Lahir :</label>
                              <input type="date" class="form-control mt-1" id="tgl_lahir" name="tgl_lahir"  required>
                            </div>

                            <div class="form-group">
                              <label for="pendidikan_terakhir">Pendidikan Terakhir </label><br>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="SMA" checked>
                                  <label> SMA</label> 
                                </div>
                                  <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="D3">
                                  <label> D3</label>  
                                </div>
                                <div class="form-check-inline">
                                  <input type="radio" class="form-check-input" name="pendidikan_terakhir" id="pendidikan_terakhir" value="S1">
                                  <label> S1</label>  
                                </div>
<!--                             <div class="form-group">
                              <label for="Berkas" >Berkas Persyar </label>
                                <input type="file" class="form-control-file" name="Berkas" id="Berkas">
                            </div>
 -->
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="tambah" class="btn btn-primary">Ubah</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

<?php include('template/footer.php'); ?>
        </div>

















