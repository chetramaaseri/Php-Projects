<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'stock';

$HOSTADDRESS = 'http://localhost/projects/Php%20Projects/StockPhp';
$connection = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if(!$connection){
    die(mysqli_connect_error()($connection));
}
?>