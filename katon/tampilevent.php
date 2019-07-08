<?php

require_once 'koneksi.php';

$sql = "SELECT events.id_organizer, events.nama_event, events.deskripsi, events.id_campus, events.kategori_event, events.banner, events.tgl_mulai, events.waktu_mulai, events.penyelenggara,tickets.id, tickets.harga, tickets.jumlah, campuses.nama_kampus, campuses.alamat, campuses.latitude, campuses.longitude, organizers.email FROM events JOIN tickets JOIN campuses JOIN organizers on events.id=tickets.id_event AND events.id_organizer=organizers.id AND events.id_campus=campuses.id  order by events.id asc" ;

$result = array();
$r = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($r)) {

	array_push($result, array(
		"id_organizer" => $row['id_organizer'],
		"nama_event" => $row['nama_event'],
		"deskripsi" => $row['deskripsi'],
		"id_campus" => $row['id_campus'],
		"kategori_event" => $row['kategori_event'],
		"banner" => $row['banner'],
		"tgl_mulai" => $row['tgl_mulai'],
		"waktu_mulai" => $row['waktu_mulai'],
		"penyelenggara" => $row['penyelenggara'],
		"id_tiket" => $row['id'],
		"harga" => $row['harga'],
		"jumlah" => $row['jumlah'],
		"nama_kampus" => $row['nama_kampus'],
		"alamat" => $row['alamat'],
		"latitude" => $row['latitude'],
		"longitude" => $row['longitude'],
		"email" => $row['email']
		

	));

}

echo json_encode(array('result' => $result));
mysqli_close($con);


?> 