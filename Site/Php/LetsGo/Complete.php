<?php
include('config.php');
session_start();
if(isset($_POST['Done']))
{
  $query="call poster_completer('".$_GET['subject']."','".$_SESSION['user']."','".$_POST['Who']."','".$_POST['price']."')";
  if(mysqli_query($dbc,$query))
  {
 header("location:Home.php");
  }
  else
  {
    echo "<script>alert('Ben sakinim')</script>";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
<style media="screen">
    .dropbtn {

      border: none;
      cursor: pointer;

    }

    .dropbtn:hover, .dropbtn:focus {
      background-color: #2980B9;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;

    cursor: pointer;
      overflow: auto;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown a:hover {background-color: #ddd;cursor: pointer;}

    .show {display: block;}
</style>
    <meta charset="utf-8">
    <title>Bir Atilim</title>
    <meta name="description" content="Bir atilim">
    <meta name="author" content="Ayberk Erdem">
    <meta name="keywords" content="Bir atilim,Ayberk Erdem">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  </head>
  <body style="background-color: #e4b852;overflow-x: hidden;">
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
                <img  src="../Img/home.png" alt="logo">
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
                  <?php
                  require_once('config.php');
                    $sql1 = "call DoIHave('".$_SESSION['user'] ."')";
                      $result=@mysqli_query($dbc,$sql1);
                        if ($result->num_rows > 0) {
                          $row=$result->fetch_assoc();
                          if($row['res']!=0)
                            echo "<a href='Mesajlar.php' class='nav-link m-2 btn btn-warning'>Mesajınız Var</a>
                            <script> var notification = new Notification('Mesajınız var canim', {icon:'../Img/logo.png'});</script>";


                        }
                        mysqli_free_result($result);
                      $dbc->next_result();
                          ?>

                </li>

                <li class="nav-item">

                    <button onclick="myFunction()" class="nav-link m-2 dropbtn btn btn-warning">Kişisel Şeyler</button>
                    <div id="myDropdown" class="dropdown-content">
                      <a class="bg-warning text-muted" href="ilanlarım.php">İlanlarım</a>
                      <a class="bg-warning text-muted" onclick="Fav()">Favorilerim</a>
                          <a class="bg-warning text-muted" href="Mesajlar.php">Mesajlarım</a>
                                <a class="bg-warning text-muted" href="MyPage.php">AlışVerişlerim</a>
                      <a class="bg-warning text-muted" href="MyPage.php">Ayarlarım</a>

    </div>

                </li>
                <li class="nav-item">
                    <a href="BizeYazın.php" class="nav-link m-2 btn btn-warning">Bize Yazın</a>
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
    <div class="text-center">
    <div id="choose-form" style="text-align:right" class="btn-group"  aria-label="Basic example">
    <button value="DivSatıldı" onclick="f1(this)"  type="button" class="btn btn-primary">Satıldı</button>
    <button value="Silelim" onclick="f1(this)" type="button" class="btn btn-danger">İlanı Kaldır</button>
  </div>
  </div>


  <div id='DivSatıldı' class="">
    <div class="row">
    <div class="col-md-4">
    <span><p>Ürün Satıldı</p></span>
        </br>
        <span><h5><p>Satın Alan</p></h5></span>
      <?php
      $query=("select distinct sender from forum where Receiver='".$_SESSION['user']."'");
      $result=@mysqli_query($dbc,$query);
      if($result->num_rows>0){

        while ($row=$result->fetch_assoc()) {
      echo "
          <button id='".$row['sender']."' onclick='SatınAlan(this.id)' value=".$row['sender']." class='btn float-left btn-secondary' type='button'>".$row['sender']."</button>
            </br>  <br>
    ";
    }}
    ?>
    </div>
    </div>
    <label id ='tag' >Alıcı:</label>
  </br><br><br>
  <form  action="Complete.php<?php echo "?subject=".$_GET['subject'];?>" method="post">
  <label>Ücret</label>

  <input style="width:200px" name="price" type="number" placeholder="Fiyat Biçin" value="" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"  />
    <input id="Who" type="hidden" name="Who" value="">
      <input type="submit" name="Done" value="Tamamla">

  </form>
    </div>

    <div id='Silelim' class="">
  <button onclick="Delete()" class="btn btn-primary" type="button" name="button">Sonra başka şeyler ekleyeceğim</button>
      </div>

  </body>
</html>
<script type="text/javascript">
function Delete()
  {
  var txt;
  if (confirm("Bu ilanı kaldırmak istediğinize emin misiniz?")) {

    var url_string =window.location.href; //window.location.href
    var url = new URL(url_string);
    var c = url.searchParams.get("subject");
    window.location="Delete.php?subject="+c;

  } else {

  }
}
function SatınAlan(clicked_id)
{
y=clicked_id;

document.getElementById('Who').value=y;
document.getElementById('tag').innerHTML="Alıcı:  "+y;
}
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
$("#Silelim").hide();
function f1(objButton){

            $("#Silelim, #DivSatıldı").hide();

            $("#" + $(objButton).val()).show();
  }
</script>
