<?php
include('config.php');
session_start();
if(isset($_POST['publish'])&&!isset($_GET['role']))
{

    $datas=array("","","","","");
     $filename=$_FILES['image']['name'];
     $tmpname=$_FILES['image']['tmp_name'];
     $filetype=$_FILES['image']['type'];
     for ($i=0; $i <=count($tmpname)-1 ; $i++) {
       $name=addslashes($filename[$i]);
       $tmp=addslashes(file_get_contents($tmpname[$i]));
       $datas[$i]=$tmp;
     }
      $adress=$_POST['address'];
        $adress.=",";
      $adress.=$_POST['District'];
          $adress.=",";
        $adress.=$_POST['City'];

      $query=("CALL AddPoster('".$_SESSION['user']."','".$_POST['description']."','".$adress."','".$_POST['latitude']."','".$_POST['longitude']."','Ev','".$datas[0]."',
      '".$datas[1]."','".$datas[2]."','".$datas[3]."','".$datas[4]."')");
    if(mysqli_query($dbc,$query))
    {
      header("Location:Home.php");
    }

   else
   {
     echo"<script>alert('Bir resim ekleyiniz')</script>";
   }
}
else if (isset($_POST['publish'])&&isset($_GET['role']))
{

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

    <title>BirAtilim</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
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
  <form onload='Edition()' id='adres' method="POST" name="ayberk" action="YeniIlan.php "enctype="multipart/form-data" class="well form-horizontal">
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
       <input style="visibility:hidden;" onclick="submit()" class="btn btn-warning btn-lg" type="submit" name="publish" value="İlanı Yayınla">


      <div class="card-body" id="divilan">


<div class="row">
  <div class="col-md-1 col-lg-4">
      <div class="form-group align-middle">
        <label class="control-label">Resim Ekleyiniz</label>
    <input type="file" name="image[]" accept="image/jpeg" multiple>
   </div> </div>
   <div class="container-fluid">
  <div class="row">
    <div class="col-md-4 row-height">
RESİM ÖNİZLEME
    </div>
    <div class="col-md-4 row-height">
RESİM ÖNİZLEME
    </div>
    <div class="col-md-4 row-height">
RESİM ÖNİZLEME
    </div>
  </div>
</div>
</div>
<div class="row">
   <div class="col-md-1 col-lg-4">
       <div class="form-group align-middle">

    </div> </div>
    </div>
    <div class="row">
   <div class="col-md-1 col-lg-8">
       <div class="form-group">
             <label class="control-label">İlan Açıklaması</label>

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
</div>
<div class="row">
  <div class="col-md-1 col-lg-4">
      <div class="form-group align-middle">
      </div>
    </div>
    <div class="col-md-1 col-lg-4">
        <div class="form-group align-middle">
        </div>
      </div>
   <div class="col-md-1 col-lg-4 float-right">
       <div class="form-group text-center">


           <input onclick="submit()" class="btn btn-warning btn-lg" type="submit" name="publish" value="İlanı Yayınla">
       </div>
     </div>
        </form>
 </div>
</div>
 </div>
</div>
<script type="text/javascript">
function submit(){
 document.getElementById("adres").submit();
 document.getElementById("ilan").submit();
}
</script>
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
$("#divilan").hide();
function f1(objButton){

            $("#divadres, #divilan").hide();

            $("#" + $(objButton).val()).show();
  }
</script>
<script type="text/javascript">
var customIcons = {
               type1: {
                 Ev: 'tip1.png'
               }
       };
var customLabel = {
  restaurant: {
    label: 'R'
  },
  bar: {
    label: 'B'
  },
  Ev: {
    label: 'E'
  }
};
<?php if (isset($_GET['subject'])){ ?>
   window.onload = Edition();
   function Edition(){
     downloadUrl('İlanJson.php?ıd=<?php echo $_GET['subject']; ?>', function(data) {
       var xml = data.responseXML;
       var kayıt = xml.documentElement.getElementsByTagName('poster');
         Array.prototype.forEach.call(kayıt, function(kayıts) {
       var address =kayıts.getAttribute('address');
       var description = kayıts.getAttribute('description');
       var type = kayıts.getAttribute('type');
      var point0=kayıts.getAttribute('lat');
      var point1=kayıts.getAttribute('lng');
        var x = address.split(",");
                  document.getElementById("4").value = "";
                  document.getElementById("0").value = x[2];
                  document.getElementById("1").value = x[1];
                  document.getElementById("2").value =x[0];

                    document.getElementById("5").value = point0;
                      document.getElementById("6").value = point1;
});
 });

     }


function initMap() {
  var myLatlng1 = new google.maps.LatLng(53.65914, 0.072050);



     if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(function(position) {
         initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
         map.setCenter(initialLocation);
       });
     }
var infoWindow = new google.maps.InfoWindow;

  // Change this depending on the name of your PHP or XML file
  downloadUrl('İlanJson.php?ıd=<?php echo $_GET['subject']; ?>', function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('poster');
    Array.prototype.forEach.call(markers, function(markerElem) {
      var id = markerElem.getAttribute('id');
      var name = markerElem.getAttribute('name');
      var address = markerElem.getAttribute('address');
      var description = markerElem.getAttribute('description');
      var type = markerElem.getAttribute('type');
      var point = new google.maps.LatLng(
          parseFloat(markerElem.getAttribute('lat')),
          parseFloat(markerElem.getAttribute('lng')));

      var infowincontent = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = name
      infowincontent.appendChild(strong);
      infowincontent.appendChild(document.createElement('br'));

      var text = document.createElement('text');
      text.textContent = description+'   '+address
      infowincontent.appendChild(text);
      var icon = customLabel[type] || {};
      var mapOptions = {
        zoom: 13,
        center: point,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById('map'),
        mapOptions);
      var marker = new google.maps.Marker({
        map: map,
        position: point,
        label: icon.label,
        draggable:true
      });


      marker.addListener('mouseover', function() {
        infoWindow.setContent(address);
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
var x = markerElem.getAttribute('address').split(",");

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
  });


}
<?php }else { ?>

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
            text.textContent = description;


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
      <?php } ?>
      /*      */
      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }
      function doNothing() {}
      </script>
  </body>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

    </script>
</html>
