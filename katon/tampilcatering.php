<?php

require_once 'koneksi.php';

$sql = "SELECT * FROM mitra WHERE verif = 1" ;

$result = array();
$r = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($r)) {

	array_push($result, array(
		"id_mitra" => $row['id_mitra'],
		"nama_mitra" => $row['nama_mitra'],
		"alamat" => $row['alamat'],
		"no_telp" => $row['no_telp'],
		"nama_pemilik" => $row['nama_pemilik'],
		"nama_bank" => $row['nama_bank'],
		"nomor_rekening" => $row['nomor_rekening'],
		"nama_akun_bank" => $row['nama_akun_bank'],
		"image" => $row['image'],
		"latitude" => $row['latitude'],
		"longitude" => $row['longitude']
		// "id_paket" => $row['id_paket'],
		// "nama_paket" => $row['nama_paket'],
		// "deskripsi" => $row['deskripsi'],
		// "harga" => $row['harga'],
		// "foto" => $row['foto']

	));

}

echo json_encode(array('result' => $result));
mysqli_close($con);


?> 