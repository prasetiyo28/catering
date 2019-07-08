<?php

include_once "koneksi.php";

$id = $_POST['id'];
$id_mitra = $_POST['id_mitra'];
$id_paket = $_POST['id_paket'];
$jml_pesan = $_POST['jml_pesan'];
$tgl_pesan = $_POST['tgl_pesan'];
$id_mitra = $_POST['id_mitra'];
$jam_pesan = $_POST['jam_pesan'];

if ((empty($jml_pesan))) {
	echo "Masukkan Jumlah Pesanan ";
}else {
	$query = mysqli_query($con, "INSERT INTO pesan (id_order, id, id_mitra, id_paket, jml_pesan, tgl_pesan, jam_pesan) VALUES(0, '$id', '$id_mitra', '$id_paket', '$jml_pesan', '$tgl_pesan', '$jam_pesan') ");

	if($query){
		echo "Pesan Paket Berhasil, Check your notif";
	}else {
		echo "gagal";
	}
}

mysqli_close($con);

?>