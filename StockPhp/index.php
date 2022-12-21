<?php
session_start();
if(isset($_SESSION['email'])){
    include('connection.php');
    header("Location:{$HOSTADDRESS}/stock-buy.php");
}
if(isset($_POST['login'])){
    include('connection.php');
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,md5($_POST['password']));

    $sql = "SELECT email FROM user WHERE email = '{$email}' AND password = '${password}'";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
    if (mysqli_num_rows($result)>0) {
        $_SESSION['email'] = $email;
        header("Location:{$HOSTADDRESS}/stock-buy.php");
    }else{
        echo ("<p style='color:red;text-align:center;margin: 10px 0'>Combination doesn't exists</p>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login: Stocks Wolrd</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="text-field">
                <input type="email" name="email" id="" required>
                <label for="">Email</label>
            </div>
            <div class="text-field">
                <input type="text" name="password" id="" required>
                <label for="">Password</label>
            </div>
            <button type="submit" class="button" name="login">Login</button>
            <div class="signup_link">
                Not a member? <a href="./signup.php">Signup</a>
            </div>
        </form>
    </div>
</body>
</html>