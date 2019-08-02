<?php
/* ===== www.dedykuncoro.com ===== */
	/* ========= KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI DI UNREMARK ======== */
	include_once "koneksi.php";

	class usr{}

	$name = $_POST["name"];
	$email = $_POST["email"];
	$no_hp = $_POST["no_hp"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];

	if ((empty($name))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom name tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($email))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom email tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($no_hp))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom no_hp tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($password))) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom password tidak boleh kosong";
		die(json_encode($response));
	} else if ((empty($confirm_password)) || $password != $confirm_password) {
		$response = new usr();
		$response->success = 0;
		$response->message = "Konfirmasi password tidak sama";
		die(json_encode($response));
	} else {
		if (!empty($email) && $password == $confirm_password){
			$num_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users_table WHERE email='".$email."'"));

			if ($num_rows == 0){
				$query = mysqli_query($con, "INSERT INTO users_table (id, name, email, no_hp, password) VALUES(0,'".$name."', '".$email."', '".$no_hp."','".$password."')");

				if ($query){
					// $response = new usr();
					// $response->success = 1;
					// $response->message = "Register berhasil, silahkan verifikasi.";

					require 'PHPMailer/PHPMailerAutoload.php';
					$mail = new PHPMailer;

// Konfigurasi SMTP
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'onlinecatering25@gmail.com';
				$mail->Password = '12345sasa';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;

				$mail->setFrom('varif@onlinecatering.com', 'CateringOnline');
				$mail->addReplyTo('verif@onlinecatering.com', 'CateringOnline');

// Menambahkan penerima
				$mail->addAddress($email);

// Subjek email
				$mail->Subject = 'Verifikasi Akun Online Catering';

// Mengatur format email ke HTML
				$mail->isHTML(true);

// Konten/isi email
				$mailContent = "<h1>Verifikasi Akun</h1>
				<p>Untuk verifikasi akun silhkan klik link di bawah</p><br/>
				<a href='http://192.168.100.8/catering/katon/verifikasi.php?email=".$email."'>verifikasi</a>";


				$mail->Body = $mailContent;

// Kirim email
				if(!$mail->send()){
					echo 'Pesan tidak dapat dikirim.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}else{
					echo 'Register Berhasil, Silahkan Verifikasi';
				}

				// echo json_encode($response);

			} else {
				// $response = new usr();
				// $response->success = 0;
				echo "Register Gagal";
				// die(json_encode($response));
			}
		} else {
			// $response = new usr();
			// $response->success = 0;
			echo "email sudah ada";
			// die(json_encode($response));
		}
		
	}
}


mysqli_close($con);

?>	