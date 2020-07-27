//AIzaSyDJesEcfS4a_1VHnKJRHbA-q2KceabVT2c
function LoadMap()
{
  var location={ lat: 41.015137, lng: 28.979530 };
  var map = new google.maps.Map(document.getElementById("map"), {
     center: location,
     zoom: 11
   });
var marker =new google.maps.Marker({
  position:{ lat: 10,20, lng: 10,20 },
  map:map
});
}
function downloadUrl(url,callback) {
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
