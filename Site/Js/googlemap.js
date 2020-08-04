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

       var mapOptions = {
         zoom: 10,
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
  var infoWindow = new google.maps.InfoWindow;

    // Change this depending on the name of your PHP or XML file
    downloadUrl('Adresler.php', function(data) {
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
        var marker = new google.maps.Marker({
          map: map,
          position: point,
          label: icon.label
        });
        marker.addListener('mouseover', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, marker);
});
marker.addListener('mouseout', function() {
    infoWindow.close(map,marker);
});
        marker.addListener('click', function() {
          sessionStorage.setItem("IlanNo", id);
    window.location="Pass.php";
        });
      });
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
