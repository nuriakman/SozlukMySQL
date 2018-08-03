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

?>
<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <title>İsimler Sözlüğü!</title>
  </head>
  <body>

    <!-- Nav Bar -->
    <!-- Nav Bar -->
    <!-- Nav Bar -->
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">İsimlerSözlüğü</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Ana Sayfa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="hakkinda.php">Hakkında...</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="İsim ara..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">BUL</button>
          </form>
        </div>
      </nav>
     </div>
     <!-- /Nav Bar -->
     <!-- /Nav Bar -->
     <!-- /Nav Bar -->


     <!-- Harfleri Listele -->
     <!-- Harfleri Listele -->
     <!-- Harfleri Listele -->
     <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <?php
              $SQL = "SELECT DISTINCT SUBSTR(isim, 1, 1) as HARF FROM sozluk ORDER BY HARF";
              $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
              $RowCount = mysqli_num_rows($rows); // Cevabın kaç satırı olduğunu öğren

              $c=0;
              $OrtaNokta = round($RowCount / 2);
              while($row = mysqli_fetch_assoc($rows)){
                extract($row);
                echo "<a class='btn btn-primary btn-lg mb-2 mr-1' href='index.php?harf=$HARF'>$HARF</a>";
                $c++;
                if( $c == $OrtaNokta ) echo "<br><br>";
              } // while

            ?>
          </div>
       </div>
     </div>
     <!-- /Harfleri Listele -->
     <!-- /Harfleri Listele -->
     <!-- /Harfleri Listele -->


     <!-- O Harf İle Başlayan İsimleri Listele -->
     <!-- O Harf İle Başlayan İsimleri Listele -->
     <!-- O Harf İle Başlayan İsimleri Listele -->
     <div class="container">
       <div class="row mt-5">
         <?php
           $ArananHarf=$_GET["harf"];
           $SQL = "SELECT id, isim FROM sozluk WHERE substr(isim, 1, 1) = '$ArananHarf' ORDER BY isim";
           $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
           $RowCount = mysqli_num_rows($rows); // Cevabın kaç satırı olduğunu öğren

           while($row = mysqli_fetch_assoc($rows)){
             extract($row);
             echo "
                  <div class='col-md-2 mb-2'>
                    <a class='btn btn-success btn-block' href='index.php?isimID=$id'>$isim</a>
                  </div>
                  ";
            } // while
          ?>
        </div>
      </div>
      <!-- /O Harf İle Başlayan İsimleri Listele -->
      <!-- /O Harf İle Başlayan İsimleri Listele -->
      <!-- /O Harf İle Başlayan İsimleri Listele -->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
