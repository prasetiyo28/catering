<?php
/* ===== www.dedykuncoro.com ===== */
	/* ========= KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI DI UNREMARK ======== */
	include_once "koneksi.php";

	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$no_hp = $_POST['no_hp'];
	
	
	if ((empty($id))) {
		echo "Id  kosong";	
	}else {	$query = mysqli_query($con, "UPDATE users_table SET name = '$name',email='$email',no_hp='$no_hp' WHERE id = '$id'");
				
				if ($query){
					echo "Edit Profile berhasil.";

				} else {
					echo "QueryError";
				}
			} 

	mysqli_close($con);

?>