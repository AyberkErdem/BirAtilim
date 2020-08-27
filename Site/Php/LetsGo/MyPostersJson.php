<?php
include('config.php');
// Start XML file, create parent node
session_start();
$dom = new DOMDocument("1.0");
$node = $dom->createElement("poster");
$parnode = $dom->appendChild($node);
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
  $newnode->setAttribute("id","-1");
  $newnode->setAttribute("name",$_GET['user']);
  $newnode->setAttribute("description", "-1");
  $newnode->setAttribute("address", "-1");
  $newnode->setAttribute("lat", "-1");
  $newnode->setAttribute("lng", "-1");
  $newnode->setAttribute("type", "-1");


echo $dom->saveXML();

}
?>
