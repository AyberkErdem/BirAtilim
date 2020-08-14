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
       downloadUrl('Adresler.php', function(data) {
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

                             //This sends information from the clicked icon back to the serverside code
                             document.getElementById("setlatlng").innerHTML = markers[i].getAttribute("name");
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
