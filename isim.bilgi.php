<?php
## Veritabanına bağlantı kuralım...
## Veritabanına bağlantı kuralım...
$host     = "localhost";
$user     = "root";
$password = "1234";
$database = "sairler_db";
$cnnMySQL = mysqli_connect( $host, $user, $password, $database );
if( mysqli_connect_error() ) die("Veritabanına bağlanılamadı...");
mysqli_set_charset($cnnMySQL, "utf8");

$id = $_GET["id"];
$SQL      = "SELECT id, isim, anlam FROM sozluk WHERE id = '$id' ";
$rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
$row      = mysqli_fetch_assoc($rows); // SADECE 1 SATIR GETİR!!!

echo json_encode($row);

?>
