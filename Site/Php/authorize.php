<?php
require_once('config.php');
$query="update user set authorized='1' where Email='".$_GET['subject']."'";
if(mysqli_query($dbc,$query))
{
  header("location:index.php");
}
 ?>
