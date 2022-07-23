<?php
include('..\server.php');

if (isset($_POST['regist'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password == $password2) {

        $set = "INSERT into users(name, email, password,uid) VALUES('$name','$email','$password','$uid')";
        $query = mysqli_query($conn, $set);

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['uid'] = $uid;

        header("Location: ../dashboard/dashboard.php");
    } else {
        echo "<script>alert('password mismatch')</script>";
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
                <li class="nav-item">
                    <a class="nav-link mr-3" href="login.php">Login</a>
                </li>
                <li class="nav-item active">
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
                        <h1 class="mt-2 text-center ">Register</h1>
                        <form action="regist.php" method="post">
                            <input type="hidden" name="uid" id="uid">
                            <div class="form-group mt-5">
                                name:
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                Email:
                                <input class="form-control" type="text" name="email">
                            </div>
                            <div class="form-group">
                                password:
                                <input class="form-control" type="text" name="password" id="p1">
                            </div>
                            <div class="form-group">
                                password2:
                                <input class="form-control" type="text" name="password2" id="p2">
                            </div>
                            <button class="btn btn-primary w-100 mt-5" type="submit" name="regist">Regist</button>
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
    document.getElementById("uid").value = makeid(5);

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }
</script>

</html>