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

  header("Location:Göster.php?subject=".$_POST['id']."");
}
if(isset($_POST['Ara']))
{
  if($_POST['search']!='')
  {
    $query=("select Count(*) from poster where Id='".$_POST['search']."'");
    $response=@mysqli_query($dbc,$query);
    $row=$response->fetch_assoc();
  if($row['Count(*)']!='0')  {

      header("Location:Göster.php?subject=".$_POST['search']."");
  }
  }
}
echo"<script>
function func(){
  window.location.href ='MyPage.php';
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
                    <a href="Mesajlar.php" class="nav-link m-2 btn btn-warning">Mesajlar</a>
                </li>
                <li class="nav-item">
                    <a href="MyPage.php" class="nav-link m-2 btn btn-warning">Ayarlarım</a>
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
<form class="text-center" action="ilanlarım.php?<?php if(isset($_GET['favori'])){echo "favori=".$_GET['favori'].""; } ?>" method="post">
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

  if(isset($_GET['favori']))
  {
    if($_GET['favori']=="")
    {
      $_GET['favori']="-1";
    }
    $sql = "select * from poster where Id IN(".$_GET['favori'].") order by Id ASC";
  }
  else
  {
    $sql = "select * from poster where UserName='".$_SESSION['user']."' order by Id ASC";
  }
    $result=@mysqli_query($dbc,$sql);
       echo mysqli_error($dbc);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {?><tr>
          <?php
            echo "<td>".$row['UserName']."</td>
            <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
            <td>".$row['Description']."</td>
            <td>".$row['adress']."</td><td>
            <form class='' action=";if(isset($_GET['favori'])){echo "ilanlarım.php?favori=".$_GET['favori']."";}else {echo "ilanlarım.php";} ;echo" method='post'>
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
               var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
               function initMap() {
                      var cluster = [];
                 var myLatlng1 = new google.maps.LatLng(53.65914, 0.072050);
                             var mapOptions = {
                               zoom: 13,
                               center: myLatlng1,
                               mapTypeId: google.maps.MapTypeId.ROADMAP
                             };
                      var map = new google.maps.Map(document.getElementById('map'),
                        mapOptions);

                      if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                          initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                          map.setCenter(initialLocation);
                        });
                      }
                var infowindow = new google.maps.InfoWindow();

                      // Change this depending on the name of your PHP file
                      downloadUrl('MyPostersJson.php?<?php if(isset($_GET['favori'])){echo "favori=".$_GET['favori']."";}?>', function(data) {
                        var xml = data.responseXML;
                        var markers = xml.documentElement.getElementsByTagName("poster");
                        for (var i = 0; i < markers.length; i++) {
                              var id = markers[i].getAttribute('id');
                          var name = markers[i].getAttribute("name");
                          var address = markers[i].getAttribute("address");
                              var description =  markers[i].getAttribute('description');
                          var type = markers[i].getAttribute("type");
                          var point = new google.maps.LatLng(
                              parseFloat(markers[i].getAttribute("lat")),
                              parseFloat(markers[i].getAttribute("lng")));

                          var html= "<b>" +
                          markers[i].getAttribute("name") +
                          "</b> <br/>" +
                          markers[i].getAttribute("address");

                          var icon = customIcons[type] || {};
                          var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            icon: icon.customIcons,
                          });
                          google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                        return function() {
                                            infowindow.setContent(
                                            "<b>" +
                                            markers[i].getAttribute("name") +
                                            "</b> <br/>" +
                                            markers[i].getAttribute("address")
                                            );
                                            infowindow.open(map, marker);
                                            var url_string =window.location.href; //window.location.href
                                            var url = new URL(url_string);
                                            var c = url.searchParams.get("user");
                                            window.location="Göster.php?user="+c+"&subject="+markers[i].getAttribute("id");
                                            //This sends information from the clicked icon back to the serverside code
                                            document.getElementById("setlatlng").innerHTML = markers[i].getAttribute("name");
                                        }
                                    })(marker, i));
                                    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                                                  return function() {
                                                      infowindow.setContent(
                                                      "<b>" +
                                                      markers[i].getAttribute("name") +
                                                      "</b> <br/>" +
                                                      markers[i].getAttribute("address")
                                                      );
                                                      infowindow.open(map, marker);

                                                  }
                                              })(marker, i));
                                              google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
                                                            return function() {
                                                                 infowindow.close(map,marker);

                                                            }
                                                        })(marker, i));
                          cluster.push(marker);
                        }

                        var options = {
                              imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                          };

                        var mc = new MarkerClusterer(map,cluster,options);
                      });

                    }

                    function bindInfoWindow(marker, map, infoWindow, html) {
                      google.maps.event.addListener(marker, 'click', function() {
                        infoWindow.setContent(html);
                        infoWindow.open(map, marker);

                      });
                    }

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
  <script type="text/javascript">
  window.onload = checkFav();



  function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=../DummyTests/";
}
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {

      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {

      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function deleteCookie(name)
{

  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

}
function checkFav()
{
  var str=getCookie("favori");
  var x=str.search("<?php echo $_GET['subject']; ?>");
  if(x!="-1")
  {
    document.getElementById("favori").checked=true;
  }
}
function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
  </script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

  </script>

</html>
