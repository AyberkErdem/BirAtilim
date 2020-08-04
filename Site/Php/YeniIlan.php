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
  </head>
  <body>
    <div class="googlearea" border="1px" height="200px" >
          <center><h1>Select Your Location</h1></center>
    <div id='map'class="map" >

    </div>
    </div>

    <form method="POST" name="ayberk" action="YeniIlan.php" enctype="multipart/form-data">
<br><br>
<label>Yer İsmi</label>
    <input type="text" id="4"name="City" value="" placeholder="İşaret İsmi...">
      <label>City</label>
          <input type="text" id="0"name="City" value="" placeholder="İl...">
          <label>District</label>
          <input type="text" id="1"name="District" value=""placeholder="İlçe...">
          <br>  <br>
          <label>Address</label>
          <textarea  id="2" name="address" rows="4" cols=30></textarea>

          <label>Posta Kodu</label>
          <input type="text" id="3"name="postcode" value=""placeholder="Açık Adres...">
          <br>
          <br><br><br>
          <div>
            <label>Resim Yükleyiniz</label>
            <br>
      	  <input type="file" name="image" accept="image/jpeg">
          </div>
          <br>
          <br>
          <textarea
          name="description"
          	id="description"
          	cols="40"
          	rows="4"
          	name="image_text"
          	placeholder="İlanı Anlatınız..."></textarea>
            <input type="hidden" id='5' name="latitude" value="">
            <input type="hidden" id='6' name="longitude" value="">
      		<input type="submit" name="public" value="Devam Et">
          		<input type="submit" name="konum" value="konum bak">

      </form>
      <script type="text/javascript">
      function initMap() {

      var infoWindow = new google.maps.InfoWindow;

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
