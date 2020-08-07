<?php
session_start();
include('config.php');

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/MyPage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>Bir Atilim</title>
  </head>
  <body>
    <?php
    $query="select * from user Where Name='".$_GET['user']."'";
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
     ?>
    <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="../Img/person.png" alt="image"/style="height:200px; width:180px;">

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
                            <input type="button" onclick="location.href='Editor.php?User=<?php echo $_GET['user'];?>'" role="tab" class="profile-edit-btn btn-success" aria-controls="profile" aria-selected="false" name="btnAddMore" value="Edit Profile"/>

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
