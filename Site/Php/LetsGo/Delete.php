<?php
include('config.php');
$query="call  `Delete`('".$_GET['subject']."')";
if(mysqli_query($dbc,$query))
{
  header("Location:Home.php");
}
else
{
echo mysqli_error($dbc);
}

 ?>
