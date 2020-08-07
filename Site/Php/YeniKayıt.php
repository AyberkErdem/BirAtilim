<?php
require_once('config.php');
if(isset($_POST['Tamamla']))
{
  if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['Password1'])&&isset($_POST['Password2']))
  {
      if($_POST['Password1']==$_POST['Password2'])
      {
        $query="insert into user values('','','".$_POST['username']."','".$_POST['Password1']."','".$_POST['email']."','','0')";

        if(mysqli_query($dbc,$query))
        {

            header("location:MailSender.php?subject=E-mail Authorize&Email=".$_POST['email']."");
        }
        else
        {
        echo"<script>alert('Bu email adresine ait kayıt mevcut!')</script>";
        }
      }
      else
      {
        echo"<script>alert('Şifreler uyuşmuyor!')</script>";
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/NewUser.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
    <title>BirAtilim</title>
  </head>
  <body>
    <div>
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4  class="card-title text-warning mt-4 text-center">Kayıt Olun</h4>

	<form action="YeniKayıt.php" method="post">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" class="form-control" placeholder="İsim" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>

    	<input name="" class="form-control" placeholder="Telefon No ( Opsiyonel )" type="text">
    </div> <!-- form-group// -->

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="Password1"class="form-control" placeholder="Şifre" type="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="Password2" class="form-control" placeholder="Tekrar Şifre" type="password">
    </div> <!-- form-group// -->
    <div class="form-group">
        <input type="submit" name="Tamamla"value=" Hesap Oluştur"class="btn btn-warning btn-block">
    </div> <!-- form-group// -->
    <p color:"#ff7f27"  class="text-light mt-4 text-center">Zaten Bir Hesabınız var mı? <a class="text-info mt-4"href="index.php">Log In</a> </p>
</form>
</article>
</div> <!-- card.// -->

</div>

  </body>
</html>
