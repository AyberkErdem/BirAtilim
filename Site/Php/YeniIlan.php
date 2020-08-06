<?php

session_start();
function testfun()
{
  require_once('config.php');
   $file_size = $_FILES['image']['size'];
   if($file_size!=0)
   {

      $filename = $_FILES['image']['name'];
      $tmpname = $_FILES['image']['tmp_name'];
  	  $file_size = $_FILES['image']['size'];
  	  $file_type = $_FILES['image']['type'];
  	  $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $fp  = fopen($tmpname, 'r');
      $content = fread($fp, filesize($tmpname));
      $content = addslashes($content);
      fclose($fp);
      $adress=$_POST['address'];
        $adress.=",";
      $adress.=$_POST['District'];
          $adress.=",";
        $adress.=$_POST['City'];

      $query=("insert into poster values('','".$_SESSION['user']."','".$content."','".$_POST['description']."','".$adress."','".$_POST['latitude']."','".$_POST['longitude']."','Ev')");
      if(mysqli_query($dbc,$query))
      {
        header("location:home.php");
      }
   }
   else
   {
     echo"<script>alert('Bir resim ekleyiniz')</script>";
   }
}
if(array_key_exists('public',$_POST))
{
   testfun();
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
   <link rel="stylesheet" type="text/css" href="../css/İlan.css">
   <link rel="stylesheet" type="text/css" href="../css/reset.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

   <!-- Load Leaflet from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>

  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.4.1/dist/esri-leaflet.js"
    integrity="sha512-xY2smLIHKirD03vHKDJ2u4pqeHA7OQZZ27EjtqmuhDguxiUvdsOuXMwkg16PQrm9cgTmXtoxA6kwr8KBy3cdcw=="
    crossorigin=""></script>

  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>
  <script type="text/javascript" src="../Js/YeniIlan.js">

  </script>
    <title>BirAtilim</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">

  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
            <a class="navbar-brand d-none d-lg-inline-block" href="#">
                <img src="../Img/logo.png" alt="">
            </a>
            <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="#">
                <img src="//placehold.it/40?text=LOGO" alt="logo">
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
                    <a href="#" class="nav-link m-2 btn btn-warning">Mesajlar</a>
                </li>
                <li class="nav-item">
                    <a href="MyPage.php?user=<?php echo$_SESSION['user'];?>" class="nav-link m-2 btn btn-warning">Ayarlarım</a>
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
    <div class="flex">



    <div id='map'class="map" >

    </div>

<div class="">
  <div class="text-center">
  <div id="choose-form" style="text-align:right" class="btn-group"  aria-label="Basic example">
  <button value="divadres"onclick="f1(this)"  type="button" class="btn btn-secondary">Adres</button>
  <button value="divilan" onclick="f1(this)" type="button" class="btn btn-secondary">İlan İçeriği</button>
</div>
</div>
<div>
  <form id='adres' method="POST" name="ayberk" action="YeniIlan.php" enctype="multipart/form-data" class="well form-horizontal">
    <div id="collapse1" class="collapse show">
<div class="card-body" id="divadres">
 <div class="row">
     <div class="col-md-3 col-lg-4">
         <div class="form-group">
             <label class="control-label">Yer ismi</label>
            <input class="form-control"  type="text" id="4"name="yerismi" value="" placeholder="İşaret İsmi...">
         </div>
     </div>
     <div class="col-md-1 col-lg-4">
         <div class="form-group">
             <label class="control-label">Şehir</label>
          <input type="text" id="0"name="City"  class="form-control"  value="" placeholder="İl...">
         </div>
     </div>
     <div class="col-md-1 col-lg-4">
         <div class="form-group">
             <label class="control-label">İlçe</label>
            <input class="form-control"  type="text" id="1"name="District" value=""placeholder="İlçe...">
         </div>
     </div>
      </div>
    <div class="row">
      <div class="col-md-3 col-lg-4">
          <div class="form-group">
              <label class="control-label">Adres</label>
              <textarea  class="form-control"  style="resize:none" class="form-control" id="2" name="address" rows="4" cols=30></textarea>
          </div>
      </div>
      <div class="col-md-1 col-lg-4">
          <div class="form-group">
              <label class="control-label">Posta Kodu</label>
              <input class="form-control"  type="text" id="3"name="postcode" value=""placeholder="Açık Adres...">
          </div>
      </div>
      </div>
      <div class="row">

 </div>
     </div>

       <input type="hidden" id='5' name="latitude" value="">
       <input type="hidden" id='6' name="longitude" value="">
     </form>
      <div class="card-body" id="divilan">
 <form id='ilan' method="POST" name="ayberk" action="YeniIlan.php" enctype="multipart/form-data" class="well form-horizontal">
<div class="row">
    <input type="file" name="image" accept="image/jpeg">

   <div class="col-md-1 col-lg-4">
       <div class="form-group">
 <textarea
  class="form-control"
 name="description"
   id="description"
   cols="35"
   rows="5"
   name="image_text"
   style="resize:none"
   placeholder="İlanı Anlatınız..."></textarea>
 </div>
</div>
   <div class="col-md-1 col-lg-4">
       <div class="form-group">
           <label class="text-center">Yayınla</label>
           <input class="form-control" type="submit" name="public" value="Devam Et">
       </div>
     </div>
  </form>
 </div>
 </div>
</div>
<script type="text/javascript">
$("#divilan").hide();
function f1(objButton){

            $("#divadres, #divilan").hide();

            $("#" + $(objButton).val()).show();
  }
</script>
<script type="text/javascript">
      function initMap() {

      var infoWindow = new google.maps.InfoWindow;
      var warning=0;
        // Change this depending on the name of your PHP or XML file

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var map = new google.maps.Map(document.getElementById('map'), {
              center: pos,
              zoom: 15
            });
            var infowincontent = "deneme 1 2";

            var text = document.createElement('text');
            text.textContent = description


            var marker = new google.maps.Marker({
              map: map,
              position: pos,
              draggable:true
            });
            marker.addListener('mouseover', function() {
              content=String(marker.position);
              infoWindow.setContent(content);
              infoWindow.open(map, marker);
          });
          marker.addListener('mouseout', function() {
              infoWindow.close(map,marker);
          });


            marker.addListener('click', function(e) {
      var geocodeService = L.esri.Geocoding.geocodeService();

      var asd = { lat:marker.getPosition().lat(),
      lng:marker.getPosition().lng()


      };

      geocodeService.reverse().latlng(asd).run(function (error, result) {
      if (error) {
      return;
      }

      content=String(result.address.Match_addr);

      infoWindow.setContent(content);
      infoWindow.open(map, marker);

      var res = content.split(",");
      var geocode=String(marker.position);

      var geocode=geocode.split(",");
      geocode[0] =geocode[0].replace('(','');
        geocode[1] =geocode[1].replace(')','');
      if(res.length!=1)
      {
          document.getElementById("4").value = "";
          document.getElementById("0").value = res[res.length-1];
        document.getElementById("1").value = res[res.length-2];
          document.getElementById("2").value = res[0]+" mahallesi "+res[res.length-4];
            document.getElementById("3").value = res[res.length-3];
              document.getElementById("5").value = geocode[0];
                document.getElementById("6").value = geocode[1];
      }
      else
      {

          document.getElementById("4").value = res;
          if(warning%4==0){
          alert("Tam adres çıkması için lokasyona en yakın sokağı işaretlemeye çalışınız.");

          }
          warning++;
      }
      });
            });
      });
      }
      }
      /*      */
      function doNothing() {}
      </script>
  </body>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

    </script>
</html>
