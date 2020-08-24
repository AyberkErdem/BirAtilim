<?php
session_start();
include('config.php');

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
      type = "image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Bir atilim">
<meta name="author" content="Ayberk Erdem">
<meta name="keywords" content="Bir atilim,Ayberk Erdem">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/MyPage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>Bir Atilim</title>
  </head>
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

                                    <button onclick="myFunction()" class="nav-link m-2 dropbtn btn btn-warning">Kişisel Şeyler</button>
                                    <div id="myDropdown" class="dropdown-content">
                                      <a class="bg-warning text-muted" href="ilanlarım.php">İlanlarım</a>
                                      <a class="bg-warning text-muted" onclick="Fav()">Favorilerim</a>
                                          <a class="bg-warning text-muted" href="Mesajlar.php">Mesajlarım</a>
                                      <a class="bg-warning text-muted" href="MyPage.php">Ayarlarım</a>

                    </div>

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
    <?php
    $query="select * from user Where Name='".$_SESSION['user']."'";
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
     ?>
    <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div  class="profile-img">
                              <?php
                            echo" <img src='data:image/jpeg;base64,".base64_encode($row['ProfilePic'])."' height='300' widht='100'/>
 "?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                        <h5>
                                            <?php echo $row['Name'] ?>
                                        </h5>
                                        <h6>
                                            <?php
                                            if($row['Gold']=='1')
                                            {
                                              echo "Premium Üye";
                                            }
                                            else
                                            {
                                              echo"Standart Üye";
                                            }
                                             ?>
                                        </h6>
                                        <p class="proile-rating">RANKINGS : <span>10/10</span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-muted" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Hakkında</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-muted" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">İstatistikler</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="button" onclick="location.href='Editor.php'" role="tab" class="profile-edit-btn btn-success" aria-controls="profile" aria-selected="false" name="btnAddMore" value="Edit Profile"/>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Kullanıcı Id</label>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <p class="text-muted"><?php echo $row['Id'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>İsim</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-secondary"><?php echo $row['Name'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-secondary"><?php echo $row['Email'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Tel No:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-secondary"><?php if($row['Phone']==""){echo "--";} else {echo $row['Phone'];} ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Hesap Durumu</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-secondary"><?php if($row['authorized']=='1'){echo "Aktif ";} ?></p>
                                                </div>
                                            </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Aktif İlan Sayısı</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-muted"><?php
                                                    $sorgu="select Count(*) from poster where UserName='".$row['Name']."'";
                                                    $response=@mysqli_query($dbc,$sorgu);
                                                    $kürek=$response->fetch_assoc();
                                                    echo $kürek['Count(*)'];
                                                     ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Toplam değişim</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-muted">-400 ₺</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Toplam İlan Açma</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-muted">20</p>
                                                </div>
                                            </div>
                                          </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
  </body>
</html>
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
</script>
