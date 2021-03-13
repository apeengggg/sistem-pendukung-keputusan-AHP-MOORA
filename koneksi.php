<?php
//connect to database
 $koneksi = mysqli_connect("localhost","root","","spk_AHP_MOORA"); //$koneksi memegang true or false
 if (mysqli_connect_error()){
 	echo "koneksi database gagal : ". mysqli_connect_error();

 }

 date_default_timezone_set('Asia/Jakarta');

function query ($query) {
 		global $koneksi;
 		$result = mysqli_query($koneksi, $query);
 		$rows = [];
 		while ($row = mysqli_fetch_assoc($result)) {

 			$rows[] = $row;
 		}
return $rows;
}
// encryption decryption function for cookie
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'key_one';
    $secret_iv = 'key_two';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
// encryption decryption function for cookie



/***********************************************FUNGSI BARU*********************************************/
function status_online_admin($id){
	global $koneksi;
	$besok = date('Y-m-d', strtotime("+1 days", strtotime(date("Y-m-d"))));
	$query="UPDATE user SET status_on=1 WHERE id_admin='$id'";
	mysqli_query($koneksi,$query);

}

function status_online_alt($id){
	global $koneksi;
	$besok = date('Y-m-d', strtotime("+1 days", strtotime(date("Y-m-d"))));
	$query="UPDATE alternatif SET status_on=1 WHERE id_alternatif='$id'";
	mysqli_query($koneksi,$query);

}

function status_offline_admin($id){
	global $koneksi;
	$query="UPDATE user SET status_on=0 WHERE id_admin='$id'";
	mysqli_query($koneksi,$query);
}

function status_offline_alt($id){
	global $koneksi;
	$query="UPDATE alternatif SET status_on=0 WHERE id_alternatif='$id'";
	mysqli_query($koneksi,$query);
}
/********************************************************************************************/

function tambahuser ($data) {
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$level = htmlspecialchars($data["level"]);
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
	$pjgpass=strlen($password);
			$result = mysqli_query($koneksi,"SELECT username FROM user WHERE username='$username'");
			if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('username sudah terdaftar')
							</script>";
			
		return false;
	}
	if($pjgpass <3) {
		echo "<script>
			alert('password harus lebih panjang, silahkan ulang kembali !')
			</script>";

		return false;
	} 
	if($password !== $password2) {
		echo "<script>
			alert('password tidak sesuai')
			</script>";

		return false;
	}
	if($pjgpass<3){
		echo "<script>
			alert('password harus lebih panjang')
			</script>";

		return false;
		}
		//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
		//var_dump($password); die;

	mysqli_query($koneksi,"INSERT INTO user VALUES('','$username','$password','$level')");
	return mysqli_affected_rows($koneksi);

}

function add_periode($data){
	global $koneksi;
	$awal = $_POST['tahun_awal'];
	$akhir = $_POST['tahun_akhir'];

	// cek apakah masih ada yang aktif 
	$cek = mysqli_query($koneksi, "SELECT * FROM periode WHERE status=1");
	if (mysqli_num_rows($cek)>0) {
		echo "<script>
			alert('Masih Ada Periode Yang Aktif123, Anda Tidak Dapat Menambahkan Periode Baru!!')
			window.location('web_setting.php')
			</script>";
	}else{
		// insert
		$insert = mysqli_query($koneksi, "INSERT INTO periode (tahun_awal, tahun_akhir) VALUES ('$awal', '$akhir')");
		if ($insert) {
			echo "<script>
			alert('Periode Berhasil Ditambah')
			window.location('web_setting.php')
			</script>";
		}else{
			echo "<script>
			alert('Periode Gagal Ditambah')
			window.location('web_setting.php')
			</script>";
		}
	}
}

