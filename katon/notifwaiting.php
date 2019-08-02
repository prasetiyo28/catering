<?php

require_once 'koneksi.php';
	

	$id = $_GET['id'];	
	$sql = "SELECT pesan.id_order, pesan.id_mitra, pesan.id_paket, pesan.jml_pesan, pesan.alamat_pesan, pesan.tgl_pesan, pesan.jam_pesan, pesan.tgl_transaksi, pesan.bukti_bayar, pesan.verifikasi, mitra.nama_mitra, mitra.no_telp, mitra.nama_bank, mitra.nomor_rekening, mitra.nama_akun_bank, paket.nama_paket, paket.deskripsi, paket.harga, paket.foto FROM pesan JOIN mitra JOIN paket on pesan.id_paket=paket.id_paket AND pesan.id_mitra=mitra.id_mitra WHERE pesan.id= '$id' AND (pesan.verifikasi='1' OR pesan.verifikasi='0') order by tgl_transaksi desc " ;

	$result = array();
	$r = mysqli_query($con,$sql);

	while ($row = mysqli_fetch_array($r)) {
		
		array_push($result, array(
				"id_order" => $row['id_order'],
				"id_mitra" => $row['id_mitra'],
				"id_paket" => $row['id_paket'],
				"jml_pesan" => $row['jml_pesan'],
				"alamat_pesan" => $row['alamat_pesan'],
				"tgl_pesan" => $row['tgl_pesan'],
				"jam_pesan" => $row['jam_pesan'],
				"tgl_transaksi" => $row['tgl_transaksi'],
				"bukti_bayar" => $row['bukti_bayar'],
				"verifikasi" => $row['verifikasi'],
				"nama_mitra" => $row['nama_mitra'],
				"no_telp" => $row['no_telp'],
				"nama_bank" => $row['nama_bank'],
				"nomor_rekening" => $row['nomor_rekening'],
				"nama_akun_bank" => $row['nama_akun_bank'],
				"nama_paket" => $row['nama_paket'],
				"deskripsi" => $row['deskripsi'],
				"harga" => $row['harga'],
				"foto" => $row['foto']
			));

	}
	
	echo json_encode(array('result' => $result));
	mysqli_close($con);


?> 