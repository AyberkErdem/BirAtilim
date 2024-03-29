//AIzaSyDJesEcfS4a_1VHnKJRHbA-q2KceabVT2c
function notifyMe() {
// Let's check if the browser supports notifications
if (!("Notification" in window)) {
alert("This browser does not support desktop notification");
}

// Let's check whether notification permissions have already been granted
else if (Notification.permission === "granted") {
// If it's okay let's create a notification

}

// Otherwise, we need to ask the user for permission
else if (Notification.permission !== "denied") {
Notification.requestPermission().then(function (permission) {
  // If the user accepts, let's create a notification
  if (permission === "granted") {
    var notification = new Notification("Tanışıyor muyuz beybi neyse hoşgelmişsin.");
  }
});
}

// At last, if the user has denied notifications, and you
// want to be respectful there is no need to bother them any more.
}
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
var periskop=0;
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
function handlePermission() {
navigator.permissions.query({name:'geolocation'}).then(function(result) {
  if (result.state == 'granted') {
    report(result.state);
periskop=1;

  } else if (result.state == 'prompt') {
    report(result.state);

    navigator.geolocation.getCurrentPosition(revealPosition,positionDenied,geoSettings);
  } else if (result.state == 'denied') {
    report(result.state);

  }
  result.onchange = function() {
    report(result.state);
  }
});
}

function report(state) {
console.log('Permission ' + state);
}

function initMap() {
  var gm = google.maps;
  var config = {
      el: 'map',
      lat: 37.4419,
      lon: -122.1419,
      zoom: 15,
      minZoom: 20,
      type: google.maps.MapTypeId.ROADMAP
  };
  var spiderConfig = {
    arkersWontMove: true, markersWontHide: true, keepSpiderfied: true, circleSpiralSwitchover: 40
  };
       var cluster = [];
  var myLatlng1 = new google.maps.LatLng(53.65914, 0.072050);
              var mapOptions = {
                zoom: 13,
                center: myLatlng1,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true

              };
       var map = new google.maps.Map(document.getElementById('map'),
         mapOptions);
         var oms = new OverlappingMarkerSpiderfier(map, spiderConfig);

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
           markers[i].getAttribute("address")+
           markers[i].getAttribute("description");

           var icon = customIcons[type] || {};
           var marker = new google.maps.Marker({
             map: map,
             position: point,
             icon: icon.customIcons,
           });
           google.maps.event.addListener(marker, 'dblclick', (function(marker, i) {
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

                             window.location="Göster.php?subject="+markers[i].getAttribute("id");
                             //This sends information from the clicked icon back to the serverside code
                             document.getElementById("setlatlng").innerHTML = markers[i].getAttribute("name");
                         }
                     })(marker, i));
                     google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                                   return function() {
                                       infowindow.setContent(
                                         markers[i].getAttribute("description") +
                                    "</b> <br/>" +
                                       markers[i].getAttribute("name") +
                                       "</b> <br/>" +
                                       markers[i].getAttribute("address")+"</b> <br/>"
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
           oms.addMarker(marker);

               var padder = document.createElement('div');
               padder.style.height = '100px';
               padder.style.width = '100%';
               map.controls[google.maps.ControlPosition.TOP_CENTER].push(padder);
         }

         var options = {
               imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
                maxZoom: 20
           };

         var mc = new MarkerClusterer(map,cluster,options);
         mc.setMaxZoom(config.minZoom);
       });
       var iw =new google.maps.InfoWindow();
       oms.addListener('mouseover', function(marker, event) {
              iw.setContent(marker.desc);
              iw.open(map, marker);
          });
          oms.addListener('spiderfy', function(markers) {
              iw.close();
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
