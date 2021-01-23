<?php
session_start();
if (!isset($_SESSION["login_adm"])) {
  header("Location: login.php");
  exit;
}

$page="subkriteria";
include('template/topbar.php');
include('template/sidebar.php');
require 'koneksi.php';
$subkriteria = query("SELECT A.id_kriteria, A.nama_kriteria, B.nama_subkriteria, B.id_subkriteria, B.kode FROM kriteria A JOIN subkriteria B ON A.id_kriteria = B.id_kriteria WHERE A.id_kriteria = B.id_kriteria");

//ketika tombol cari ditekan
if(isset($_POST["cari"])){

  $subkriteria = cari3($_POST["keyword"]);
  //pas ngeklik tombol cari $kriteria akan diisi data hasil pencariandengan func cari, nah function cari dapat data dari yang diketikan user 
}

if (isset($_POST["hapus"])) {

if(hapussubkriteria ($_POST) > 0) {
  echo "
     <script>
      alert('Data Berhasil Dihapus!');
      document.location.href = 'data_subkriteria.php';  
     </script>
  ";
} else {
  echo "
    <script>
      alert('Data Gagal Dihapus!');
      document.location.href = 'data_subkriteria.php';    
    </script>
  ";
}
}

//cek apa tombol submit telah dipencet
if(isset($_POST["ubah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  // var_dump($_POST); die; 
  //ambil data dari tiap elemen
  if (ubahsubkriteria($_POST) > 0 ){
      echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'data_subkriteria.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'data_subkriteria.php';
      </script>
      ";
  }
}

//cek apa tombol submit telah dipencet
if(isset($_POST["tambah"])){
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  //var_dump($_POST); 
  //ambil data dari tiap elemen
  if (tambahsubkriteria($_POST) > 0 ){
      echo "
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'data_subkriteria.php';
      </script>
      ";
  }else{
    echo "
      <script>
        alert('data gagal ditambahkan');
        document.location.href = 'data_subkriteria.php';
      </script>
      ";
  }
}

?>
<div class="container-fluid">
  <h1 class="m-0 font-weight-bold text-dark">Data subkriteria</h1><br>
    <div class="card shadow mb-4">
      <div class="card-body"> 
        <form action="" method="post">
          <div class="input-group col-3 mb-3 float-right">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modaltambahsub"><i class="fas fa-plus-square"></i> Tambah Subkriteria</button>
          </div>
        <div class="input-group col-6 mb-3">
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
        <!-- <th>Id SubKriteria</th> -->
        <th class="text-center">Kode Subkriteria</th>
        <th class="text-center">Nama Kriteria</th>
        <th class="text-center">Nama Subkriteria</th>
        <th class="text-center" colspan="2">Aksi</th>     
        </tr>
      <?php $i = 1; ?> 
      <?php foreach ($subkriteria as $row) : ?>
    <tr>
      <td class="text-center"><?= $i; ?></td>
      <td class="text-center"><?= $row['kode']; ?></td>
      <td class="text-center"><?= $row['nama_kriteria']; ?></td>
      <td class="text-center"><?= $row['nama_subkriteria']; ?></td>
      <td class="text-center">
        <form method="POST">
          <!-- <a class="btn btn-info" href="parameter_nilai.php?id_subkriteria=<?=$row['id_subkriteria'] ?>"><i class="far fa-trash-alt"></i> Lihat Nilai Subkriteria</a> -->
            <button type="button" id="ubah" name="ubah" class="btn btn-secondary" data-toggle="modal" data-target="#modaleditsub<?= $row['id_subkriteria']; ?>" ><i class="fas fa-edit"></i> Ubah</button>
              <input type="hidden" name="id_subkriteria" value="<?=$row['id_subkriteria'];?>">
                <button type="submit" name="hapus" class="btn btn-info"  onclick="return confirm ('yakin hapus <?=$row['nama_subkriteria'] ?>?');"><i class="far fa-trash-alt"></i> hapus</button>
            </form>
          </td>    


      <!-- <td>
      <a class="btn btn-secondary" href="ubah_subkriteria.php?id_subkriteria=<?= $row["id_subkriteria"];?>"><i class="far fa-edit"></i> Ubah</a>
      <a class="btn btn-secondary" href="hapus_subkriteria.php?id_subkriteria=<?= $row["id_subkriteria"];?>" onclick="return confirm ('yakin ?');"><i class="far fa-trash-alt"></i> Hapus</a>
    </td> -->
  </tr>
    <?php $i++; ?>
      <?php endforeach; ?>
        </table>
          </div>
            </div>
          </div>
            <form action="bobot_kriteria.php">
              <button class="btn btn-info float-right"><i class="fas fa-angle-double-right"></i> Lanjut Perhitungan Bobot</button>
            </form>
        </div>
      </div>

<!-- modal tambah subkriteria -->
<div class="modal fade" id="modaltambahsub" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered role="document">
      <div class="modal-content ">
          <form method="POST" enctype="multipart/form-data">
              <div class="modal-header modal-bg" back>
                <h5 class="modal-title modal-text" id="modalTambahTitle">Form Subkriteria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
              <form>
            <input type="hidden" class="form-control mt-1" id="id_subkriteria" name="id_subkriteria"  required>
          <div class="form-group">
            <label for="kode" class="col-form-label">Kode Subkriteria </label>
              <input type="text" class="form-control mt-1" id="kode" name="kode"  required>
            </div>
          <div class="form-group">
            <label for="nama_subkriteria" class="col-form-label">Nama Subkriteria </label>
              <input type="text" class="form-control mt-1" id="nama_subkriteria" name="nama_subkriteria"  required>
                </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Pilih Kriteria</label>
                            <?php $kriteria = query("SELECT * FROM kriteria where id=2 ORDER BY id_kriteria "); ?>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01" name="id_kriteria" id="id_kriteria"><?php foreach ($kriteria as $row1) :?>
                            <!-- <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> -->
                            <option value="<?= $row1["id_kriteria"]; ?>"><?= $row1["nama_kriteria"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="tambah" class="btn btn-primary">Insert</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>


               <!-- Modal Edit Data -->
              <?php foreach ($subkriteria as $row)  : ?>
              <div class="modal fade" id="modaleditsub<?= $row['id_subkriteria']; ?>" tabindex="-2" role="dialog" aria-labelledby="modalEditDataTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <form method="post" enctype="multipart/form-data">
                       <div class="modal-header modal-bg" back>
                         <h5 class="modal-title modal-text" id="modalEditDataTitle">Form Edit Subkriteria</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <form>
                          <input type="hidden" name="id_subkriteria" class="form-control" value="<?=$row['id_subkriteria'] ?>">
                          <input type="hidden" name="id_kriteria" class="form-control" value="<?=$row['id_kriteria'] ?>">

                            <div class="form-group"> 
                            <label>Kode Subkriteria : </label>
                            <input type="text" name="kode" class="form-control" value="<?=$row['kode']?>">
                          </div>

                          <div class="form-group"> 
                            <label>Nama Subkriteria : </label>
                            <input type="text" name="nama_subkriteria" class="form-control" value="<?=$row['nama_subkriteria'] ?>" required>
                          </div>


                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Pilih Kriteria</label>
                            <?php $kriteria = query("SELECT * FROM kriteria where id=2 ORDER BY id_kriteria "); ?>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01" name="id_kriteria" id="id_kriteria"><?php foreach ($kriteria as $row1) :?>
                            <!-- <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> -->
                            <option value="<?= $row1["id_kriteria"]; ?>"><?= $row1["nama_kriteria"]; ?></option>
                            <?php endforeach; ?>
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
 <?php include('template/footer.php'); ?>
    </div>
