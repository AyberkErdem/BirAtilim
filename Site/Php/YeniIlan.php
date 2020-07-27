<?php

session_start();
function testfun()
{
  require_once('config.php');
   $file_size = $_FILES['image']['size'];
   if($file_size!=0)
   {

     $filename = $_FILES['image']['name'];
      $tmpname = $_FILES['image']['tmp_name'];
  	  $file_size = $_FILES['image']['size'];
  	  $file_type = $_FILES['image']['type'];
  	  $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $fp  = fopen($tmpname, 'r');
      $content = fread($fp, filesize($tmpname));
      $content = addslashes($content);
      fclose($fp);
      $adress=$_POST['City'];
      $adress.=$_POST['District'];
      $query=("insert into poster values('','".$_SESSION['user']."','".$content."','".$_POST['description']."','".$adress."','','','')");
      if(mysqli_query($dbc,$query))
      {
        header("location:home.php");
      }
   }
   else
   {
     echo"<script>alert('Bir resim ekleyiniz')</script>";
   }
}
if(array_key_exists('public',$_POST))
{
   testfun();
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
   <link rel="stylesheet" type="text/css" href="../css/İlan.css">
  <script type="text/javascript" src="../Js/googlemap.js">

  </script>
    <title>BirAtilim</title>
  </head>
  <body>


    <form method="POST" action="YeniIlan.php" enctype="multipart/form-data">
<br><br>
      <label>City</label>
          <input type="text" name="City" value="" placeholder="İl...">
          <label>District</label>
          <input type="text" name="District" value=""placeholder="İlçe...">
          <br><br><br>
          <div>
            <label>Resim Yükleyiniz</label>
            <br>
      	  <input type="file" name="image" accept="image/jpeg">
          </div>
          <br>
          <br>
          <textarea
          name="description"
          	id="description"
          	cols="40"
          	rows="4"
          	name="image_text"
          	placeholder="İlanı Anlatınız..."></textarea>
      		<input type="submit" name="public" value="Devam Et">
          		<input type="submit" name="konum" value="konum bak">
      </form>
  </body>

</html>
