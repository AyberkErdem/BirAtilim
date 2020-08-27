<?php
include('config.php');
$query="call Visible_Setter(".$_GET['subject'].")";
if(mysqli_query($dbc,$query))
{
  header("location:Göster.php?subject=".$_GET['subject']."");
}
else
{
  echo "Bir boklar Oldu";
}
 ?>