function change_periode($data){
	global $koneksi;
	$awal = $_POST['tahun_awal'];
	$akhir = $_POST['tahun_akhir'];
	$status = $_POST['status'];
	$id = $_POST['id'];
	// cek status lama 
	$cek_lama = mysqli_query($koneksi, "SELECT status FROM periode WHERE id_periode='$id'");
	$data_lama = mysqli_fetch_array($cek_lama);
	if ($data_lama['status'] === $status) {
		
	}else{

	}
	// cek apakah masih ada yang aktif
if ($status==1) {
		$cek = mysqli_query($koneksi, "SELECT * FROM periode WHERE status=1");
	if (mysqli_num_rows($cek)==1) {
		echo "<script>
			alert('Masih Ada Periode Yang Aktif, Anda Tidak Dapat Mengubah Periode Ini!!')
			window.location('web_setting.php')
			</script>";
	}else{
		// insert
		$update = mysqli_query($koneksi, "UPDATE periode SET status=$status WHERE id_periode='$id'");
		if ($update) {
			echo "<script>
			alert('Data Periode Berhasil Diubah')
			window.location('web_setting.php')
			</script>";
		}else{
			echo "<script>
			alert('Data Periode Gagal Diubah')
			window.location('web_setting.php')
			</script>";
		}
	}
}else{
	$update = mysqli_query($koneksi, "UPDATE periode SET status=$status");
		if ($update) {
			echo "<script>
			alert('Data Periode Berhasil Diubah')
			</script>";
		}else{
			echo "<script>
			alert('Data Periode Gagal Diubah')
			window.location('web_setting.php')
			</script>";
		}
	}
}

function register ($data) {
	global $koneksi;
	$nik = stripcslashes($data["nik"]);
	$kode = stripcslashes($data["kode"]);
	$nama = strtolower(stripcslashes($data["nama"]));
	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
	$pjgpass=strlen($password);
	$pjgnik=strlen($nik);
	// cek apakah nik angka semua bukan?
	if (!filter_var($nik, FILTER_VALIDATE_INT) === TRUE) {
	// kalo bukan
		echo "<script>
		alert('NIK bukan Angka! Gagal Melakukan Pedanftaran!')
		</script>"; 
	//   kalau iya angka
	}else{
		// cek panjang nik 16digit ?
	if ($pjgnik < 16 OR $pjgnik > 16) {
		echo "<script>
		alert('Cek Kembali NIK, NIK tidak bisa Lebih Dari atau Kurang Dari 16')
		</script>"; 
	}else{
	// cek apakah nik sudah ada di database alternatif / sudah pernah daftar ?
	$ceknik = mysqli_query($koneksi, "SELECT nik FROM alternatif WHERE nik='$nik'");
	if (mysqli_num_rows($ceknik)>0) {
		echo "<script>
			alert('NIK Sudah Terdaftar, Gagal Mendaftar Akun!');
			</script>";
	}else{
			$alternatif = mysqli_query($koneksi,"SELECT username FROM alternatif WHERE username='$username'");
			if (mysqli_fetch_assoc($alternatif)) {
				echo "<script>
						alert ('username sudah terdaftar, registrasi gagal !')
							</script>";
			
		return false;
	}
	if($pjgpass <3) {
		echo "<script>
			alert('password harus lebih panjang, silahkan ulang kembali !')
			</script>";

		return false;
	} 
	if($password !== $password2) {
		echo "<script>
			alert('password tidak sesuai')
			</script>";

		return false;
	}
		//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
		// var_dump($password); die;
	// ambil periode yang aktif
	$id_p = mysqli_query($koneksi, "SELECT * FROM periode WHERE status=1");
	$data = mysqli_fetch_array($id_p);
	mysqli_query($koneksi,"INSERT INTO alternatif (id_periode, kode, nik, nama, username,password) VALUES('$data[id_periode]','$kode','$nik','$nama','$username','$password')");
	return mysqli_affected_rows($koneksi);
	}
}
}
}


function hapususer ($data){
	global $koneksi;
	$id=($data["id_admin"]);
	$query = "DELETE FROM user WHERE id_admin = $id";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows ($koneksi);
}
function hapusalternatif ($id){
	global $koneksi;
	// mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif=$id");
	// return mysqli_affected_rows ($koneksi);

	$id = htmlspecialchars($_POST["id_alternatif"]);
	$query = "DELETE FROM alternatif WHERE id_alternatif = $id";
	mysqli_query($koneksi,$query);

	$query1 = "DELETE FROM nilai_alt WHERE id_alternatif = $id";
	mysqli_query($koneksi,$query1);


	// global $koneksi;
	// mysqli_query($koneksi,"DELETE FROM alternatif WHERE id_alternatif = $id");
	// return mysqli_affected_rows ($koneksi);
}

