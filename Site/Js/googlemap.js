//AIzaSyDJesEcfS4a_1VHnKJRHbA-q2KceabVT2c
function LoadMap()
{
  var location={ lat: 41.015137, lng: 28.979530 };
  var map = new google.maps.Map(document.getElementById("map"), {
     center: location,
     zoom: 11
   });
var marker =new google.maps.Marker({
  position:location,
  map:map
});
}
