<?php
require_once('config.php');
session_start();
if(isset($_POST['giriş']))
{
  if(isset($_POST['username'])&&isset($_POST['Password']))
  {
    $query="select * from user where Name='".$_POST['username']."' and Password='".$_POST['Password']."'";
    $response=@mysqli_query($dbc,$query);
  if(mysqli_num_rows($response))  {
    $_SESSION['user']=$_POST['username'];
      header("Location:Home.php");
  }
  else
  {
    echo"hatali şifre";
  }
  }
}

if(isset($_POST['yeni']))
{

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
    <header>
      <h1>Kullanıcı Girişi</h1>
      </header>
    <form action="index.php" method="post" id="form" >
      <label for="fname">Kullanıcı İsmi:</label><br>
      <input type="text" id="username" name="username" value=""><br>
      <label for="lname">Şifre:</label><br>
      <input type="password" id="Password" name="Password" value=""><br><br>
      <input type="submit" name='giriş'value="Giriş">
      <input type="submit" name='yeni'value="Yeni Kayıt">
    </form>


  </body>
</html>
