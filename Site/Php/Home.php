<?php
session_start();

if(isset($_POST['Go']))
{
  $_SESSION['IlanNo']=$_POST['id'];
  header("Location:Göster.php");
}
if(isset($_POST['Ilan']))
{
  header("location:YeniIlan.php");
}
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  <meta name="description" content="staj sistemi">
  <meta name="author" content="Ayberk Erdem">
  <meta name="keywords" content="esogü staj sistemi,esogü">
  <meta name="viewport" content="widht-device-witdh,initial-scale-1.0">
    <title>BirAtilim</title>
      <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/Home.css">
   <script type="text/javascript" src="../Js/googlemap.js">

   </script>

  <body>
    <header id="giriş">
      <div class= "container" >
        <div class="logo">
    <a href="Home.php"><img title="Hakkımızda"src="../img/logo.png"></a>
        </div>
        <div class="menu">
          <ul>
            <li id="home" title="İlanlarım"><a href='MyPoster.php'>İlanlarım</a></li>
              <li id="notify" title="Bildirimler"><a href='MyPoster.php'>Favorilerim</a></li>
                <li id="about" title="Hakkında"><a href='MyPoster.php'>Ayarlar</a></li>
                  <li id="about" title="Mesajlar"><a href='MyPoster.php'><img src="../img/Message.png"></a></li>
          </ul>
        </div>
      </div>
    </header>
    <form class="" action="Home.php" method="post">
      <input id="align-right" type="submit" name="Ilan" value="İlan Oluştur">
    </form>
  <div class="googlearea" >
        <h2 align="center">İlanlar</h2>
  <div id='map'class="map" >

  </div>
  </div>

<table>
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
            <form class='' action='Home.php' method='post'>
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
  </body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

  </script>

</html>
