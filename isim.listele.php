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

$aranan = $_GET["aranan"];
$SQL      = "SELECT id, isim, anlam FROM sozluk WHERE isim LIKE '$aranan%' ";
$rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR

echo "
<div class='col-md-12'>
  <H1>Arama Sonucu</H1>
</div>
";

while($row = mysqli_fetch_assoc($rows)){
  extract($row);
    echo "
    <div class='col-md-2 mb-2'>
      <a class='btn btn-success btn-block' href='#' onclick='AnlamGetir($id)'>$isim</a>
    </div>
    ";
} // while

?>
