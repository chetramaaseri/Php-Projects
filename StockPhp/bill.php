<?php
session_start();
include('connection.php');
if (!$_SESSION['email']) {
    header("Location:{$HOSTADDRESS}/index.php");
}
$user_mail = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email= '$user_mail'";
$result = mysqli_query($connection, $sql) or die("Query Failed");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) { ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill receipt</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="profile">
        <span><?php echo ($_SESSION['email']) ?></span>
        <a href="logout.php"><button name="logout-user" class="logout-btn" type="submit">Log Out</button></a>
    </div>
    <div class="checkout-container">
        <div class="customer-detail">
            <span>Name:<?php echo (" " . $row['first_name'] . " " . $row['last_name']) ?></span>
            <span>Order Date: <?php echo date("d/m/Y") ?></span>
        </div>
        <?php 
            }
        } ?>
        <h1>Order receipt</h1>
        <table class="cart-list">
            <thead>
                <th>S.No.</th>
                <th>Stock Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $total_cartValue = 0;
                foreach ($_SESSION as $products) {
                    if($products== $_SESSION['email']){
                        continue;
                    }
                    if($products[2]==0){
                        continue;
                    }
                    $p = 0;
                    $q = 0;
                    ?>
                    <tr>
                        <td><?php echo($sno++) ?></td>
                        <?php foreach ($products as $key => $value) {
                            if ($key == 0) {
                                echo ("<td>{$value}</td>");
                            } elseif ($key == 1) {
                                echo ("<td>{$value}</td>");
                                $p = $value;
                            } else {
                                echo ("<td>$value</td>");
                                $q = $value;
                            }
                        }
                        $total_cartValue += $p * $q;
                        ?>
                        <td><?php echo($p*$q) ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
    <div class="final-total">
        <p>Bill Amount: </p><span><b><?php echo($total_cartValue) ?></b></span>
        <a href="clearCart.php"><button class="proceed-btn" type="submit">HOMEPAGE</button></a>
    </div>
    <!-- font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>