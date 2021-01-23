<?php
session_start();

// if(!isset($_SESSION["login_adm"])) {
//   header("Location: login.php");
//   exit;
// }
// if(isset($_SESSION["operator"])) {
//   header("Location: login.php");
//   exit;
// }

$page="alternatif";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');
$id=$_GET['id_alternatif'];

// $alternatif=query("SELECT * FROM alternatif");
$kriteria = query("SELECT * FROM kriteria");
$subkriteria = query("SELECT * FROM subkriteria");
$alternatif = query("SELECT * FROM alternatif where id_alternatif=$id");

?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">              
        <?php foreach ($alternatif as $row) : ?>
          <tr>
            <h2 class="text-center">Nilai <?=$row['nama'];?></h2>      
              <?php foreach ($kriteria as $key) :?>
                <?php if ($key['id']==1):?>
                  <?php $idk=$key['id_kriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_kriteria=$idk and id_alternatif=$id")[0]; ?>
                    <label name="<?=$key['nama_kriteria']  ?>" ><?=$key['nama_kriteria']  ?></label>       
                      <input type="text" class="form-control" name="<?=$key['nama_kriteria']  ?>" id="nilai" autocomplete="off" value="<?=$nilaii['nilai']; ?>" required disabled>
                      <?php else: ?>
                      <?php $idk=$key['id_kriteria'];  $sub=query("SELECT * FROM subkriteria where id_kriteria=$idk"); foreach ($sub as $key2 ) :?>
                      <?php $idsub=$key2['id_subkriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_kriteria=$idk and id_alternatif=$id and id_subkriteria=$idsub")[0]; ?>
                        <!-- <label name="<?=$key['nama_kriteria'].$key2['id_subkriteria'] ?>" ><?=$key2['nama_subkriteria']  ?></label>      -->
                          <label name="<?=$key2['id_subkriteria'] ?>"><?=$key['nama_kriteria'] ?> - <?=$key2['nama_subkriteria']  ?></label> 
                          <input type="text" class="form-control" name="<?=$key['nama_kriteria'].$key2['id_subkriteria']  ?>" id="nilai" value="<?=$nilaii['nilai'] ?>" autocomplete="off" required disabled>
                      <?php endforeach; ?>
                    <?php endif; ?>         
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            <br>   
              <a href='javascript:history.back()'>
                <button class="btn btn-info float-left">
                  <i class="fas fa-angle-double-left"></i> Kembali
                </button>   
              </a>
          </div>
        </div>
     </div>
  </div>
<?php include ('template/footer.php');?>












































