<?php
include('config.php');
session_start();
$query="call Delete_Messages('".$_SESSION['user']."','".$_GET['sender']."')";
if(mysqli_query($dbc,$query))
{
  header("location:MessageFrame.php?sender=".$_GET['sender']."");
}
else
{
  echo "bir boklar oldu";
}
 ?>
