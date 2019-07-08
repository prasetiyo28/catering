<?php
include_once "koneksi.php";

class emp{}

$banner = $_POST['banner'];
$id_order = $_GET['id_order'];


if (empty($id_order)) { 
	$response = new emp();
	$response->success = 0;
	$response->message = "Please dont empty Name."; 
	die(json_encode($response));
} else {
	$random = random_word(20);

	$path = "struk/".$random.".png";
	$banners = "".$random.".png";

		// sesuiakan ip address laptop/pc atau URL server
	$actualpath = "http://192.168.100.3/katon/$path";

	$query = mysqli_query($con, "UPDATE pesan SET bukti_bayar='$banners',verifikasi='1' where id_order='$id_order' ");

	if ($query){
		file_put_contents($path,base64_decode($banner));

		$response = new emp();
		$response->success = 1;
		$response->message = "Successfully Uploaded";
		die(json_encode($response));
	} else{ 
		$response = new emp();
		$response->success = 0;
		$response->message = "Error Upload image";
		die(json_encode($response)); 
	}
}	

	// fungsi random string pada gambar untuk menghindari nama file yang sama
function random_word($id = 20){
	$pool = '1234567890abcdefghijkmnpqrstuvwxyz';

	$word = '';
	for ($i = 0; $i < $id; $i++){
		$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	}
	return $word; 
}

mysqli_close($con);

?>	