<?php
require_once('config.php');
session_start();

if(isset($_POST['Yolla']))
{
  $query=("insert into chat values('','".$_GET['user']."','".$_GET['subject']."','".$_POST['mesaj']."','".$_POST['price']."','0')");
  if(mysqli_query($dbc,$query))
  {
echo"<script>window.location='Göster.php?user=".$_GET['user']."&subject=".$_GET['subject']."';</script>";
  }
  else
  {
    echo"<script>alert('mesajı atamadık')</script>";
  }

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/Göster.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title></title>
  </head>
  <body>
    <nav style="background-color:#88001b;" class="navbar navbar-expand-lg navbar-light ">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="Home.php?user=<?php echo $_GET['user']; ?>">
                <img title="Bir Atilim" src="../Img/logo.png" alt="Logo">
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
                    <a href="#" class="nav-link m-2 btn btn-warning">Mesajlar</a>
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
    <?php
    require_once('config.php');
    $sql = "SELECT * FROM poster  where Id='".$_GET['subject']."'";
      $result=@mysqli_query($dbc,$sql);
        if ($result->num_rows > 0) {
          while($row=$result->fetch_assoc())
          {
              echo "


              <div class='container'>
              <div class='card'>
                <div class='container-fliud'>
                  <div class='wrapper row'>
                    <div class='preview col-md-6'>

                      <div class='preview-pic tab-content'>
                        <div class='tab-pane active' id='pic-1'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-2'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-3'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-4'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-5'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='300' widht='100'/></div>
                      </div>
                      <ul class='preview-thumbnail nav nav-tabs'>
                        <li class='active'><a data-target='#pic-1' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-2' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-3' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-4' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-5' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='56' widht='55'/></a></li>
                      </ul>

                    </div>
                    <div class='details col-md-6'>
                    <ul class='nav nav-tabs' id='myTab' role='tablist'>
                        <li class='nav-item'>
                            <a class='nav-link active text-muted' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>İlan Detayı</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link text-muted' id='profile-tab' data-toggle='tab' href='#location' role='tab' aria-controls='profile' aria-selected='false'>Lokasyon</a>
                        </li>
                    </ul>
                    <div class='tab-content profile-tab' id='myTabContent'>
                    <div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>
                      <h3 class='product-title'>men's shoes fashion</h3>

                      <p class='product-description'> ".$row['Description']." </p>
                      <h4 class='price'>current price: <span>$180</span></h4>
                      <p class='vote'><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>


                      </div>
                      <div class='tab-pane fade ' id='location' role='tabpanel' aria-labelledby='location-tab'>
                        <h3 class='product-title'>men's shoes fashion</h3>

                        <p class='product-description'> ".$row['Description']." </p>
                        <h4 class='price'>current price: <span>$180</span></h4>
                        <p class='vote'><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>";
    }
}
else
{
  echo"Nothing new here...";
}
   ?>
    <table>
    <tr>
    <th>İlan Sahibi</th>
    <th>Resim</th>
    <th>Açıklama</th>
    <th>Adres</th>
    </tr>

       <div border='1'height='700' widht='400' class="">
         <table>
         <tr>
         <th>From</th>
         <th>Message</th>
         <th>Value</th>
         </tr>
           <?php require_once('config.php');
           $sql1 = "SELECT * FROM chat  where PosterId='".$_GET['subject']."'";
             $result=@mysqli_query($dbc,$sql1);
               if ($result->num_rows > 0) {
                 while($row=$result->fetch_assoc())
                 {?><tr>
                   <?php
                     echo "<td>".$row['Sender']."</td>
                     <td>".$row['Message']."</td>
                     <td>".$row['Value']."</td>";
                       ?></tr><?php
                 }
               }
               else
               {
                 echo"Nothing new here...";
               }
            ?>
          </table>
         </div>
         <br>
<div class="">
  <form class="" action="Göster.php?user=<?php echo $_GET['user']; ?>&subject=<?php echo $_GET['subject'];?>" method='post'>
      <textarea name='mesaj' rows='8' cols='80'></textarea>
         <input name="price" type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
      <input type='submit' name='Yolla' value='Gönder'>
  </form>


</div>
  </body>
</html>
