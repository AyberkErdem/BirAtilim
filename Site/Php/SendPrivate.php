<?php
include('config.php');

$query="call SendPrivate('".$_GET['user']."','".$_GET['Receiver']."','".$_GET['Message']."','".$_GET['PosterId']."')";
if(mysqli_query($dbc,$query))
{


  header("Location:MessageFrame.php?user=".$_GET['user']."&sender=".$_GET['Receiver']."");
}
else
{
    echo mysqli_error($dbc);

}

 ?>
