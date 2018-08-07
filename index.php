<?php
  require("inc_config.php");
?>
<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <title>İsimler Sözlüğü!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- SweetAlert -->
    <script src="bootstrap/js/sweetalert.min.js"></script>

    <script>
      function AnlamGetir(id) {
          $.ajax({
              type: 'GET',
              url: 'isim.bilgi.php',
              data: { id: id },
              dataType: 'json',
              success: function (ajaxCevap) {
              //  swal(ajaxCevap.isim, ajaxCevap.anlam, "success"  );
                swal({
                  title: ajaxCevap.isim,
                  text: ajaxCevap.anlam,
                  icon: ajaxCevap.icon,
                  button: "Tamam",
                });
              }
          });
      }

      function IsimlerdeAra() {
        $.ajax({
            type: 'GET',
            url: 'isim.listele.php',
            data: { aranan: $("#Aranan").val() },
            dataType: 'html',
            success: function (ajaxCevap) {
              if(ajaxCevap != "") {
                $("#ISIM_LISTELE").hide();
                $("#ARAMA_SONUCU_LISTELE").show();
                $("#SonucAlani").html(ajaxCevap);
              } else {
                $("#ISIM_LISTELE").show();
                $("#ARAMA_SONUCU_LISTELE").hide();
              }
            }
        });
      }
    </script>

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
              <a class="nav-link" href="hakkinda.php" data-toggle="modal" data-target="#exampleModal">Hakkında...</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input id='Aranan' onkeyup='IsimlerdeAra()' class="form-control mr-sm-2" type="search" placeholder="İsim ara..." aria-label="Search">
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
          <div class="col-md-12 text-center">
            <?php
              $SQL = "SELECT DISTINCT SUBSTR(isim, 1, 1) as HARF FROM sozluk ORDER BY HARF";
              $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
              $RowCount = mysqli_num_rows($rows); // Cevabın kaç satırı olduğunu öğren

              $c=0;
              $OrtaNokta = round($RowCount / 2);
              while($row = mysqli_fetch_assoc($rows)){
                extract($row);
                echo "<a class='btn btn-outline-danger btn-lg mb-2 mr-1' style='width:50px;' href='index.php?harf=$HARF'>$HARF</a>\n";
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
     <div class="container" id='ISIM_LISTELE'>
       <div class="row mt-5">
         <?php
           $ArananHarf=$_GET["harf"];
           // $SQL = "SELECT id, isim, anlam FROM sozluk WHERE substr(isim, 1, 1) = '$ArananHarf' ORDER BY isim";
           $SQL = "SELECT id, isim, anlam FROM sozluk WHERE isim LIKE '$ArananHarf%' ORDER BY isim";
           $rows     = mysqli_query($cnnMySQL, $SQL); // SORGUYU ÇALIŞTIR ve SONUCUNU GETİR
           $RowCount = mysqli_num_rows($rows); // Cevabın kaç satırı olduğunu öğren

           while($row = mysqli_fetch_assoc($rows)){
             extract($row);
             $Cinsiyet = "warning";
             if( strpos($anlam, " Er.") > 0 ) $Cinsiyet = "success";
             if( strpos($anlam, " Ka.") > 0 ) $Cinsiyet = "info";
             echo "<div class='col-md-2 mb-2'>
                     <button class='btn btn-$Cinsiyet btn-block' href='#' onclick='AnlamGetir($id)'>$isim</button>
                   </div> ";
            } // while
          ?>
        </div>
      </div>
      <!-- /O Harf İle Başlayan İsimleri Listele -->
      <!-- /O Harf İle Başlayan İsimleri Listele -->
      <!-- /O Harf İle Başlayan İsimleri Listele -->


      <div class="container" id='ARAMA_SONUCU_LISTELE' style="display:none;">
        <div class="row mt-5"  id='SonucAlani'>
        </div>
      </div>




        <!-- Modal -->
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hakkında</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                2018 Linux Yaz Kampı Php ile Web Programlama dersi sırasında örnek proje olarak yapılmıştır.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /MODAL -->
        <!-- /MODAL -->
        <!-- /MODAL -->

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/jquery.min.js"></script>
  </body>
</html>
