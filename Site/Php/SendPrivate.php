<?php
include('config.php');
session_start();
$query="call SendPrivate('".$_SESSION['user']."','".$_GET['Receiver']."','".$_GET['Message']."','".$_GET['PosterId']."')";
if(mysqli_query($dbc,$query))
{


  header("Location:MessageFrame.php?user=".$_SESSION['user']."&sender=".$_GET['Receiver']."");
}
else
{
    echo mysqli_error($dbc);

}

 ?>
