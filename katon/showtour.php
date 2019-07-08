<?php
   
    include_once('koneksi.php'); //koneksi database
 
    // query the application data
$sql = "SELECT id_tour, nama_tour, tipe_tour, slot_max, slot_terisi FROM turnamen ORDER By id_tour";
$result = mysqli_query($con, $sql);
 
// an array to save the application data
$rows = array();
 
// iterate to query result and add every rows into array
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $rows[] = $row; 
}
 
 
// echo the application data in json format
echo json_encode($rows);
?>