function hapuskriteria ($id){
	global $koneksi;
	//hapus data dari tabel kriteria
	$id = htmlspecialchars($_POST["id_kriteria"]);
	$query = "DELETE FROM kriteria WHERE id_kriteria = $id";
	mysqli_query($koneksi,$query);

	//hapus record bobot kriteria
	$query1 = "DELETE FROM bobot_kriteria WHERE id_kriteria=$id";
	mysqli_query($koneksi, $query1);

	//hapus record dari tabel perhitungan1
	$query2 = "DELETE FROM perhitungan WHERE kriteria1=$id OR kriteria2=$id";
	mysqli_query($koneksi, $query2);
	$query3 = "DELETE FROM subkriteria WHERE id_kriteria=$id";
	mysqli_query($koneksi, $query3);
	$query4 = "DELETE FROM nilai_alt WHERE id_kriteria=$id";
	mysqli_query($koneksi, $query4);
}

function hapussubkriteria ($id){
	global $koneksi;
	$id = htmlspecialchars($_POST["id_subkriteria"]);
	$query = "DELETE FROM subkriteria WHERE id_subkriteria = $id";
	mysqli_query($koneksi,$query);
	$query3 = "DELETE FROM nilai_alt WHERE id_subkriteria = $id";
	mysqli_query($koneksi, $query3);
}

function hapusparameter ($id){
	global $koneksi;
	$id = htmlspecialchars($_POST["id_parameter"]);
	$query = "DELETE FROM parameter_nilai WHERE id_parameter = $id";
	mysqli_query($koneksi,$query);

}

function ubahusername ($data){
	global $koneksi;
	$id =htmlspecialchars($_POST["id_admin"]);
	$username = htmlspecialchars($_POST["username"]);
		$result = mysqli_query($koneksi,"SELECT username FROM user WHERE username='$username'");
			if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('username sudah terdaftar')
							</script>";
			
		return false;
	}
	$query = "UPDATE user SET 
				username 	 = '$username'
			WHERE id_admin = $id
			";
			mysqli_query($koneksi, $query);
			return mysqli_affected_rows($koneksi);
}

function ubahpass ($data){
	global $koneksi;
	$id=htmlspecialchars($data["id_admin"]);
	$password_lama=htmlspecialchars($data["password_lama"]);
	$password1=htmlspecialchars($data["password1"]);
	$password2=htmlspecialchars($data["password2"]);
	$pjgpass=strlen($password1);
		$result=mysqli_query($koneksi, "SELECT * FROM user WHERE id_admin='$id' ");
		if (mysqli_num_rows($result)==1) {
			$row=mysqli_fetch_assoc($result);
			if (password_verify($password_lama, $row["password"])) {
	if ($pjgpass<3){
		echo "<script>
		alert('password harus lebih dari 3 karakter')
		</script>"; return false;
	}

	if ($password1 !== $password2){
		echo "<script>
		alert('password tidak sesuai')
		</script>"; 
		return false;

	} 
	$password=password_hash($password1,PASSWORD_DEFAULT);
	mysqli_query($koneksi, "UPDATE user SET password='$password' WHERE id_admin='$id'");
	return mysqli_affected_rows($koneksi);
} else {
	echo "<script>
	alert('password lama tidak terdaftar')
	</script>";
	return false;
}
	}
		}

function ubahpass2 ($data){
	global $koneksi;
	$id=htmlspecialchars($data["id_alternatif"]);
	$username=htmlspecialchars($data["username"]);
	$password_lama=htmlspecialchars($data["password_lama"]);
	$password1=htmlspecialchars($data["password1"]);
	$password2=htmlspecialchars($data["password2"]);
	$pjgpass=strlen($password1);
		$result=mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif='$id'");
		if (mysqli_num_rows($result)==1) {
			$row=mysqli_fetch_assoc($result);
			if (password_verify($password_lama, $row["password"])) {
	if ($pjgpass<3){
		echo "<script>
		alert('password harus lebih dari 3 karakter')
		</script>"; return false;
	}

	if ($password1 !== $password2){
		echo "<script>
		alert('password tidak sesuai')
		</script>"; 
		return false;

	} 
	$password=password_hash($password1,PASSWORD_DEFAULT);
	mysqli_query($koneksi, "UPDATE alternatif SET username='$username', password='$password' WHERE id_alternatif='$id'");
	return mysqli_affected_rows($koneksi);
} else {
	echo "<script>
	alert('password lama tidak terdaftar')
	</script>";
	return false;
}
	}
		}

