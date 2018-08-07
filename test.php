<?php

  $bilgiler = array();
  $bilgiler["UrunKodu"] = "A56Y777";
  $bilgiler["UrunAdi"]  = "Arçelik 45Ekran TV";
  $bilgiler["UrunFiyati"]  = 3400;

  echo "<pre>";
  print_r($bilgiler);


  echo $bilgiler["UrunAdi"];
 echo "<hr>";
 echo json_encode($bilgiler);


 ?>
