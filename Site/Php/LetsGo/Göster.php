<?php
include('config.php');
session_start();
$seen="update forum set Seen='1' where Receiver='".$_SESSION['user']."' and PosterId='".$_GET['subject']."'";
if (mysqli_query($dbc,$seen)) {

}
else
{
  echo "<script>alert('Mesajlar Güncellenemedi.');</script>";
}
if(isset($_POST['Yolla']))
{
  $query=("call Send('".$_SESSION['user']."','".$_GET['subject']."','".$_POST['price']."','".$_POST['mesaj']."');");
  if(mysqli_query($dbc,$query))
  {

echo"<script>window.location='Göster.php?subject=".$_GET['subject']."';</script>";
  }
  else
  {
    echo"<script>alert('mesajı atamadık(Mesaj 255 karakterden fazla olamaz)')</script>";
  }

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link style=" border-radius: 50%;" rel = "icon" href ="../Img/icon.png"
        type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/Göster.css">
        <meta name="description" content="Bir atilim">
        <meta name="author" content="Ayberk Erdem">
        <meta name="keywords" content="Bir atilim,Ayberk Erdem">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    <title>Bir atilim</title>
  </head>
  <body >
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
    <?php
$vosoblo=0;
    $sql = "CALL getPoster('".$_GET['subject']."')";
      $result=@mysqli_query($dbc,$sql);
        if ($result->num_rows > 0) {
          while($row=$result->fetch_assoc())
          {
            $date = date_create($row['Date']);
              echo "<div  class='container'>
              <div class='card bg-warning'>
                <div class='container-fliud'>
                  <div class='wrapper row'>
                    <div class='preview col-md-6'>

                      <div class='preview-pic tab-content'>
                        <div class='tab-pane active' id='pic-1'><img src='data:image/jpeg;base64,".base64_encode($row['Image0'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-2'><img src='data:image/jpeg;base64,".base64_encode($row['Image1'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-3'><img src='data:image/jpeg;base64,".base64_encode($row['Image2'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-4'><img src='data:image/jpeg;base64,".base64_encode($row['Image3'])."' height='300' widht='100'/></div>
                        <div class='tab-pane' id='pic-5'><img src='data:image/jpeg;base64,".base64_encode($row['Image4'])."' height='300' widht='100'/></div>
                      </div>
                      <ul class='preview-thumbnail nav nav-tabs'>
                        <li class='active'><a data-target='#pic-1' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image0'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-2' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image1'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-3' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image2'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-4' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image3'])."' height='56' widht='55'/></a></li>
                        <li><a data-target='#pic-5' data-toggle='tab'><embed src='data:image/jpeg;base64,".base64_encode($row['Image4'])."' height='56' widht='55'/></a></li>
                      </ul>

                    </div>
                    <div class='details col-md-6'>
                    <ul class='nav nav-tabs' id='myTab' role='tablist'>
                        <li class='nav-item'>
                            <a  class='nav-link active text-light bg-primary' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>İlan Detayı</a>
                        </li>
                        <li class='nav-item'>
                            <a style='background-color:#88001b;' class='nav-link text-light ' id='profile-tab' data-toggle='tab' href='#location' role='tab' aria-controls='profile' aria-selected='false'>Lokasyon</a>
                        </li>
                        <div class='col-md-6'>
                          <p class='text-primary'>Favori       <input type='checkbox' onclick='Favourite()' id='favori' value='Favori işaretle' onload='checkFav()'></p>
                        </div>
                          <div class='col-md-6'>
                            </div>

                    </ul>
                    <div class='tab-content profile-tab' id='myTabContent'>
                    <div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>
                      <h3 class='product-title'>Buraya Filtre İçeriği Gelir</h3>
                      <p class='product-description'> ".$row['Description']." </p>
                        <h4 class='price'>İlan Yayın Tarihi</h4>

                        <p class='product-description'> " .date_format($date, 'd-m-Y')." </p>
                      <h4 class='price'>İlan Sahibi</h4>
                      <p class='product-description'> ".$row['UserName'].""; if($_SESSION['user']==$row['UserName']){echo "<a class='text-primary' style='text-decoration:none;' href='Eye.php?user=".$_SESSION['user']."&eye=".$row['UserName']."'> --> Başkasının Gözünden Gör
                        </a>  <div class='col-md-6'>
                            <p class='float-right'>
                            <button class='btn btn-primary' onclick='Edit()' id='Edit' >Düzenle</button>

                            <button style='background-color:#88001b;' class='btn text-light'  onclick='Complete()' id='Complete' >Tamamla</button></p>
                          </div><div class='col-md-6'>
                              <p class='float-right'><button title='";if($row['Visible']==0){echo "Fiyatları sadece ilan sahibi ve gönderen görüntüler";}else{echo "Fiyatlar herkes görebilir";}echo "' class='btn btn-primary' ondblclick='OpenUp()' id='Edit' >Açık Arttırma Modu:";if($row['Visible']==0){echo "On";}else {echo "Off";}echo "</button> </p>
                            </div>";} else {echo "<a class='text-primary' style='text-decoration:none;' href='Eye.php?user=".$_SESSION['user']."&eye=".$row['UserName']."'> --> İlan Sahibi Profili
                        </a>";}
                        echo"
                         </p>
                      </div>
                      <div class='tab-pane fade ' id='location' role='tabpanel' aria-labelledby='location-tab'>
                        <h3 class='product-title'>Açık Adres</h3>

                        <p class='product-description'> ".$row['adress']." </p>
                        <div class='z-depth-1-half map-container' >

                        <div id='map'class='map' >

                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              ";
            $vosoblo=$row['Visible'];}

            }
            mysqli_free_result($result);
          $dbc->next_result();
        echo"
                <div style='display:block;' class='wrapper row'>
                  <div style='width: 650px;height:200px;overflow:auto;' >
                     <table  class='table table-striped custab'>
                     <thead>
                         <tr>
                             <th>Sender</th>
                             <th>Message</th>
                              <th>Value</th>
                             <th>Date</th>
                         </tr>
                     </thead>";


                     $query = "CALL getChat('".$_GET['subject']."','".$_SESSION['user']."')";
                       $result=@mysqli_query($dbc,$query);
                       echo mysqli_error($dbc);
                         if ($result ->num_rows > 0) {

                             while($row=$result->fetch_assoc())
                             {

                               echo "<tr>";if($_SESSION['user']==$row['Sender']){echo "<td class='text-danger' style='font-size:0.7em;'>".$row['Sender']."</td>";}
                               else {echo "<td style='font-size:0.7em;'>".$row['Sender']."</td>";}
                                echo"
                                   <td style='font-size:0.7em;'>".$row['Message']."</td>
                                   <td style='font-size:0.7em;'>";if(($_SESSION['user']==$row['Sender']||$_SESSION['user']==$row['Receiver'])||$vosoblo==1){echo $row['Value'];}else{echo "*";}echo"</td>
                                   <td style='font-size:0.7em;'>".$row['Date']."</td>
                               </tr>";

                             }
                           }
                           else
                           {
                             echo"İlk Mesajı Siz Atın";
                           }
                                $result->close();
                        ?>
                     </table>
                     </div>

                <br>
                  <div class='wrapper row'>
                    <div border='1' class='col-md-8'>
         <form class="" action="Göster.php?subject=<?php echo $_GET['subject'];?>" method='post'>
           <div class="input-controls-container expand">
              <textarea name="mesaj" style="resize:none;" class="form-control" placeholder="Enter Message"> </textarea>
          <br>
          </div>
                <input style="width:200px" name="price" type="number" placeholder="Fiyat Biçin" value="" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
             <input type='submit' name='Yolla' value='Gönder'>
         </form>
</div>
</div>

       </div>
              </div>;
<script type="text/javascript">
function OpenUp()
{
  var url_string =window.location.href; //window.location.href
  var url = new URL(url_string);
  var c = url.searchParams.get("subject");
  window.location="IlanVisibleSetter.php?subject="+c;
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
$("#DivTablo").hide();
function f1(objButton){

            $("#map, #DivTablo").hide();

            $("#" + $(objButton).val()).show();
  }
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
                        label: icon.label
                      });


                      marker.addListener('mouseover', function() {
                        infoWindow.setContent(address);
                        infoWindow.open(map, marker);
              });
              marker.addListener('mouseout', function() {
                  infoWindow.close(map,marker);
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
  <script type="text/javascript">
  window.onload = checkFav();
  function Complete()
  {

      var txt;

        var url_string =window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.get("subject");
        window.location="Complete.php?subject="+c;


    }

function Edit()
{
  var url_string =window.location.href; //window.location.href
  var url = new URL(url_string);
  var c = url.searchParams.get("subject");
  window.location="YeniIlan.php?subject="+c;
}

  function Favourite()
  {

    var Name='<?php echo $_SESSION['user']; ?>';

    if (document.getElementById('favori').checked)
    {
      var credit=getCookie(Name);
      if(credit=="")
      {
        setCookie(Name,'<?php echo $_GET['subject']; ?>',30);
      }
      else
      {
        setCookie(Name,credit+","+'<?php echo $_GET['subject']; ?>',30);
      }



    } else {
      var str=getCookie(Name);
      var x=str.search(",");
      if(x!="-1")
      {
        if(str.replace(","+'<?php echo $_GET['subject']; ?>', "")!=str)
        {
      var credit=str.replace(","+'<?php echo $_GET['subject']; ?>', "");
      deleteCookie(Name);
      setCookie(Name,credit,30);

        }
        else if(str.replace(","+'<?php echo $_GET['subject']; ?>', "")==str)
        {
      var credit=str.replace('<?php echo $_GET['subject']; ?>', "");
      deleteCookie(Name);
      setCookie(Name,credit,30);

        }
      }
        else
        {
              setCookie(Name,"",30);

        }

    }
  }
  function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
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
function deleteCookie(namex)
{

  document.cookie = namex + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

}
function checkFav()
{
  var str=getCookie('<?php echo $_SESSION['user'] ?>');

  var x=str.search("<?php echo $_GET['subject'] ?>");

  if(x!="-1")
  {

    document.getElementById("favori").checked=true;
  }
  else if(x==-1)
  {
        document.getElementById("favori").checked=false;
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
  </script>
  <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCd7903K8KvYDLjq_A_J3vMe4eKDPSNU&callback=initMap">

    </script>
</html>
