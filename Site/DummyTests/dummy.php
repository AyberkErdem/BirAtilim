<?php
require_once('../Php/config.php');
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("chat");
$parnode = $dom->appendChild($node);
$query = "SELECT * FROM chat";
$result = mysqli_query($dbc,$query);


header("Content-type: text/xml");
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("Messages");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("Sender",$row['Sender']);
  $newnode->setAttribute("Message",$row['Message']);
  $newnode->setAttribute("Receiver", $row['Receiver']);
  $newnode->setAttribute("PosterId", $row['PosterId']);
  $newnode->setAttribute("Date", $row['Clock']);

}

echo $dom->saveXML();
 ?>
