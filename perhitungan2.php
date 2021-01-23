<?php 
session_start();
error_reporting(0);
// if (!isset($_SESSION["login_adm"])) {
//   header("Location: login.php");
//   exit;
// }
if (!isset($_SESSION["operator"])) {
  header("Location: login.php");
  exit;
}

$page="hasil";
include('template/topbar.php');
include('template/sidebar.php');
require 'koneksi.php';
// print_r($_POST);
$batas=$_POST['jml'];
$subkriteria = query("SELECT * FROM subkriteria");
$alternatif = query("SELECT * FROM alternatif");
$kriteria=query("SELECT *FROM kriteria");
 ?>

<div class="container-fluid">
	<h1 class="m-0 font-weight-bold text-dark">Perhitungan MOORA</h1><br>
		<div class="card shadow mb-4">
			<div class="card-body">
				<h3 class="ui header">Tabel Nilai Alternatif</h3>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="table-dark" style="background-color: #548176">
								<tr>
									<th style="vertical-align: middle;"rowspan="2">No</th>
									<th class="text-center" style="vertical-align: middle;" rowspan="2">Alternatif</th>
										<?php foreach ($kriteria as $key) : ?>
										<?php if ($key['id']==1) :?>
									<th class="text-center" style="vertical-align: middle;" rowspan="2"><?=$key['nama_kriteria'] ?></th>
										<?php else: ?>
											<?php $idkck=$key['id_kriteria']; $cekrw=query("SELECT*FROM subkriteria where id_kriteria=$idkck"); ?>
									<th class="text-center" colspan="<?= count($cekrw); ?>"><?=$key['nama_kriteria'] ?></th>
										<?php endif; ?>
										<?php endforeach; ?>	
								</tr>
								<tr>
									<?php foreach ($subkriteria as $key1) :?>
									<th class="text-center"><?=$key1['nama_subkriteria'] ?></th>
								<?php endforeach; ?>
								</tr>
							</thead>
								<?php $i=1; ?>
								<?php foreach ($alternatif as $key2) :?>
									<tr>
									<td class="text-center"><?= $i ?></td>
									<td class="text-center"><?=$key2['kode'];  ?></td>
									<?php $idal=$key2['id_alternatif']; 
									foreach ($kriteria as $key3 ): ?>
									<?php $idk=$key3['id_kriteria']; 
										  $ceksub=query("SELECT*FROM subkriteria where id_kriteria=$idk");
									if (count($ceksub)>0): ?>
										<?php $ns=query("SELECT id_subkriteria FROM subkriteria where id_kriteria=$idk"); foreach ($ns as $key4) :?>
										<?php $idsubb=$key4['id_subkriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_alternatif=$idal and id_kriteria=$idk and id_subkriteria=$idsubb"); if (count($nilaii)>0) :?>
										<?php $mt=query("SELECT * FROM nilai_alt where id_alternatif=$idal and id_kriteria=$idk and id_subkriteria=$idsubb")[0]; ?>
											<td class="text-center"><?=$mt['nilai']; ?></td>
										<?php else: ?>
												<td class="text-center">---</td>
										<?php endif; ?>

									<?php endforeach; ?>
										
										<?php else: ?>
											<?php $nilaiii=query("SELECT * FROM nilai_alt where id_alternatif=$idal and id_kriteria=$idk");
											 if (count($nilaiii)>0) :?>
											<?php $qrw=query("SELECT * FROM nilai_alt where id_alternatif=$idal and id_kriteria=$idk")[0]; ?>
											<td class="text-center"><?=$qrw['nilai'] ?></td>
											<?php else: ?>
											<td>---</td>
											<?php endif; ?>
										
										<?php endif; ?>
									
									<?php endforeach; ?>
									<?php $i++; ?>
									<?php endforeach; ?>
								</tr>
							</table>
      					</div>
      				<br>

		<?php $nilai_itung=query("SELECT alternatif.*,nilai_alt.*,kriteria.*
								  FROM nilai_alt JOIN alternatif USING(id_alternatif)
								  JOIN kriteria USING(id_kriteria)");

// print_r($nilai_itung);die;
$nilai_simpan=[];
foreach ($nilai_itung as $keytung) {
	$id=$keytung['id_alternatif'];
	$idk=$keytung['id_kriteria'];
	$sub=$keytung['id_subkriteria'];
	if ($sub==0) {
		$nilai_simpan[$id][$idk]=$keytung['nilai'];
	}else{
		$subb="S".$sub;
		$nilai_simpan[$id][$subb]=$keytung['nilai'];
	}
	
}
// print_r($nilai_simpan);die;
//menghitung nilai matriks normalisasi
$nilai_kuad=[];
foreach ($nilai_simpan as $keysim=>$val) {
	foreach ($val as $key => $value) {
		$nilai_kuad[$keysim][$key]=pow($value,2);
	}
}

$nilai_akar=[];
foreach ($nilai_kuad as $keysim=>$val) {
	foreach ($val as $key => $value) {
		$nilai_akar[$key][$keysim]=$value;
	}
}
$nilai_akar2=[];
foreach ($nilai_akar as $key2=>$arr) {
	$ar=array_sum($arr);
	$nilai_akar2[$key2]=sqrt($ar);
}

$nilai_normal=[];
foreach ($nilai_simpan as $key1 => $value) {
	foreach ($value as $key2 => $value2) {
		// echo "kriteria ".$key2." alternatif ".$key1." ".$value2." / ".$nilai_akar2[$key2]."<br>";
		$nilai_normal[$key1][$key2]=$value2/$nilai_akar2[$key2];
		
		
	}
}
// print_r($nilai_normal);die;
?>

<h3 class="ui header">Tabel Nilai Normalisasi</h3>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="table-dark" style="background-color: #548176">
								<tr>
									<th style="vertical-align: middle;"rowspan="2">No</th>
									<th class="text-center" style="vertical-align: middle;" rowspan="2">Alternatif</th>
										<?php foreach ($kriteria as $key) : ?>
										<?php if ($key['id']==1) :?>
									<th class="text-center" style="vertical-align: middle;" rowspan="2"><?=$key['nama_kriteria'] ?></th>
										<?php else: ?>
										<?php $idkck=$key['id_kriteria']; $cekrw=query("SELECT*FROM subkriteria where id_kriteria=$idkck"); ?>
									<th class="text-center" colspan="<?= count($cekrw); ?>"><?=$key['nama_kriteria'] ?></th>
										<?php endif; ?>
										<?php endforeach; ?>	
								</tr>
								<tr>
									<?php foreach ($subkriteria as $key1) :?>
									<th class="text-center"><?=$key1['nama_subkriteria'] ?></th>
								<?php endforeach; ?>
								</tr>
							</thead>

							<?php foreach ($alternatif as $key2) :?>
									<tr>
									<td class="text-center"><?= $i ?></td>
									<td class="text-center"><?=$key2['kode'];  ?></td>
									<?php $idal=$key2['id_alternatif']; 
									foreach ($kriteria as $key3 ): ?>
									<?php $idk=$key3['id_kriteria']; 
										  $ceksub=query("SELECT*FROM subkriteria where id_kriteria=$idk");
									if (count($ceksub)>0): ?>
										<?php $ns=query("SELECT id_subkriteria FROM subkriteria where id_kriteria=$idk"); foreach ($ns as $key4) :?>
										<?php $idsubb=$key4['id_subkriteria']; $nilaii=query("SELECT * FROM nilai_alt where id_alternatif=$idal and id_kriteria=$idk and id_subkriteria=$idsubb")[0];
										$idsubtp="S".$key4['id_subkriteria'];
											$pecah=str_split($nilai_normal[$idal][$idsubtp],8);
										?>
										<td class="text-center"><?=$pecah[0];?></td>
									<?php endforeach; ?>
										
										<?php else: ?>
											<?php $pecah=str_split($nilai_normal[$idal][$idk],8);?>
										<td class="text-center"><?=$pecah[0] ?></td>
										<?php endif; ?>
									
									<?php endforeach; ?>
									<?php $i++; ?>
									<?php endforeach; ?>
								</tr>

							</table>
      					</div>

<?php 
// print_r($nilai_normal);
$nilai_kali_bb=[];
foreach ($nilai_normal as $key => $value) {
	$JOIN=query("SELECT subkriteria.* FROM kriteria JOIN subkriteria USING(id_kriteria) GROUP BY subkriteria.id_kriteria");
	foreach ($JOIN as $keyn) {
		$id=$keyn['id_kriteria'];
		$query=query("SELECT*FROM subkriteria where id_kriteria=$id");
		// print_r($query);die;
		$nilai2=[];
		foreach ($query as $keys) {
			$ids="S".$keys['id_subkriteria'];
			// echo "id key".$ids."<br>";
			$nilai2[$id][]=$value[$ids];
			unset($nilai_normal[$key][$ids]);
		}
		$cba=array_sum($nilai2[$id]);
		$nilai_normal[$key][$id]=$cba;
	}
	
}
// print_r($nilai_normal);die;
foreach ($nilai_normal as $key => $value) {
	foreach ($value as $id => $value) {
		// echo "id_kriteria ".$id."<br>";
		$query=query("SELECT * FROM bobot_kriteria where id_kriteria=$id")[0];
		$bbt=$query['nilai'];
		$nilai_kali_bb[$key][$id]=$value*$bbt;
		$hasil=$value*$query['nilai'];
	}
}
// MENCARI NILAI MAX DAN MENJUMLAHKANNYA
$nilai_max=[];
foreach ($nilai_kali_bb as $key => $value) {
	$query=query("SELECT*FROM kriteria where jenis_kriteria='Benefit'");
	$nilais=[];
	foreach ($query as $kem ) {
		$id=$kem['id_kriteria'];
		$nilais[]=$value[$id];
	}
	$nilai_max[$key]=array_sum($nilais);
}
// MENCARI NILAI MIN DAN MENJUMLAHKANNYA
$nilai_min=[];
foreach ($nilai_kali_bb as $key => $value) {
	$query=query("SELECT*FROM kriteria where jenis_kriteria='Cost'");
	$nilais=[];
	foreach ($query as $kem ) {
		$id=$kem['id_kriteria'];
		$nilais[]=$value[$id];
	}
	$nilai_min[$key]=array_sum($nilais);
}
$nilai_akhir=[];
foreach ($nilai_max as $key => $value) {
		$nilai_akhir[$key]=$value-$nilai_min[$key];
}

arsort($nilai_akhir);

?>

<br>

<h3 class="ui header">Tabel Nilai Normalisasi Terbobot</h3>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="table-dark" style="background-color: #548176">
				<tr>
					<th class="text-center">Alternatif</th>
				<?php foreach ($kriteria as $key) : ?>
					<th class="text-center"><?=$key['nama_kriteria']?></th>

				<?php endforeach; ?>
				</tr>
			</thead>
			<?php foreach ($alternatif as $key ) :?>
				<tr>
					<?php $id=$key['id_alternatif'] ?>
					<td class="text-center"><?=$key['kode'] ?></td>
					<?php foreach ($kriteria as $keyu) :?>
						<?php $idk=$keyu['id_kriteria'] ?>
						<?php $pecah=str_split($nilai_kali_bb[$id][$idk],8);?>
						<td class="text-center"><?=$pecah[0];?></td>
						<!-- <td><?=$nilai_kali_bb[$id][$idk] ?></td> -->
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
		</table>
	</div>




<br>
<h3 class="ui header">Tabel Nilai Akhir</h3>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="table-dark" style="background-color: #548176">
	<tr>
		<!-- <td>No</td> -->
		<td class="text-center">Alternatif</td>
		<td class="text-center">Nilai Max</td>
		<td class="text-center">Nilai Min</td>
		<td class="text-center">Hasil Yi</td>
		<td class="text-center">Rangking</td>
		<td class="text-center">Keterangan</td>
	</tr>
</thead>
	<?php $i=1; ?>
		<?php foreach ($nilai_akhir as $kunci => $val) : ?>
	<tr>
		<?php $query=query("SELECT kode FROM alternatif where id_alternatif=$kunci")[0]; ?>
			<td class="text-center"><?=($query['kode']) ?></td>
			<!-- <td class="text-center"><?=$nilai_max[$kunci]; ?></td> -->
		<?php $pecah2=str_split($nilai_max[$kunci],8);?>
			<td class="text-center"><?=$pecah2[0];?></td>
			<!-- <td class="text-center"><?=$nilai_min[$kunci]; ?></td> -->
		<?php $pecah3=str_split($nilai_min[$kunci],8);?>
			<td class="text-center"><?=$pecah3[0];?></td>
		<?php $pecah4=str_split($val,8);?>
			<td class="text-center"><?=$pecah4[0]; ?></td>
			<td class="text-center"><?=$i; ?></td>
			<?php if ($i<=$batas) :?>
				<td class="text-center">lulus</td>
				<?php else: ?>
					<td class="text-center">tidak lulus</td>
				<?php endif; ?>
			<?php $i++; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>
<form method="post">
	<input type="hidden" name="batas" value="<?=$batas; ?>">
	<button type="submit" name="simpan" class="btn btn-info" onclick="return confirm ('yakin simpan hasil akhir ?');">Simpan Hasil Akhir</button>
</form>
<?php if (isset($_POST['simpan'])){
	nambah($nilai_akhir,$_POST['batas']);
	echo "     
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'data_alternatif.php';
      </script>
      ";
}
 ?>
</div>
	</div>


 <?php include('template/footer.php') ?>

     	</div>