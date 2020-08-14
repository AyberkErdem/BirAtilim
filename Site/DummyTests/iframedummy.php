<?php

$xml = simplexml_load_file('users.xml');

echo '<h2>Employees Listing</h2>';

$list = $xml->record;

for ($i = 0; $i < count($list); $i++) {

    echo '<b>Man no:</b> ' . $list[$i]->attributes()->man_no . '<br>';

    echo 'Name: ' . $list[$i]->name . '<br>';

    echo 'Position: ' . $list[$i]->position . '<br><br>';

}

$file = 'users.xml';

$xml = simplexml_load_file($file);

$galleries = $xml->galleries;
echo "$galleries";
$gallery = $galleries->addChild('employees');
$gallery->addChild('Name', 'sender');
$gallery->addChild('Message', 'messsage');
$gallery->addChild('Receiver', 'messsage');
$gallery->addChild('Date', 'mythumb.jpg');

$xml->asXML($file);

?>
