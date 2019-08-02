<?php
	/* ===== www.dedykuncoro.com ===== */

	// =================== KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI RI UNREMARK ========
	include_once "koneksi.php";

	class usr{}
	
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	if ((empty($email)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}
	
	$query = mysqli_query($con, "SELECT * FROM users_table WHERE email='$email' AND password='$password' AND verifikasi=1");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
		$response = new usr();
		$response->success = 1;
		$response->message = "Selamat datang ".$row['name'];
		$response->id = $row['id'];
		$response->email = $row['email'];
		$response->name = $row['name'];
		$response->no_hp = $row['no_hp'];

		die(json_encode($response));
		
	} else { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Periksa Kembali Email atau Password Anda";
		die(json_encode($response));
	}
	
	mysqli_close($con);

?>