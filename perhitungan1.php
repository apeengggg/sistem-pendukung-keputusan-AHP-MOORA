<?php
session_start();

$page="perhitungan";
include('template/topbar.php');
include('template/sidebar.php');
require('koneksi.php');

//ketika tombol submit diklik
if (isset($_POST['submit'])) {
	$jenis = $_POST['jenis'];
//pas ngeklik tombol submit $jenis akan diisi dengan data hasil pencarian dengan func cari, nah function cari dapat data dari yang diketikan user 

//jumlah kriteria
	if ($jenis == 'kriteria'){
		$n= getjmlkriteria();
	}else{
		$n= getjmlalternatif();
	}
	


	//memetakan nilai kedalam bentuk matrik x= baris y=kolom

	$matrik = array();
	$urut 	= 0;

	for ($x=0; $x <= ($n-2) ; $x++) {
		for ($y=($x+1); $y <= ($n-1) ; $y++) {
			$urut++;
			$pilih	= "pilih".$urut;
			$bobot 	= "bobot".$urut;
			if ($_POST[$pilih] == 1) {
				$matrik[$x][$y] = $_POST[$bobot];
				$matrik[$y][$x] = 1 / $_POST[$bobot];
			} else {
				$matrik[$x][$y] = 1 / $_POST[$bobot];
				$matrik[$y][$x] = $_POST[$bobot];
			}


			if ($jenis == 'kriteria') {
				inputnilaikriteria($x,$y,$matrik[$x][$y]);
			} else {
				inputnilaialternatif($x,$y,($jenis-1),$matrik[$x][$y]);
			}
		}
	}

	//diagonal ---> bernilai 1
	for ($i = 0; $i <= ($n-1); $i++) {
		$matrik[$i][$i] = 1;
	}
	//inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmp = array();
	$jmlmk = array();
	for ($i=0; $i <= ($n-1); $i++) {
		$jmlmp[$i] = 0;
		$jmlmk[$i] = 0;
	}

	//menghitung jumlah pada kolom kriteria tabel perbandingan  berpasangan
	for ($x=0; $x <= ($n-1); $x++){
		for ($y=0; $y <= ($n-1) ; $y++) { 
			$value = $matrik[$x][$y];
			$jmlmp[$y] += $value;
		}
	}

	//menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrik merupakan matrik yang telah dinormalisasi
	for ($x=0; $x <= ($n-1) ; $x++) { 
		for ($y=0; $y <= ($n-1) ; $y++) { 
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmp[$y];
			$value = $matrikb[$x][$y];
			$jmlmk[$x] += $value;
		}

		//nilai bobot(priority vektor) bbt == pv
		//$bbt == inputan untuk nilai perbandingan kriteria
		$bbt[$x] = $jmlmk[$x] / $n;

		//memasukan nilai bobot kedalam ke dalam tabel kriteria

		if ($jenis == 'kriteria'){
			$id_kriteria = getidkriteria($x);
		// echo "nilai bobot". $bbt[$x]."<br>";
			//echo "id_kriteria".$id_kriteria."<br>";
			inputbobotkriteria($id_kriteria, $bbt[$x]);
		}else{
			$id_kriteria = getidkriteria($jenis-1);
			$id_alternatif = getidalternatif($x);
			inputbobotalternatif($id_alternatif, $id_kriteria, $bbt[$x]);
		}
	}

	//cek konsistensi

	$lamda = getlamda($jmlmp,$jmlmk,$n);
	$konsistensiindex = getkonsindex($jmlmp,$jmlmk,$n);
	$konsistensiratio = getkonsratio($jmlmp,$jmlmk,$n);

	if ($jenis == 'kriteria'){
		include("output.php");
	}else{
		include('bobot_hasil.php');
	}
}
include('template/footer.php');
?>