<?php
require_once('config.php');
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("poster");
$parnode = $dom->appendChild($node);
$query = "SELECT * FROM poster where UserName='".$_GET['user']."'";
$result=@mysqli_query($dbc,$query);
if ($result ->num_rows > 0) {



header("Content-type: text/xml");
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("poster");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id",$row['Id']);
  $newnode->setAttribute("name",$row['UserName']);
  $newnode->setAttribute("description", $row['Description']);
  $newnode->setAttribute("address", $row['adress']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("type", $row['type']);
}

echo $dom->saveXML();
}
else
{
  $node = $dom->createElement("poster");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id","0");
  $newnode->setAttribute("name",$_GET['user']);
  $newnode->setAttribute("description", "");
  $newnode->setAttribute("address", "");
  $newnode->setAttribute("lat", "");
  $newnode->setAttribute("lng", "");
  $newnode->setAttribute("type", "");


echo $dom->saveXML();

}
?>
