<?php  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$id_order = $_POST['id_order'];

	$sql = "UPDATE pesan SET verifikasi = '3' WHERE id_order = '$id_order';";

	require_once('koneksi.php');

	if (mysqli_query($con,$sql)) {
		echo "Berhasil";
	}else{
		echo mysqli_error();
	}

	mysqli_close($con);
}
?>