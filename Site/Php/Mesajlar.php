<?php
include('config.php');

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
      type = "image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
      <link rel="stylesheet" type="text/css" href="../css/Göster.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

  <title>Bir atilim</title>
</head>
  <body>
    <nav style="background-color:#88001b;" class="navbar navbar-expand-lg navbar-light ">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/left.png" alt="Logo">
            </a>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
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
                    <a href="YeniIlan.php?user=<?php echo $_GET['user'] ?>" class="nav-link m-2 btn btn-warning nav-active">İlan Oluştur</a>
                </li>
                <li class="nav-item">
                    <a href="Mesajlar.php?user=<?php echo $_GET['user'];?>" class="nav-link m-2 btn btn-warning">Mesajlar</a>
                </li>
                <li class="nav-item">
                    <a href="MyPage.php?user=<?php echo $_GET['user'];?>" class="nav-link m-2 btn btn-warning">Ayarlarım</a>
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
    <form class="text-center" action="ilanlarım.php?user=<?php echo $_GET['user']; ?>" method="post">
      <input  style="margin-top: 0px;" type="submit" name='ilanlarım'value="İlanlarıma Git" class=" btn btn-info">
    </form>
         <?php
         require_once('config.php');
           $sql1 = "select * FROM chat  where Seen='0' and Receiver='".$_GET['user'] ."'";
             $result=@mysqli_query($dbc,$sql1);
               if ($result->num_rows > 0) {
                 ?>  <div style='display:block;' class='wrapper row'>
                     <div style="padding-left:25px;margin-top: 20px;width: 100%;height:200px;overflow:auto;" >

                        <table style="padding-left:25px; auto;width: 100% overflow-X:hidden; "  class='float-center table table-striped custab'>
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Message</th>
                                <th>Value</th>
                                <th>Date</th>
                                <th>İlana Git</th>
                            </tr>
                        </thead>

                    <?php
                 while($row=$result->fetch_assoc())
                 {?>
                   <?php
                   echo "<tr>";
                   echo "<td style='font-size:0.7em;'>".$row['Sender']."</td>";
                    echo"
                       <td style='font-size:0.7em;'>".$row['Message']."</td>
                       <td style='font-size:0.7em;'>";echo $row['Value'];echo"</td>
                       <td style='font-size:0.7em;'>".$row['Date']."</td>
                       <td>
                       <button class='btn btn-primary' onclick='GoPoster()' value='Git'>Git</button>
                       <input id='posterid'class='btn btn-primary' type='hidden' value='".$row['PosterId']."'>
                           </td>
                   </tr>";
                     ?><?php
                 }
               }
               else
               {
                 echo"<p style='margin-top:25px;' class='text-center text-dark bg-success'>Yeni Mesajınız yoktur</p>";
               }
            ?>

          </div>
          </div>
          <script type="text/javascript">
          function GoPoster()
          {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("user");
            var x = document.getElementById("posterid").value;
            window.location="Göster.php?user="+c+"&subject="+x;
          }
          </script>
  </body>
</html>