// function ubahpassword ($data){
// 	global $koneksi;
// 	$pass = $_POST['password1'];
// 	$password1 = password_hash($pass, PASSWORD_DEFAULT);
// 	$username = $_POST['username'];
// 	$tampil =mysqli_query($koneksi,"SELECT * FROM alternatif WHERE username='$username' AND password='$password1'");
// 	$data = mysqli_fetch_array($tampil);
// 	// jika data ditemukan
// if ($data) {
// 		$password2 = $_POST['password2'];
// 		$konfirmasi_pass = $_POST['konfirmasi_pass'];
// 			if ($password2 == $konfirmasi_pass) {
// 				//enkripsi password baru
// 				$passbaru = password_hash($konfirmasi_pass,PASSWORD_DEFAULT);
// 				$ubah = mysqli_query($koneksi, "UPDATE alternatif SET password='$passbaru' WHERE id_alternatif='$data[id_alternatif]'");
// 				if ($ubah){
// 					echo "<script>alert ('password berhasil diubah'); document.location='datadiri_alternatif.php'</script>";
// 				}
// 			}else{
// 				echo "<script>alert ('password tidak sesuai'); document.location='datadiri_alternatif.php'</script>";
// 			}

// }else{
// 	echo "<script>alert ('password lama tidak terdaftar'); document.location='datadiri_alternatif.php'</script>"; die;
// 	}

// }

function ubahlevel ($data){
	global $koneksi;
	$id = $data["id_admin"];
	$level = $data["level"];
	$query = "UPDATE user SET 
				level 	 = '$level'
			WHERE id_admin = $id
			";
			mysqli_query($koneksi, $query);
			return mysqli_affected_rows($koneksi);
}

function ubahkriteria ($data){
	global $koneksi;
	$id = $data["id_kriteria"];
	$id2 = $data["id"];
	$namakriteria = htmlspecialchars($data["nama_kriteria"]);
	$jeniskriteria = htmlspecialchars($data["jenis_kriteria"]);
	$result = mysqli_query($koneksi,"SELECT nama_kriteria FROM kriteria WHERE nama_kriteria='$namakriteria'");
		if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('nama kriteria sudah terdaftar')
							</script>";
			
		return false;
	}

	$query = "UPDATE kriteria SET
				id = '$id2', 
				nama_kriteria = '$namakriteria',
				jenis_kriteria = '$jeniskriteria'
			WHERE id_kriteria = $id
			";
			mysqli_query($koneksi, $query);
			return mysqli_affected_rows($koneksi);
}
function ubahsubkriteria ($data){
	global $koneksi;
	$id = $data["id_subkriteria"];
	$kode = htmlspecialchars($data["kode"]);
	$namasubkriteria = htmlspecialchars($data["nama_subkriteria"]);
	// $namakriteria = htmlspecialchars($data["nama_kriteria"]);
		$result = mysqli_query($koneksi,"SELECT nama_subkriteria FROM subkriteria WHERE nama_subkriteria='$namasubkriteria'");
		if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('nama subkriteria sudah terdaftar')
							</script>";
			
		return false;
	}
	$query = "UPDATE subkriteria SET
				kode = '$kode', 
				nama_subkriteria = '$namasubkriteria'
			WHERE id_subkriteria = $id
			";
			mysqli_query($koneksi, $query);
			return mysqli_affected_rows($koneksi);
}

function nambah($nama,$batas,$id_p) {
	global $koneksi;

	$tanggal = date("Y-m-d h-i-s");
	$i=1;
	echo "nilai i ".$i." batas ".$batas."<br>";
	foreach ($nama as $kunci => $val) {
		// cek sudah ada alt tersebut belum pada hasil
		// jika ada hapus, dan tambahkan ulang
		$query_cek = mysqli_query($koneksi, "SELECT * FROM hasil WHERE id_alternatif='$kunci' AND id_periode='$id_p'");
		// $hasil = mysqli_num_rows($query_cek);
		// echo 'hasilnya adalah'.$hasil; die;
		if (mysqli_num_rows($query_cek)>0) {
			// delete dulu
			$delete_alt = mysqli_query($koneksi, "DELETE FROM hasil WHERE id_alternatif='$kunci' AND id_periode='$id_p'");
		}
			if ($i<=$batas) {
				$insert=mysqli_query($koneksi, "INSERT INTO hasil (id_alternatif, id_periode,nilai,tanggal,ket) VALUES ('$kunci','$id_p','$val','$tanggal','lulus')");
			}else{
				$insert=mysqli_query($koneksi, "INSERT INTO hasil (id_alternatif, id_periode,nilai,tanggal,ket) VALUES ('$kunci','$id_p','$val','$tanggal','tidak lulus')");
			}	
		$i++;
	}
}

