<?php
session_start();
function testfun()
{
require_once('config.php');
  $file_size = $_FILES['defter']['size'];
  if($file_size !=0 ){

    $filename = $_FILES['defter']['name'];
    $tmpname = $_FILES['defter']['tmp_name'];
    $file_size = $_FILES['defter']['size'];
    $file_type = $_FILES['defter']['type'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $fp  = fopen($tmpname, 'r');
    $content = fread($fp, filesize($tmpname));
    $content = addslashes($content);
    fclose($fp);
    if($ext=="jpeg"||$ext=="JPEG")
    {
    $query="insert into  stajdefteri values('','".$_SESSION['user']."','','0','".$content."','".$file_size ."','0',curDate());";
    if(mysqli_query($dbc,$query))
    {
      echo"<script>alert('Defter sayfası yüklenmiştir.')</script>";


    }
    else
    {
      echo"<script>alert('Bir hata oldu tekrar deneyiniz.')</script>";
    }
    }

else
{
  echo"<script>alert('Dosya tipi pdf olmalıdır!')</script>";
}

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
    <title>BirAtilim</title>
  </head>
  <body>
    <form method="POST" action="YeniIlan.php" enctype="multipart/form-data">
          <div>
      	  <input type="file" name="image" accept="image/jpeg">
          </div>
          <br>
          <br>
          <textarea
          	id="text"
          	cols="40"
          	rows="4"
          	name="image_text"
          	placeholder="İlanı Anlatınız..."></textarea>
      		<input type="submit" name="public" value="Devam Et">
      </form>
  </body>
</html>
