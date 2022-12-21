<?php
session_start();
if (!$_SESSION['email']) {
    include('connection.php');
    header("Location:{$HOSTADDRESS}/index.php");
}
if (isset($_POST['edit-cart'])) {
    $sname = $_POST['name0'];
    $quan = $_POST['name2'];
    $_SESSION[$sname][2] = $quan;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Items</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="profile">
        <span><?php echo ($_SESSION['email']) ?></span>
        <a href="logout.php"><button name="logout-user" class="logout-btn" type="submit">Log Out</button></a>
    </div>
    <a href="stock-buy.php"><button class="back-btn">Back</button></a>
    <div class="checkout-container">
        <h1>Cart items</h1>
        <table class="cart-list">
            <thead>
                <th>S.No.</th>
                <th>Stock Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Update</th>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $total_cartValue = 0;
                foreach ($_SESSION as $products) {
                    if($products== $_SESSION['email']){
                        continue;
                    }
                    $p = 0;
                    $q = 0;
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <tr>
                            <td><?php echo($sno++) ?></td>
                            <?php foreach ($products as $key => $value) {
                                if ($key == 0) {
                                    echo "<input type='hidden' name='name$key' value = '$value'>";
                                    echo ("<td>{$value}</td>");
                                } elseif ($key == 1) {
                                    echo ("<td>{$value}</td>");
                                    $p = $value;
                                } else {
                                    echo ("<td><input name='name$key' min=0 type='number' value='$value'></td>");
                                    $q = $value;
                                }
                            }
                            $total_cartValue += $p * $q;
                            ?>
                            <td><?php echo($p*$q) ?></td>
                            <td><button name="edit-cart" type="submit">Update<i class="fas fa-edit"></i></button></td>
                        </tr>
                     </form>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
    <div class="final-total">
        <p>Total Amount: </p><span><b><?php echo($total_cartValue) ?></b></span>
        <a href="bill.php"><button class="proceed-btn" type="submit">Order</button></a>
    </div>
 
    <!-- font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>