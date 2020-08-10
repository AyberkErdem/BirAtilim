<?php
require_once('config.php');
session_start();
$_SESSION['selection']='0';
if(isset($_POST['giriş']))
{
  if(isset($_POST['username'])&&isset($_POST['Password']))
  {
    $query="SELECT count(*), Name FROM user where Email='".$_POST['username']."' and Password='".$_POST['Password']."' and authorized='1' GROUP BY Name ORDER BY Id";
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
    if(isset($row['count(*)'])){
  if($row['count(*)']!='0')  {

      header("Location:Home.php?user=".$row['Name']."");
  }
  else if($row['Count(*)']=='0')
  {
    echo"<script>alert(Giriş Bilgileri Hatalı)</script>";
  }
  }
  }
}

if(isset($_POST['yeni']))
{
header("location:YeniKayıt.php");
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
        type = "image/x-icon">
  <meta name="description" content="staj sistemi">
  <meta name="author" content="Ayberk Erdem">
  <meta name="keywords" content="Bir atilim ">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>BirAtilim</title>
  </head>
  <body>
    <div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Kullanıcı Girişi</h3>


			</div>
			<div class="card-body">
				<form  action="index.php" method="post">

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input name="username" type="email" class="form-control" placeholder="Email">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="Password" type="password" class="form-control" placeholder="Şifre">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Beni hatırla
					</div>
					<div class="form-group">
						<input type="submit" name='giriş'value="Giriş" class="btn btn-warning  float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Üye Değil Misiniz?<a href="YeniKayıt.php">Üye Olun</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Şifremi Unuttum:(</a>
				</div>
			</div>
		</div>
	</div>
</div>
  </body>
</html>
