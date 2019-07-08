<?php

require_once 'koneksi.php';

$id_mitra = $_GET['id_mitra'];

$sql = "SELECT mitra.id_mitra, paket.id_paket, paket.nama_paket, paket.deskripsi, paket.harga, paket.foto FROM paket JOIN mitra on paket.id_mitra=mitra.id_mitra wHERE paket.id_mitra='$id_mitra' " ;

$result = array();
$r = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($r)) {

	array_push($result, array(
		"id_paket" => $row['id_paket'],
		"nama_paket" => $row['nama_paket'],
		"deskripsi" => $row['deskripsi'],
		"harga" => $row['harga'],
		"foto" => $row['foto']

	));

}

echo json_encode(array('result' => $result));
mysqli_close($con);

?>