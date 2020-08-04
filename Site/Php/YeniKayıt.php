<?php
require_once('config.php');
if(isset($_POST['Tamamla']))
{
  if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['Password1'])&&isset($_POST['Password2']))
  {
      if($_POST['Password1']==$_POST['Password2'])
      {
        $query="insert into user values('','".$_POST['username']."','".$_POST['Password1']."','".$_POST['email']."')";

        if(mysqli_query($dbc,$query))
        {
            header('Location:index.php');
        }
      }
  }
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  <meta name="description" content="staj sistemi">
  <meta name="author" content="Ayberk Erdem">
  <meta name="keywords" content="Bir atilim">
  <meta name="viewport" content="widht-device-witdh,initial-scale-1.0">

    <title>BirAtilim</title>
  </head>
  <body>
    <header>
      <h1>Kullanıcı Kaydı</h1>
      </header>
    <form action="YeniKayıt.php" method="post" id="form" >
      <label for="fname">Kullanıcı İsmi:</label><br>
      <input type="text" id="username" name="username" value=""><br>
      <label for="fname">E-mail:</label><br>
      <input type="email" id="email" name="email" value=""><br>
      <label for="lname">Şifre:</label><br>
      <input type="password" id="Password1" name="Password1" value=""><br><br>
      <label for="lname">Tekrar Şifre:</label><br>
      <input type="password" id="Password2" name="Password2" value=""><br><br>
      <input type="submit" name='Tamamla'value="Tamamla">

    </form>

  </body>
</html>
