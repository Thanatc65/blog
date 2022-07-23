<?php
include('..\server.php');

if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];

$sel = mysqli_query($conn , "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
if(mysqli_num_rows($sel) == 1){
$user = mysqli_fetch_assoc($sel);

$_SESSION['uid'] = $user['uid'];
$_SESSION['name'] = $user['name'];
$_SESSION['email'] = $user['email'];

header('Location: ../dashboard/dashboard.php');
}else{
    echo "<script>alert('Wrong email or password')</script>";
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link mr-3" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="regist.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <div>
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-4">
                <div class="card mt-5">
                    <div class="container">
                        <h1 class="mt-2 text-center ">Login</h1>
                        <form action="" method="post">
                            <div class="form-group mt-5" style="margin-right: 35px;">
                                E-mail:
                                <input class="form-control" type="text" name="email">
                            </div>
                            <div class="form-group">
                                password:
                                <div class="input-group mb-3 align-items-center">
                                    <input type="password" class="form-control" name="password" id="tran">
                                    <div class="input-group-append ml-3">
                                        <a href="#" class="text-secondary" id="show" onclick="s()" ondblclick="d()">
                                            <i class="fa-solid fa-eye fa-1x"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 mt-5" type="submit" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
</body>
<script>
    function s() {
        if (document.getElementById('tran').type = 'password') {
            document.getElementById('tran').type = 'text';
        }
    }
    function d() {
        if (document.getElementById('tran').type = 'text') {
            document.getElementById('tran').type = 'password';
        }
    }
</script>

</html>