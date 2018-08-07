<?php
  require("inc_config.php");

  $id = $_GET["id"];
  $SQL      = "SELECT id, isim, anlam FROM sozluk WHERE id = '$id' ";
  $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
  $row      = mysqli_fetch_assoc($rows); // SADECE 1 SATIR GETİR!!!
  extract($row);

  $ICON = "img/uniseks.png";
  if( strpos($anlam, "Er.") > 0 ) $ICON = "img/erkek.gif";
  if( strpos($anlam, "Ka.") > 0 ) $ICON = "img/kiz.gif";

  $row["icon"] = $ICON;
  $row["renk"] = "kırmızı";
  echo json_encode($row);

?>
