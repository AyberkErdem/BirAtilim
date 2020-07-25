<?php
session_start();
if(isset($_POST['Ilan']))
{
  header("Location:YeniIlan.php");
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
<form class="" action="Home.php" method="post">
  <input type="submit" name="Ilan" value="İlan Oluştur">
</form>
  </body>
</html>
