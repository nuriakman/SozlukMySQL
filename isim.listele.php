<?php
  require("inc_config.php");

  $aranan   = $_GET["aranan"];
  $SQL      = "SELECT id, isim, anlam FROM sozluk WHERE isim LIKE '$aranan%' ";
  $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR

  echo "
  <div class='col-md-12'>
    <H1>Arama Sonucu</H1>
  </div>
  ";

  while($row = mysqli_fetch_assoc($rows)){
    extract($row);
    $Cinsiyet = "warning";
    if( strpos($anlam, " Er.") > 0 ) $Cinsiyet = "success";
    if( strpos($anlam, " Ka.") > 0 ) $Cinsiyet = "info";
      echo "
      <div class='col-md-2 mb-2'>
        <button class='btn btn-$Cinsiyet btn-block' href='#' onclick='AnlamGetir($id)'>$isim</button>
      </div>
      ";
  } // while




?>
