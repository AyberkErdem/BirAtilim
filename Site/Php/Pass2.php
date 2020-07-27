<?php
session_start();
$_SESSION['IlanNo']=$_GET['subject'];
header("location:Göster.php");
 ?>
