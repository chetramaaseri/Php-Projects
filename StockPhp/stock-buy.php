<?php
session_start();
if (!$_SESSION['email']) {
    include('connection.php');
    header("Location:{$HOSTADDRESS}/index.php");
}

if (isset($_POST['add-cart'])) {
    $sname = $_POST['stock-name'];
    $sprice = $_POST['st-price'];
    $squan = $_POST['quantity'];
    $_SESSION[$sname] = array($sname, $sprice, $squan);
    echo "$sname x $squan Added Succesfully";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="profile">
        <span><?php echo ($_SESSION['email']) ?></span>
        <a href="logout.php"><button name="logout-user" class="logout-btn" type="submit">Log Out</button></a>
    </div>
    <?php
    include('connection.php');
    $sql = "SELECT * FROM stocksdata";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
    if (mysqli_num_rows($result) > 0) { ?>
    <div class="stock-container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <form class="product-container" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="stock-name" name="stock-name" type="text" value="<?php echo ($row['stock_name']) ?>">
            <div class="stock-details">
                <input class="st-price" name="st-price" type="text" value="<?php echo ($row['stock_price']) ?>">
                <span></span>
                <input type="number" name="quantity" min="1" value="1" id="stock-q">
            </div>
            <button type="submit" name="add-cart" class="add-cart">Add to Cart</button>
        </form>
        <?php
        }
    }
        ?>
    </div>
    <a href="checkout.php"><button class="checkout-btn" type="submit">Review</button></a>
</body>

</html>