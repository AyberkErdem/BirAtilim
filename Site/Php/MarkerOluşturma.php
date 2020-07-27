<?php
require_once('config.php');
if(isset($_POST['submit']))
{
  $address=$_POST['address'];
  ?>
  <iframe src="https://maps.google.com/maps?q=
  <?php
   $query=("select * from poster ");
   $result = mysqli_query($dbc,$query);
   while ($row = @mysqli_fetch_assoc($result)){
    echo $row['adress'];
  };?>
    &output=embed" width="100%" height="500"></iframe>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="MarkerOluşturma.php" method="post">
      <input type="text" name="address" value="">
      <input type="submit" name="submit" value="bas">
    </form>
  </body>
</html>
