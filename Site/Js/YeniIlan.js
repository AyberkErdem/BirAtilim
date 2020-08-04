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
/*
var infowincontent="test";
var map, infoWindow;
      function initMap() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

        map = new google.maps.Map(document.getElementById('map'), {
          center: pos,
          zoom: 15
        });
        infoWindow = new google.maps.InfoWindow;
            var marker =new google.maps.Marker({
              position:pos,
              map:map,
              draggable:true
            });

          });
          marker.addListener('mouseover', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
      });
      marker.addListener('mouseout', function() {
        infoWindow.close(map,marker);
      });
      marker.addListener('click', function() {
        if(marker.draggable==false){
        marker.draggable=true;}
        else {
            marker.draggable=false;
        }
        infoWindow.setContent(position.coords.latitude+position.coords.longitude);
        infoWindow.open(map, marker);
      });
        }
        else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

      }

*/
/*
function getAddress(pos) {

  var geocoder	= new google.maps.Geocoder();							// create a geocoder object
  var location	= new google.maps.LatLng(pos);		// turn coordinates into an object

  geocoder.geocode({'latLng': location}, function (results, status) {
    if(status == google.maps.GeocoderStatus.OK) {						// if geocode success
      processAddress(results[0].formatted_address);					// if address found, pass to processing function
    } else {
      alert("Geocode failure: " + status);								// alert any other error(s)
      return false;
    }
  });
}
function processAddress(address) {
			$("#location-address").val(address);									// write address to field
			infowincontent = "I've got you at " + address;						// build string to speak
												// speak the address
		}
  */
/*
  function initMap() {
      var content;

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
  sessionStorage.setItem("Address",content);
});
        });
});
}
}
/*      *//*
function doNothing() {}
*/
