<?php
$file = "users.json";
   $arr = array(
       'name'     => "key",
       'email'    => "hey",
       'phone'    => "bey"
   );
   $json_string = json_encode($arr);
   file_put_contents($file, $json_string);
   echo $json_string;

    ?>
