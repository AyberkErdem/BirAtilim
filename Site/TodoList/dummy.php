<?php
include "../Php/config.php";
if(isset($_POST['submit']))
{
  $filename=$_FILES['img']['name'];
  $tmpname=$_FILES['img']['tmp_name'];
  $filetype=$_FILES['img']['type'];
  for ($i=0; $i <=count($tmpname)-1 ; $i++) {
    $name=addslashes($filename[$i]);
    $tmp=addslashes(file_get_contents($tmpname[$i]));
    $query="insert into dummy values('','".$tmp."')";
    if(mysqli_query($dbc,$query))
    {
      echo "oldu";
    }
    else
    {
      echo "olmadı";
    }
  }
}
$res=mysqli_query($dbc,"select * from images");
while ($row=mysqli_fetch_array($res)) {
  echo "<img src='data:image/jpeg;base64,".base64_encode($row['Image2'])."' height='300' widht='100'/></div>";
}
?>
<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title></title>
  </head>
  <body>
<?php

 ?>
    <form id='upload_multiple_images' method='post' action='' enctype='multipart/form-data'>
    <input type='file' name='img[]' id="image" multiple/>
    <input type='submit' value='Insert' name='submit' />
  </form>
  </body>
</html>
