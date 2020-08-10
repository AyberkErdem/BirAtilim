<?php
require_once('config.php');
session_start();
if(isset($_POST['Harita']))
{
  $_SESSION['selection']='0';
}
if(isset($_POST['tablo']))
{
  $_SESSION['selection']='1';
}
if(isset($_POST['Go']))
{

  header("Location:Göster.php?user=".$_GET['user']."&subject=".$_POST['id']."");
}
if(isset($_POST['Ara']))
{
  if($_POST['search']!='')
  {
    $query=("select Count(*) from poster where Id='".$_POST['search']."'");
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
  if($row['Count(*)']!='0')  {

      header("Location:Göster.php?subject=".$_POST['search']."&user=".$_GET['user']."");
  }
  }
}
echo"<script>
function func(){
  window.location.href ='MyPage.php?user='+".$_GET['user'].";
}</script>"
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>BirAtilim</title>
      <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/Home.css">
   <script type="text/javascript" src="../Js/googlemap.js">

   </script>

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
  <input type="submit" name='Harita'value="Harita Görünümü" class=" btn btn-secondary">
  <input type="submit" name='tablo'value="Tablo Görünümü" class=" btn btn-secondary">
</form>
<?php
  if($_SESSION['selection']=='0'){
  ?>
  <div class="z-depth-1-half map-container" >

  <div id='map'class="map" >

  </div>
  </div>
<?php } ?>
<?php
  if($_SESSION['selection']=='1'){
  ?>
<table class="table table-hover">
<tr>
<th>İlan Sahibi</th>
<th>Resim</th>
<th>Açıklama</th>
<th>Adres</th>
<th>İlana Git</th>
</tr>
  <?php require_once('config.php');
  $sql = "SELECT * FROM poster where UserName='".$_GET['user']."' order by Id ASC";
    $result=@mysqli_query($dbc,$sql);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {?><tr>
          <?php
            echo "<td>".$row['UserName']."</td>
            <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
            <td>".$row['Description']."</td>
            <td>".$row['adress']."</td><td>
            <form class='' action='ilanlarım.php?user=".$_GET['user']."' method='post'>
            <input type='submit' name='Go' value='Git'/><input type='hidden' name='id' value=".$row['Id']."/></form></td>";
              ?></tr><?php
        }
      }
      else
      {
        echo"Nothing new here...";
      }
   ?>
</table>
<?php
}
 ?>
 <script type="text/javascript">


               //AIzaSyDJesEcfS4a_1VHnKJRHbA-q2KceabVT2c

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
                   downloadUrl('MyPostersJson.php?user=<?php echo $_GET['user']; ?>', function(data) {
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
                         label: icon.label
                       });


                       marker.addListener('mouseover', function() {
                         infoWindow.setContent(address);
                         infoWindow.open(map, marker);
               });
               marker.addListener('mouseout', function() {
                   infoWindow.close(map,marker);
               });  marker.addListener('click', function() {
                 //  sessionStorage.setItem("IlanNo", id);
                 var url_string =window.location.href; //window.location.href
                 var url = new URL(url_string);
                 var c = url.searchParams.get("user");
                 console.log(c);
               window.location="Göster.php?user="+c+"&subject="+id;
                 });

                     });
                   });

                 }

                 var getParams = function (url) {
                 	var params = {};
                 	var parser = document.createElement('a');
                 	parser.href = url;
                 	var query = parser.search.substring(1);
                 	var vars = query.split('&');
                 	for (var i = 0; i < vars.length; i++) {
                 		var pair = vars[i].split('=');
                 		params[pair[0]] = decodeURIComponent(pair[1]);
                 	}
                 	return params;
                 };

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
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

  </script>

</html>