function tambahkriteria ($data){
	global $koneksi;

$id = htmlspecialchars($data["id"]);
$kode = htmlspecialchars($data["kode"]);
$namakriteria = htmlspecialchars($data["nama_kriteria"]);
$jeniskriteria = htmlspecialchars($data["jenis_kriteria"]);

$result = mysqli_query($koneksi,"SELECT nama_kriteria FROM kriteria WHERE nama_kriteria='$namakriteria'");
		if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('nama kriteria sudah terdaftar')
							</script>";
			
		return false;
	}

	$query = "INSERT INTO kriteria (id,kode, nama_kriteria, jenis_kriteria) VALUES 
			  ('$id','$kode','$namakriteria','$jeniskriteria')";
			  	mysqli_query($koneksi, $query);
	$kidkrt=query("SELECT*FROM kriteria ORDER by id_kriteria DESC limit 0,1")[0];
	$idk=$kidkrt['id_kriteria'];
	$result=query("SELECT*FROM alternatif");
	foreach ($result as $key) {
		$id_alternatif=$key['id_alternatif'];
		$sub=query("SELECT*FROM subkriteria ORDER by id_subkriteria DESC limit 0,1")[0];
		if ($id===2) {
			$paresin=intval($sub);
			$idsub=$paresin+1;
			mysqli_query($koneksi, "INSERT INTO nilai_alt  VALUES 
			  ('','$idk','$idsub','$id_alternatif','1')");	
		}else{
			mysqli_query($koneksi, "INSERT INTO nilai_alt  VALUES 
			  ('','$idk','0','$id_alternatif','1')");
		}
		

	}


	return mysqli_affected_rows($koneksi);
}
function tambahsubkriteria ($data){
	global $koneksi;

$id_kriteria = htmlspecialchars($data["id_kriteria"]);
$kode = htmlspecialchars($data["kode"]);
$namasubkriteria = htmlspecialchars($data["nama_subkriteria"]);

$result = mysqli_query($koneksi,"SELECT nama_subkriteria FROM subkriteria WHERE nama_subkriteria='$namasubkriteria'");
		if (mysqli_fetch_assoc($result)) {
				echo "<script>
						alert ('nama subkriteria sudah terdaftar')
							</script>";
			
		return false;
	}

	$query = "INSERT INTO subkriteria VALUES 
			  ('','$id_kriteria','$kode','$namasubkriteria')";
	mysqli_query($koneksi, $query);
	$sub=query("SELECT*FROM subkriteria ORDER by id_subkriteria DESC limit 0,1")[0];
	$idsub=$sub['id_subkriteria'];
	$query1 ="UPDATE nilai_alt SET id_subkriteria=$idsub WHERE id_kriteria=$id_kriteria";
	mysqli_query($koneksi,$query1);

	return mysqli_affected_rows($koneksi);
}

function tambahparameter ($data){
	global $koneksi;
$id_subkriteria = $data["id_subkriteria"];
$parameter = htmlspecialchars($data["parameter"]);
$nilai_parameter = htmlspecialchars($data["nilai_parameter"]);

	$query = "INSERT INTO parameter_nilai VALUES 
			  ('','$id_subkriteria','$parameter','$nilai_parameter')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function tambahnilaialt ($data){
	global $koneksi;
	$idal=$_POST['id'];
	$kriteria=query("SELECT*FROM kriteria");
	foreach ($kriteria as $key) {
		if ($key['id']==1) {
			$idk=$key['id_kriteria'];
			$xx="idx_".$idk;
			$nilai=$_POST[$xx];
			// echo $nilai;die;
			$query="INSERT INTO nilai_alt VALUES ('','$idk','0','$idal','$nilai')";
			mysqli_query($koneksi, $query);
		}else{
			$idk=$key['id_kriteria'];
			$sub=query("SELECT * FROM subkriteria WHERE id_kriteria=$idk");
			foreach ($sub as $key2) {
				$idsub=$key2['id_subkriteria'];
				$nilai=$_POST[$idsub];
				$query="INSERT INTO nilai_alt VALUES ('','$idk','$idsub','$idal','$nilai')";
			mysqli_query($koneksi, $query);
			}
		}
	}
	return mysqli_affected_rows($koneksi);	
}

function ubahnilaialt ($data){
	global $koneksi;
	$idal=$_POST['id'];
	$kriteria=query("SELECT*FROM kriteria");
	foreach ($kriteria as $key) {
		if ($key['id']==1) {
			$idk=$key['id_kriteria'];
			// $xx="idx_".$idx;
			// $nilai=$_POST[$xx];
			$nilai=$_POST[$idk];
			$query="UPDATE nilai_alt SET nilai=$nilai WHERE id_alternatif=$idal and id_kriteria=$idk";
			mysqli_query($koneksi, $query);
		}else{
			$idk=$key['id_kriteria'];
			$sub=query("SELECT * FROM subkriteria WHERE id_kriteria=$idk");
			foreach ($sub as $key2) {
				$idsub=$key2['id_subkriteria'];
				$IDD=$idsub.'sub';
				$nilai=$_POST[$IDD];
				$query="UPDATE nilai_alt SET nilai=$nilai WHERE id_alternatif=$idal and id_kriteria=$idk and id_subkriteria=$idsub";
			mysqli_query($koneksi, $query);
			}
		}
	}
	return mysqli_affected_rows($koneksi);	
}

function cari ($keyword) {
	$query = "SELECT * FROM user
	WHERE
	username LIKE '%$keyword%'
	";
	return query ($query);
}
function cari2 ($keyword){
	$query = "SELECT * FROM kriteria 
				WHERE 
				nama_kriteria LIKE '%$keyword%' OR
				kode LIKE '%$keyword%' OR
				jenis_kriteria LIKE '%$keyword%'
				";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}
function cari3 ($keyword){
	$query = "SELECT kriteria.nama_kriteria, subkriteria.nama_subkriteria, subkriteria.kode
			  FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria=kriteria.id_kriteria
			  WHERE 
				nama_subkriteria LIKE '%$keyword%' OR
				nama_kriteria 	 LIKE '%$keyword%'";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}

//cari nilai parameter kriteria
function cari4 ($keyword){
	$query = "SELECT kriteria.nama_kriteria, bobot_kriteria.nilai FROM bobot_kriteria INNER JOIN kriteria 
			  ON bobot_kriteria.id_kriteria = kriteria.id_kriteria
			  WHERE nama_kriteria LIKE '%$keyword%'";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}

function cari5 ($keyword){
	$query = "SELECT * FROM alternatif 
				WHERE 
				nama LIKE '%$keyword%' OR
				alamat LIKE '%$keyword%' OR
				tgl_lahir LIKE '%$keyword%' OR
				pendidikan_terakhir LIKE '%keyword'
				";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}

function cari_menunggu ($keyword){
	$query = "SELECT * FROM alternatif 
				WHERE status ='0'
				AND 
				(nama LIKE '%$keyword%' OR
				alamat LIKE '%$keyword%' OR
				tgl_lahir LIKE '%$keyword%' OR
				pendidikan_terakhir LIKE '%$keyword')
				";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}

function cari_blokir ($keyword){
	$query = "SELECT * FROM alternatif 
				WHERE status ='2'
				AND 
				(nama LIKE '%$keyword%' OR
				alamat LIKE '%$keyword%' OR
				tgl_lahir LIKE '%$keyword%' OR
				pendidikan_terakhir LIKE '%$keyword')
				";
	return query($query);
	//manggil func yg udh diubat, didalam func baru			
}

//memasukan nilai perbandingan kriteria
function inputnilaikriteria ($kriteria1, $kriteria2, $nilai){
	global $koneksi;

	$id_kriteria1 = getidkriteria($kriteria1);
	$id_kriteria2 = getidkriteria($kriteria2);

	$query  = "SELECT * FROM perhitungan WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "salah input nilai perbandingan kriteria";
		exit();
	}
	//jika result kosong maka masukan data baru
	//jika telah ada maka update

	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO perhitungan (kriteria1,kriteria2,nilai_perbandingan) VALUES ($id_kriteria1,$id_kriteria2,$nilai)";
	} else {
		$query = "UPDATE perhitungan SET nilai_perbandingan = $nilai WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
	}

	$result = mysqli_query($koneksi, $query);
	if (!$result) {
		echo "gagal memasukan data perbandingan";
		exit();
	}
}

//mencari id kriteria

function getidkriteria ($no_urut) {
	global $koneksi;

	$query  = "SELECT id_kriteria FROM kriteria ORDER BY id_kriteria";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id_kriteria'];
	}

	return $listID[($no_urut)];
}

//mencari nama kriteria
function getnamakriteria($no_urut){
	global $koneksi;
	$query = "SELECT nama_kriteria FROM kriteria ORDER BY id_kriteria";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$nama[] = $row['nama_kriteria'];
	}

	return $nama[($no_urut)];
}

//mencari bobot kriteria

function getbobotkriteria($id_kriteria) {
	include('kriteria.php');

	$query = "SELECT nilai FROM bobot_kriteria WHERE id_kriteria=$id_kriteria ";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$bbt = $row['nilai'];
	}
	return $bbt;
}

// mencari jumlah kriteria
function getjmlkriteria () {
	global $koneksi;
	$query = "SELECT count(*) FROM kriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}

//mencari nilai perbandingan kriteria

function getnilaikriteria($kriteria1, $kriteria2) {
	global $koneksi;

	$id_kriteria1 = getidkriteria($kriteria1);
	$id_kriteria2 = getidkriteria($kriteria2);

	$query  = "SELECT nilai_perbandingan FROM perhitungan WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "salah get nilai perbandingan kriteria";
		exit();
	}

	if (mysqli_num_rows($result)==0) {
		$nilai = 1;
	}else{
		while ($row = mysqli_fetch_array($result)) {
			$nilai  = $row['nilai_perbandingan'];
		}
	}

	return $nilai;
}
// memasukkan nilai priority vektor kriteria
function inputbobotkriteria ($id_kriteria,$bbt) {
	global $koneksi;

	$query = "SELECT * FROM bobot_kriteria WHERE id_kriteria=$id_kriteria";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO bobot_kriteria (id_kriteria, nilai) VALUES ($id_kriteria, $bbt)";
	} else {
		$query = "UPDATE bobot_kriteria SET nilai=$bbt WHERE id_kriteria=$id_kriteria";
	}


	$result = mysqli_query($koneksi, $query);
	if(!$result) {
		echo "Gagal memasukkan / update nilai priority vector kriteria";
		exit();
	}

}

function getnilaiIR ($jmlkriteria) {
	global $koneksi;
	$query = "SELECT nilai FROM nilai_ir WHERE jumlah=$jmlkriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$nilaiir = $row['nilai'];
	}
	return $nilaiir;
}

