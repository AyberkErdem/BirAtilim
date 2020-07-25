<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'AyberkErdem');
define('DB_NAME', 'BirAtilim');

/* Attempt to connect to MySQL database */
$dbc = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($dbc === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
