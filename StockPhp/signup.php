<?php
if(isset($_SESSION['email'])){
    include('connection.php');
    header("Location:{$HOSTADDRESS}/stock-buy.php");
}
if(isset($_POST['signup'])){
    include('connection.php');
    $fname = mysqli_real_escape_string($connection,$_POST['fname']);
    $lname = mysqli_real_escape_string($connection,$_POST['lname']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,md5($_POST['password']));

    $sql = "SELECT email FROM user WHERE email = '{$email}'";
    $result = mysqli_query($connection, $sql) or die("Query Failed");
    if (mysqli_num_rows($result)>0) {
        echo ("<p style='color:red;text-align:center;margin: 10px 0'>Email Already Exits</p>");
    }else{
        $sql1 = "INSERT INTO user (first_name, last_name, email, password) VALUES ('{$fname}', '{$lname}', '{$email}', '{$password}')";
        if(mysqli_query($connection,$sql1)){
            header("Location:{$HOSTADDRESS}/index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Stocks Wolrd</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="signup-container">
        <h1>Sign up</h1>
        <!-- ----------------------------------------------------------------- -->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="text-field">
                <input type="text" name="fname" id="" required>
                <label for="">First_Name</label>
            </div>
            <div class="text-field">
                <input type="text" name="lname" id="" required>
                <label for="">Last_Name</label>
            </div>
            <div class="text-field">
                <input type="email" name="email" id="" required>
                <label for="">Email</label>
            </div>
            <div class="text-field">
                <input type="text" name="password" id="" required>
                <label for="">Password</label>
            </div>
            <button type="submit" class="button" name="signup">Signup</button>
            <div class="signup_link">
                Already a member? <a href="./index.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>