//mencari lamda maks

function getlamda($matrik_a,$matrik_b,$n) {
	$lamda = 0;
	for ($i=0; $i <= ($n-1); $i++) {
		$lamda += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
	}

	return $lamda;
}

//mencari konsistensi index

function getkonsindex ($matrik_a,$matrik_b,$n) {
	$lamda = getlamda($matrik_a,$matrik_b,$n);
	$konsistensiindex = ($lamda - $n)/($n-1);

	return $konsistensiindex;
}

//mencari konsistensi ratio

function getkonsratio ($matrik_a,$matrik_b,$n) {
	$konsistensiindex = getkonsindex($matrik_a,$matrik_b,$n);
	$konsistensiratio = $konsistensiindex / getnilaiIR($n);

	return $konsistensiratio;
}

//menampilkan tabel perbandingan 
function showtabelperbandingan ($jenis, $kriteria) {
	global $koneksi;

	$n = getjmlkriteria();

	$nilaiir = query("SELECT * FROM nilai_ir WHERE id=1");
	$query = "SELECT nama_kriteria FROM $kriteria ORDER BY id_kriteria";
	$result = mysqli_query($koneksi, $query);
		if (!$result){
			echo"koneksi database error";
		exit();
	}

	//buat list pilihan
	while ($row = mysqli_fetch_array($result)) {
		$pilihan[] = $row ['nama_kriteria'];
	}
	//tampilkan tabel
	?>
<form class="ui form" action="perhitungan1.php" method="post">
	<!-- <div class="card-body">
		<div class="card shadow">
      		<div class="card-header py-3">
       			 <h2 class="m-0 font-weight-bold text-secondary">Perhitungan AHP</h2>
     		</div>
		 		<div class="table-responsive">
					<table class="table table-stripped">
			<thead class="table-dark">
				<tr>
					<th class="text-sm-center" colspan="2"> Pilih Kriteria Yang Lebih Penting</th>
					<th class="text-sm-center">Nilai Perbandingan</th>
				</tr>
			</thead>
		<tbody> -->
<div class="card-body">
	<div class="card card-header py-1">
		<h3>Tabel Nilai Index ratio</h3>
			</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="table-dark" style="background-color: #548176">
				<tr>
					<!-- <th class="text-center">No</th> -->
					<th class="text-center">Nilai Perbandingan</th>
					<th class="text-center">Nilai IR</th>
					<th class="text-center">Keterangan</th>
				</tr>
			</thead>
			<?php foreach ($nilaiir as $rows) : ?>
				<tr>
					<td class="text-center"><?= $rows["jumlah"];?></td>
					<td class="text-center"><?= $rows["nilai"];?></td>
					<td class="text-center"><?= $rows["keterangan"];?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br>	
	</div>

	<h3>Tabel Perbandingan Berpasangan</h3>
     	<div class="table-responsive">
            <table class="table table-striped"  width="100%" cellspacing="0">
              	<thead class="table-dark" style="background-color: #548176">
               		<tr>
               			<th class="text-sm-center" colspan="2" >Pilih yang lebih penting</th>
               			<th class="text-sm-center" >Nilai perbandingan</th>
               		</tr>
               	</thead>
			<tbody>
		<?php
	//inisialisasi
	$urut = 0;
	for ($x=0; $x <= ($n-2); $x++){
		for ($y=($x+1); $y <= ($n-1); $y++) { 
			$urut++;
	?>
		<tr>				
			<td>
				<div class="field">
					<div class="ui radio checkbox" >
						<input name="pilih<?php echo $urut?>" value="1" class="hidden align-middle" type="radio" checked>
							<label><?php echo $pilihan[$x]; ?></label>
						</div>
					</div>
					<!-- <div class="form-check-inline">
						<input type="radio" class="form-check-input" name="pilih <?php echo $urut?>" value="1" >
						<label><?php echo $pilihan[$x]; ?></label>	
					</div> -->
					<!-- <div class="field">
						<div class="ui radio checkbox">
							<input name="pilih <?php echo $urut?>" value="1" class="hidden" type="radio">
							<label><?php echo $pilihan[$x]; ?></label>			
						</div>
					</div> -->
				</td>
			<td>
				<div class="field">
					<div class="ui radio checkbox">
						<input name="pilih<?php echo $urut?>" value="2" class="hidden align-middle" type="radio">
							<label><?php echo $pilihan[$y]; ?></label>
						</div>
					</div>
					<!-- <div class="form-check-inline">
						<input name="pilih <?php echo $urut?>" value="2" class="form-check-input" type="radio">
						<label><?php echo $pilihan[$y]; ?></label>
					</div> -->
				</td>
			<td>
				<div class="field">
					
					<?php
						$nilai = getnilaikriteria($x,$y);
					?>
						<input class="form-control" type="text" name="bobot<?php echo $urut?>" value="<?php echo $nilai?>" required>
							<!-- <div class="">
										<select class="form-control" name="bobot<?php echo $urut?>" 
												id="exampleFormControlSelect1">
											<option value="1">1 : Sama Penting</option>
											<option value="2">2 : Nilai Tengah</option>
											<option value="3">3 : Sedikit Lebih Penting</option>
											<option value="4">4 : Nilai Tengah</option>
											<option value="5">5 : Lebih Penting</option>
											<option value="6">6 : Nilai Tengah</option>
											<option value="7">7 : Sangat Penting</option>
											<option value="8">8 : Nilai Tengah</option>
											<option value="9">9 : Mutlak Lebih Penting</option>
										</select>
									</div> -->
					</div>
				</td>
			</tr>
		<?php
	}
}
	?>
		</tbody>
			</table>
				<input type="text" name="jenis" value="<?php echo $jenis; ?>" hidden>
					<button class="btn btn-info float-right" type="submit" name="submit" value="submit">Hitung</button>
	<!-- <input class="ui submit button" type="submit" name="submit" value="submit">	 -->
				</div>
			</div>
		</div>
	</form>
<?php
}

?>













