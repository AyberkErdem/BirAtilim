<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="result"></div>
  <script>
    document.getElementById("result").innerHTML = sessionStorage.getItem("IlanNo");
    window.location="Pass2.php?subject="+sessionStorage.getItem("IlanNo");
  </script>
  </body>
</html>
