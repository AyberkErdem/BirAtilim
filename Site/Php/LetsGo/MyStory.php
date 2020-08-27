<?php
include('config.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
        type = "image/x-icon">
  <meta name="description" content="Bir Atilim">
  <meta name="author" content="Ayberk Erdem">
  <meta name="keywords" content="Bir atilim,Ayberk Erdem">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../css/Home.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>BirAtilim</title>

  </head>
  <body>
    <nav style="background-color:#88001b;" class="navbar navbar-expand-lg navbar-light ">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
                <img title="Bir Atilim" src="../Img/left.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php">
                <img title="Bir Atilim" src="../Img/home.png" alt="Logo">
            </a>
            <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="#">
                <img  src="../Img/home.png" alt="logo">
            </a>
            <div class="w-100 text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
            <ul class="navbar-nav ml-auto flex-nowrap">
                <li class="nav-item">
                    <a href="YeniIlan.php" class="nav-link m-2 btn btn-warning nav-active">İlan Oluştur</a>
                </li>
                <li class="nav-item">
                  <?php
                  require_once('config.php');
                    $sql1 = "call DoIHave('".$_SESSION['user'] ."')";
                      $result=@mysqli_query($dbc,$sql1);
                        if ($result->num_rows > 0) {
                          $row=$result->fetch_assoc();
                          if($row['res']!=0)
                            echo "<a href='Mesajlar.php' class='nav-link m-2 btn btn-warning'>Mesajınız Var</a>
                            <script> var notification = new Notification('Mesajınız var canim', {icon:'../Img/logo.png'});</script>";


                        }
                        mysqli_free_result($result);
                      $dbc->next_result();
                          ?>

                </li>

                <li class="nav-item">

                    <button onclick="myFunction()" class="nav-link m-2 dropbtn btn btn-warning">Kişisel Şeyler</button>
                    <div id="myDropdown" class="dropdown-content">
                      <a class="bg-warning text-muted" href="ilanlarım.php">İlanlarım</a>
                      <a class="bg-warning text-muted" onclick="Fav()">Favorilerim</a>
                          <a class="bg-warning text-muted" href="Mesajlar.php">Mesajlarım</a>
                                  <a class="bg-warning text-muted" href="MyStory.php">Alışverişlerim</a>
                      <a class="bg-warning text-muted" href="MyPage.php">Ayarlarım</a>

    </div>

                </li>
                <li class="nav-item">
                    <a href="BizeYazın.php" class="nav-link m-2 btn btn-warning">Bize Yazın</a>
                </li>
            </ul>
        </div>
        <form class="navbar-form"  method="post">
      <div class="input-group">
          <input type="text" class="form-control" placeholder="İlan ara(Id veya Tür araması)" name="search">
          <div class="input-group-btn">
              <input type="submit" name='Ara' value="Ara" class="glyphicon glyphicon-search btn btn-primary">

          </div>
      </div>

      </form>
    </nav>
    <div class="text-center">
    <div id="choose-form" style="text-align:right" class="btn-group"  aria-label="Basic example">
    <button value="Aldıklarım" onclick="f1(this)"  type="button" class="btn btn-primary">Alışlarım</button>
    <button value="Sattıklarım" onclick="f1(this)" type="button" class="btn btn-danger">Sotoşlorom</button>
  </div>
  </div>
    <div id='Aldıklarım' class="">


    <table class="table table-hover">
    <tr>
    <th>İlan Sahibi</th>
    <th>Resim</th>
    <th>Açıklama</th>
    <th>Adres</th>
    <th>Değerlendirin</th>

    </tr>
      <?php require_once('config.php');

      $sql = "select * from test.old_poster_data where Poster_Id in(select PosterId from test.receipt where Buyer='".$_SESSION['user']."') ";
        $result=@mysqli_query($dbc,$sql);
          if ($result->num_rows > 0) {
            while($row=$result->fetch_assoc())
            {?><tr title='İlana Git' ondblclick='fotaryus(<?php echo $row['Poster_Id']; ?>)'>
              <?php
                echo "<td>".$row['UserName']."</td>
                <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
                <td>".$row['Description']."</td>
                <td>".$row['adress']."</td><td><button ";if($row['Already']==0){ echo "onclick='rater(".$row['Poster_Id'].")'" ;}echo "  class='btn btn-warning' type='button' name='button'>Değerlendir</button></td>";
                  ?></tr><?php
            }
          }
          else
          {
              echo mysqli_error($dbc);
            echo"Nothing new here...";
          }
       ?>
    </table>
    <?php

     ?>
     </div>
     <div id='Sattıklarım' class="">


     <table class="table table-hover">
     <tr>
     <th>İlan Sahibi</th>
     <th>Resim</th>
     <th>Açıklama</th>
     <th>Adres</th>
     <th>Fatura</th>

     </tr>
       <?php require_once('config.php');

       $sql = "select * from test.old_poster_data where UserName='".$_SESSION['user']."'";
         $result=@mysqli_query($dbc,$sql);
           if ($result->num_rows > 0) {
             while($row=$result->fetch_assoc())
             {?><tr title='İlana Git' ondblclick='fotaryus(<?php echo $row['Poster_Id']; ?>)'>
               <?php
                 echo "<td>".$row['UserName']."</td>
                 <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
                 <td>".$row['Description']."</td>
                 <td>".$row['adress']."</td><td><button onclick='fotaryus(".$row['Poster_Id'].")' class='btn btn-warning' type='button' name='button'>Fatura Bilgisi</button></td>";
                   ?></tr><?php
             }
           }
           else
           {
               echo mysqli_error($dbc);
             echo"Nothing new here...";
           }
        ?>
     </table>
     <?php

      ?>
      </div>
  </body>
</html>
<script type="text/javascript">
function fotaryus(x)
{
window.location="Fotaryus.php?subject="+x+"";
}
$("#Sattıklarım").hide();
function f1(objButton){

            $("#Aldıklarım, #Sattıklarım").hide();

            $("#" + $(objButton).val()).show();
  }
function Goster(X)
{
    window.location="Göster.php?subject="+X+"";
}
function rater(x)
{
  window.location="BizeYazın.php?subject="+x+"";
}

function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
