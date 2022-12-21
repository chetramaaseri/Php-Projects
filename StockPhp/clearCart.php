<?php
session_start();
foreach ($_SESSION as $products) {
    if ($products == $_SESSION['email']) {
        continue;
    }
    unset($_SESSION[$products[0]]);
}
include('connection.php');
header("Location:{$HOSTADDRESS}/stock-buy.php");

?>