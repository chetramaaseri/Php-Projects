<?php
$invalid = 0;
$loginSucess = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connect.php');

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "Select * from `register` where username='$username' and password='$pass'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $loginSucess = 1;
            session_start();
            $_SESSION['username'] = $username;
            header('location:home.php');
            
        } else {
            if ($result) {
                $invalid = 1;
            }
        }
    }





}


?>






<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login page</title>
</head>

<body>

<?php
    if ($invalid) {
        echo '
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                Wrong username and password combination
            </div>
        </div>
        ';
    }
    if ($loginSucess) {
        echo '
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Login Sucessfull! Welcome here!
            </div>
        </div>
        ';
        
    }
    ?>
 

    <h1 class="text-center">Login here</h1>
    <div class="container my-5 p-5">
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name=password type="password" class="form-control" id="exampleInputPassword1" required>
                <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
            </div>
            <button style="width: 100%;" type="submit" class="btn btn-primary">login</button>
        </form>
        <a href="sign.php"><button style="width: 100%;" type="button" class="btn btn-primary mt-3">Create Account</button></a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>