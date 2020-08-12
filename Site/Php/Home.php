<?php
require_once('config.php');
session_start();
if(isset($_POST['Harita']))
{
  $_SESSION['selection']='0';
}
if(isset($_POST['tablo']))
{
  $_SESSION['selection']='1';
}
if(isset($_POST['Go']))
{

  header("Location:Göster.php?user=".$_GET['user']."&subject=".$_POST['id']."");
}
if(isset($_POST['Ara']))
{
  if($_POST['search']!='')
  {
    $query=("select Count(*) from poster where Id='".$_POST['search']."'");
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
  if($row['Count(*)']!='0')  {

      header("Location:Göster.php?subject=".$_POST['search']."&user=".$_GET['user']."");
  }
  }
}
echo"<script>
function func(){
  window.location.href ='MyPage.php?user='+".$_GET['user'].";
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
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/left.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
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
                    <a href="YeniIlan.php?user=<?php echo $_GET['user'] ?>" class="nav-link m-2 btn btn-warning nav-active">İlan Oluştur</a>
                </li>
                <li class="nav-item">
                  <?php
                  require_once('config.php');
                    $sql1 = "select * FROM chat  where Seen='0' and Receiver='".$_GET['user'] ."'";
                      $result=@mysqli_query($dbc,$sql1);
                        if ($result->num_rows > 0) {
                            echo "<a href='Mesajlar.php?user=".$_GET['user']."' class='nav-link m-2 btn btn-warning'>Mesajınız Var</a>";
                        }
                        else
                        {
                          echo" <a href='Mesajlar.php?user=".$_GET['user']."' class='nav-link m-2 btn btn-warning'>Mesajlar</a>";
                        }
                          ?>

                </li>
                <li class="nav-item">
                    <button  onclick="Fav()" class="nav-link m-2 btn btn-warning">Favorilerim</button>
                </li>
                <li class="nav-item">
                    <a href="MyPage.php?user=<?php echo $_GET['user'];?>" class="nav-link m-2 btn btn-warning">Ayarlarım</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link m-2 btn btn-warning">Bize Yazın</a>
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
<form class="text-center" action="Home.php?user=<?php echo $_GET['user']; ?>" method="post">
  <input type="submit" name='Harita'value="Harita Görünümü" class=" btn btn-secondary">
  <input type="submit" name='tablo'value="Tablo Görünümü" class=" btn btn-secondary">
</form>
<?php
  if($_SESSION['selection']=='0'){
  ?>
  <div class="z-depth-1-half map-container" >

  <div id='map'class="map" >

  </div>
  </div>
<?php } ?>
<?php
  if($_SESSION['selection']=='1'){
  ?>
<table class="table table-hover">
<tr>
<th>İlan Sahibi</th>
<th>Resim</th>
<th>Açıklama</th>
<th>Adres</th>
<th>İlana Git</th>
</tr>
  <?php require_once('config.php');
  $sql = "SELECT * FROM poster  order by Id ASC";
    $result=@mysqli_query($dbc,$sql);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {?><tr>
          <?php
            echo "<td>".$row['UserName']."</td>
            <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
            <td>".$row['Description']."</td>
            <td>".$row['adress']."</td><td>
            <form class='' action='Home.php?user=".$_GET['user']."' method='post'>
            <input type='submit' name='Go' value='Git'/><input type='hidden' name='id' value=".$row['Id']."/></form></td>";
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
}
 ?>
  </body>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

  </script>
  <script type="text/javascript">

  function Fav()
  {

    var Name="<?php echo $_GET['user']; ?>";

    var x=getCookie(Name);
    var user="<?php echo $_GET['user'];?>";

    window.location="ilanlarım.php?user="+user+"&favori="+x+"";

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
