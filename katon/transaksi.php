<?php

include_once "koneksi.php";

$id = $_POST['id'];
$id_mitra = $_POST['id_mitra'];
$id_paket = $_POST['id_paket'];
$jml_pesan = $_POST['jml_pesan'];
$alamat_pesan = $_POST['alamat_pesan'];
$tgl_pesan = $_POST['tgl_pesan'];
$jam_pesan = $_POST['jam_pesan'];

if ((empty($jml_pesan))) {
	echo "Masukkan Jumlah Pesanan ";
}else if ((empty($alamat_pesan))) {
	echo "Masukkan Alamat Pengiriman";
}else if ((empty($tgl_pesan))) {
	echo "Masukkan Tanggal Pengiriman";
}else if ((empty($jam_pesan))) {
	echo "Masukkan Waktu Pengiriman";
} else {
	$query = mysqli_query($con, "INSERT INTO pesan (id_order, id, id_mitra, id_paket, jml_pesan, alamat_pesan, tgl_pesan, jam_pesan) VALUES(0, '$id', '$id_mitra', '$id_paket', '$jml_pesan', '$alamat_pesan', '$tgl_pesan', '$jam_pesan') ");

	if($query){
		echo "Pesan Paket Berhasil, Check your notif";
	}else {
		echo "gagal";
	}
}

mysqli_close($con);

?>