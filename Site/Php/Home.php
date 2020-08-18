<?php
require_once('config.php');
session_start();

if(isset($_POST['Go']))
{

  header("Location:Göster.php?subject=".$_POST['id']."");
}
if(isset($_POST['Ara']))
{
  if($_POST['search']!='')
  {
    $query=("select Count(*) from poster where Id='".$_POST['search']."'");
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
  if($row['Count(*)']!='0')  {

      header("Location:Göster.php?subject=".$_POST['search']."");
  }
  }
}
echo"<script>
function func(){
  window.location.href ='MyPage.php';
}</script>"
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
        type = "image/x-icon">
  <meta name="description" content="staj sistemi">
  <meta name="author" content="Ayberk Erdem">
  <meta name="keywords" content="esogü staj sistemi,esogü">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>BirAtilim</title>
      <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/Home.css">
   <script type="text/javascript" src="../Js/googlemap.js">

   </script>

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
                <img  src="//placehold.it/40?text=LOGO" alt="logo">
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
                            echo "<a href='Mesajlar.php' class='nav-link m-2 btn btn-warning'>Mesajınız Var</a>";


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
    <button value="map"onclick="f1(this)"  type="button" class="btn btn-primary">Harita Görünümü</button>
    <button value="DivTablo" onclick="f1(this)" type="button" class="btn btn-danger">Tablo Görünümü</button>
  </div>
  </div>

  <div  class="z-depth-1-half map-container" >

  <div id='map' class="map" >

  </div>
  </div>
<div id='DivTablo' class="">


<table class="table table-hover">
<tr>
<th>İlan Sahibi</th>
<th>Resim</th>
<th>Açıklama</th>
<th>Adres</th>

</tr>
  <?php require_once('config.php');

  $sql = "SELECT * FROM poster  order by Id ASC";
    $result=@mysqli_query($dbc,$sql);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {?><tr title='İlana Git' onclick='Goster(<?php echo $row['Id']; ?>)'>
          <?php
            echo "<td>".$row['UserName']."</td>
            <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
            <td>".$row['Description']."</td>
            <td>".$row['adress']."</td>";
              ?></tr><?php
        }
      }
      else
      {
        echo"Nothing new here...";
      }
   ?>
</table>
<?php

 ?>
 </div>
  </body>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

  </script>
  <script type="text/javascript">
  function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
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
  $("#DivTablo").hide();
  function f1(objButton){

              $("#map, #DivTablo").hide();

              $("#" + $(objButton).val()).show();
    }
  function Goster(X)
  {
      window.location="Göster.php?subject="+X+"";
  }
  function Fav()
  {

    var Name="<?php echo $_SESSION['user']; ?>";

    var x=getCookie(Name);
    var user="<?php echo $_SESSION['user'];?>";

    window.location="ilanlarım.php?favori="+x+"";

  }

  function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {

      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {

      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function deleteCookie(name)
{

  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

}

function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
  </script>
</html>
