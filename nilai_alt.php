<?php
session_start();
if(!isset($_SESSION["operator"])) {
	header("Location: login.php");
	exit;
}
$page="alternatif";
require 'koneksi.php';
include ('template/topbar.php');
include ('template/sidebar.php');
$id=$_GET['id_alternatif'];

// $alternatif=query("SELECT * FROM alternatif");
$kriteria = query("SELECT * FROM kriteria");
$subkriteria = query("SELECT * FROM subkriteria");
$alternatif = query("SELECT * FROM alternatif where id_alternatif=$id");

if(isset($_POST["submit"])){
  ubahnilaialt($_POST);
  echo "
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'data_alternatif.php';
      </script>
      ";
//apakah $_POST yang kuncinya submit kalo dipencet akan dibuat array submit
  // var_dump($_POST);die; 
  //ambil data dari tiap elemen
}



?>

<div class="container-fluid">
  	<h1 class="m-0 font-weight-bold text-dark">Ubah Nilai Alternatif</h1> <br>
   		<div class="card shadow mb-4">
      		<div class="card-body">
      			<div class="table-responsive">
      				      				
      				<!-- <th class="text-center" colspan="2">Aksi</th> -->
      			<form method="POST">
              <input type="hidden" name="id" value="<?=$id; ?>">
      			 	
      			 	<?php foreach ($alternatif as $row) : ?>
						<tr>

								<h2 class="text-center"><?=$row['nama'];?></h2>

                <p class="text-center"><b><em>NOTE :</em></b> Skala penilaian menggunakan skala nilai yang telah ditetapkan pihak sekolah yaitu : Kurang 50-59, Cukup 60-69, dan Baik 70-80.</p>
								
                <?php foreach ($kriteria as $key) :?>
                  <?php if ($key['id']==1):?>
                    <?php $idk=$key['id_kriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_kriteria=$idk and id_alternatif=$id")[0]; ?>
                    <label name="<?=$key['id_kriteria']  ?>" ><?=$key['nama_kriteria']  ?></label>
                           
                    <input type="text" class="form-control" name="<?=$key['id_kriteria']  ?>" id="nilai" autocomplete="off" value="<?=$nilaii['nilai']; ?>">
                    <?php else: ?>
                      <?php $idk=$key['id_kriteria'];  
                      $sub=query("SELECT * FROM subkriteria where id_kriteria=$idk"); foreach ($sub as $key2 ) :?>
                      <?php $idsub=$key2['id_subkriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_kriteria=$idk and id_alternatif=$id and id_subkriteria=$idsub")[0]; ?>
                      <!-- <label name="<?=$key['nama_kriteria'].$key2['id_subkriteria'] ?>" ><?=$key2['nama_subkriteria']  ?></label>      -->
                      <label name="<?=$key2['id_subkriteria'] ?>"><?=$key['nama_kriteria'] ?> - <?=$key2['nama_subkriteria']  ?></label> 
                      <input type="text" class="form-control" name="<?=$idsub.'sub'?>" id="nilai" value="<?=$nilaii['nilai'] ?>" autocomplete="off" required>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  
                            
								<?php endforeach; ?>
                        

						</tr>
						<?php endforeach; ?>
            <br>  
                        
                  <button class="btn btn-info float-right" type="submit" name="submit"><i class="fas fa-angle-double-right"></i> Update
               </button>
            </form>
            <a href='javascript:history.back()'>
              <button class="btn btn-info float-left">
                <i class="fas fa-angle-double-left"></i> Kembali
              </button>   
            </a>
            <!-- <a href="perhitungan2.php">
            <button class="btn btn-info"><i class="fas fa-angle-double-right"></i> lanjut
               </button>
            </a> -->
      	</div>
      </div>
   </div>
</div>


<?php 
include ('template/footer.php');
 ?>