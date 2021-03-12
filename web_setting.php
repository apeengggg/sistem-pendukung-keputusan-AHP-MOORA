<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['operator']) AND !isset($_SESSION["login_adm"])) {
  header("location: login.php");
    exit;
}

$page="Web Setting";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');

if (isset($_POST["update"])) {
    $kode = $_POST["aktif"];
    if ($kode==1) {
        // cek apakah ada status periode yang sudah aktif?
        $ubah_1= mysqli_query($koneksi, "SELECT * FROM periode WHERE status=1");
        if (mysqli_num_rows($ubah_1)===0) {
            echo "
                <script>
                alert('Belum Ada Periode Yang Berstatus Aktif, Harap Ubah Status Periode Yang Terakhir Ditambahkan Menjadi Aktif!');
                document.location.href = 'web_setting.php';  
                </script>
            ";
        }else{
            $ubah_p = mysqli_query($koneksi, "UPDATE web_set SET status_web='$kode'");
            if ($ubah_p) {
                echo "
              <script>
               alert('Pengaturan Website Berhasil di Ubah');
               document.location.href = 'web_setting.php';  
              </script>
           ";
             }else{
                 echo "
              <script>
               alert('Pengaturan Website Gagal di Ubah');
               document.location.href = 'web_setting.php';  
              </script>
           ";
             }
        }
    }else{
        // ubah status periode menjadi tidka aktif semua
        $ubah_p = mysqli_query($koneksi, "UPDATE periode SET status=0");
        $ubah = mysqli_query($koneksi, "UPDATE web_set SET status_web='$kode'");
        if ($ubah OR $ubah_p) {
            echo "
          <script>
           alert('Pengaturan Website Berhasil di Ubah');
           document.location.href = 'web_setting.php';  
          </script>
       ";
         }else{
             echo "
          <script>
           alert('Pengaturan Website Gagal di Ubah');
           document.location.href = 'web_setting.php';  
          </script>
       ";
         }
    }
}

if (isset($_POST['tambah'])) {
    if ($_POST > 0) {
        add_periode($_POST);
    }
}
if (isset($_POST['edit'])) {
    if ($_POST > 0) {
        change_periode($_POST);
    }
}


?>
<!DOCTYPE html>
<html>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>Pengaturan Website Untuk Perektrutan</h1>
            <?php
            // ambil pengaturan saat ini
            $set = mysqli_query($koneksi, "SELECT status_web FROM web_set");
            $result = mysqli_fetch_assoc($set);
            $data = $result['status_web'];
            if ($data == 1) {
             $hasil = 'Aktif';
            }else{
             $hasil = 'Tidak Aktif';
            }
            ?>
            <h5>Pengaturan Saat Ini: <b> <?= $hasil ?> </b> </h5>
            <form action="" method="POST">
            <input type="radio" id="aktif" name="aktif" value="1" required>
            <label for="aktif">Aktif</label><br>
            <input type="radio" id="nonaktif" name="aktif" value="2" required>
            <label for="nonaktif">Non Aktif</label><br>
            <button type="submit" name="update" id="update" class="btn btn-primary" onclick="return confirm ('Jika Anda Akan Menonaktifkan, Periode Yang Aktif Saat Ini Akan Diubah Statusnya Menjadi Tidak Aktif. Jika Anda Akan Mengaktifkan Harap Aktifkan Periode Terbaru Telebih Dahulu!');">
                Ubah Pengaturan
            </button>
            </form>
            <br>
            <!-- get data periode -->
            <?php
                $query= mysqli_query($koneksi, "SELECT * FROM periode ORDER BY id_periode DESC");            
            ?>
            <center><h3>Periode Perekrutan</h3></center>
            <button type="button" id="ubah" name="ubah" class="btn btn-success" data-toggle="modal" data-target="#modaltambah">(+) Periode Perekrutan</button>
            <table class="table table-striped mt-2">
				<tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal Pembuatan</th>
                    <th class="text-center">Tahun Ajaran</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" colspan="2">Aksi</th>			
				</tr>
                <?php $i = 1; ?> 
                    <?php foreach ($query as $row) :
                        if ($row['status']==1) {
                            $status= 'Aktif';
                        }else{
                            $status= 'Tidak Aktif';
                        } 
                        $ambil = substr($row['tanggal'], 0, 9);
                        $jam = substr($row['tanggal'], 10, 16);
                        $tgl= date('d-M-Y', strtotime($ambil));
                        ?>
                <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td class="text-center"><?= $tgl. '//' .$jam; ?></td>
                    <td class="text-center"><?php echo $row['tahun_awal'].'/'.$row['tahun_akhir']; ?></td>
                    <td class="text-center"><?= $status; ?></td>
                    <td class="text-center">
                        <button type="submit" id="ubahperiode" name="ubahperiode" class="btn btn-secondary" data-toggle="modal" data-target="#modaledit<?=$row['id_periode']?>"
                            data-id="<?=$row['id_periode']?>"
                            data-awal="<?=$row['tahun_awal']?>"
                            data-akhir="<?=$row['tahun_akhir']?>">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
	        </table>
        </div>
    </div>
</div>

<script>
// detail data
  $(document).on("click", "#ubahperiode", function () {
    let id = $(this).data('id');
    let awal = $(this).data('awal');
    let akhir = $(this).data('akhir');
    document.write(id)
    $("#modaledit #id").val(id);
    $("#modaledit #tahun_awal").val(awal);
    $("#modaledit #tahun_akhir").val(akhir);
  });
</script>


<?php include('template/footer.php'); ?>
</div>
            <!-- modal untuk tambah kriteria -->
            <div class="modal fade" id="modaltambah" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Tambah Periode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>

                            <div class="form-group">
                            <div class="row">
                            <div class="col-6">
                              <label for="tahun_awal" class="col-form-label">Tahun Ajaran (Awal)</label>
                                <input type="text" name="tahun_awal" id="tahun_awal" class="form-control" placeholder="Contoh : 2016" required>
                            </div>
                            <div class="col-6">
                              <label for="tahun_akhir" class="col-form-label">Tahun Ajaran (Akhir)</label>
                                <input type="text" name="tahun_akhir" id="tahun_akhir" class="form-control" placeholder="Contoh : 2017" required>
                            </div>
                            </div>
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

            <?php foreach ($query as $key) : ?>
                <!-- modal untuk tambah kriteria -->
            <div class="modal fade" id="modaledit<?=$key['id_periode']?>" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Edit Periode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                            <div class="row">
                            <div class="col-6">
                              <label for="tahun_awal" class="col-form-label">Tahun Ajaran (Awal)</label>
                                <input type="text" name="tahun_awal" id="tahun_awal" class="form-control" value="<?=$key['tahun_awal']?>" required>
                                <input type="text" name="id" id="id" class="form-control" value="<?=$key['id_periode']?>" required>
                            </div>
                            <div class="col-6">
                              <label for="tahun_akhir" class="col-form-label">Tahun Ajaran (Akhir)</label>
                                <input type="text" value="<?=$key['tahun_akhir']?>" name="tahun_akhir" id="tahun_akhir" class="form-control" required>
                            </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="<?=$key['status']?>">Pilih Status Baru...</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach;?>