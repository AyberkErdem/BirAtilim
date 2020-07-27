<?php
session_start();

if(isset($_POST['Go']))
{
  $_SESSION['IlanNo']=$_POST['id'];
  header("Location:Göster.php");
}
if(isset($_POST['Ilan']))
{
  header("location:Adresler.php");
}
function get_all_locations(){
  require_once('config.php');
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($dbc,"select * from poster");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
  $indexed = array_map('array_values', $rows);
  //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
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
    <title>BirAtilim</title>
    <link rel="stylesheet" type="text/css" href="../css/İlan.css">
   <script type="text/javascript" src="../Js/googlemap.js">

   </script>
   <script>

      var i ; var confirmed = 0;
      for (i = 0; i < locations.length; i++) {

          marker = new google.maps.Marker({
              position: new google.maps.LatLng(0,0),
              map: map,
              icon :  red_icon,
              html: document.getElementById("map")
          });


  }

   </script>
  </head>
  <body>
  <div class="googlearea" border="1px" height="200px" >
        <center><h1>Select Your Location</h1></center>
  <div id='map'class="map" >

  </div>
  </div>
<form class="" action="Home.php" method="post">
  <input type="submit" name="Ilan" value="İlan Oluştur">
</form>
<table>
<tr>
<th>İlan Sahibi</th>
<th>Resim</th>
<th>Açıklama</th>
<th>Adres</th>
<th>İlana Git</th>
</tr>
  <?php require_once('config.php');
  $sql = "SELECT * FROM poster  order by Id ASC";
    $result=@mysqli_query($dbc,$sql);
      if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc())
        {?><tr>
          <?php
            echo "<td>".$row['UserName']."</td>
            <td><embed src='data:image/jpeg;base64,".base64_encode($row['Image'])."' height='150' widht='100'</td>
            <td>".$row['Description']."</td>
            <td>".$row['adress']."</td><td>
            <form class='' action='Home.php' method='post'>
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
  </body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=LoadMap">

  </script>
  <script type="text/javascript">
              //Sample code written by August Li
              var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
                         new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                         new google.maps.Point(16, 32));
              var center = null;
              var map = null;
              var currentPopup;
              var bounds = new google.maps.LatLngBounds();
              function addMarker(lat, lng, info) {
                  var pt = new google.maps.LatLng(lat, lng);
                  bounds.extend(pt);
                  var marker = new google.maps.Marker({
                      position: pt,
                      icon: icon,
                      map: map
                  });
                  var popup = new google.maps.InfoWindow({
                      content: info,
                      maxWidth: 300
                  });
                  google.maps.event.addListener(marker, "click", function() {
                      if (currentPopup != null) {
                          currentPopup.close();
                          currentPopup = null;
                      }
                      popup.open(map, marker);
                      currentPopup = popup;
                  });
                  google.maps.event.addListener(popup, "closeclick", function() {
                      map.panTo(center);
                      currentPopup = null;
                  });
              }
              function initMap() {
                  map = new google.maps.Map(document.getElementById("map"), {
                      center: new google.maps.LatLng(0, 0),
                      zoom: 14,
                      mapTypeId: google.maps.MapTypeId.ROADMAP,
                      mapTypeControl: true,
                      mapTypeControlOptions: {
                          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                      },
                      navigationControl: true,
                      navigationControlOptions: {
                          style: google.maps.NavigationControlStyle.ZOOM_PAN
                      }
                  });
  <?php
  $query = mysqli_query("SELECT * FROM poster")or die(mysqli_error());
  while($row = mysqli_fetch_array($query))
  {
    $name = $row['UserName'];
    $lat = $row['lat'];
    $lon = $row['lon'];
    $desc = $row['desc'];



    echo("addMarker($lat, $lon, '<b>$name</b><br />$desc');\n");

  }

  ?>
   center = bounds.getCenter();
       map.fitBounds(bounds);

       }
       </script>
</html>
