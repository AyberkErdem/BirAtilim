<?php
$input = preg_quote('black', '~'); // don't forget to quote input string!
$data = array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');

$result = preg_grep('~' . $input . '~', $data);
print_r($result);
$x=array_search("black",$result);

echo "|||||".$x;
unset($data[$x]);
print_r($data);
?>
