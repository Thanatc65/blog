<?php
include('server.php');
$sel = mysqli_query($conn, "SELECT * FROM users");

$user = mysqli_fetch_assoc($sel);

$post = mysqli_query($conn, "SELECT * FROM posts order by id desc");
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
                    <a class="nav-link mr-3" href="user\login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="user\regist.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <div>
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <div class="container">
                    <?php while ($row = mysqli_fetch_array($post)) { ?>
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <?php
                                    $ui = $row["uid"];
                                    $s = mysqli_query($conn, "SELECT * FROM users where uid = '$ui'");
                                    $use = mysqli_fetch_assoc($s);
                                    ?>
                                    <?php if ($use["img"] == "") { ?>

                                        <img class="ml-4" src="profile.png" width="50px" height="50px" style="border-radius: 50%;">

                                    <?php } else { ?>

                                        <img class="ml-4" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($use["img"]); ?>" width="50px" height="50px" style="border-radius: 50%;">

                                    <?php } ?>
                                    <strong class="ml-4"><a href="#"><?php echo $use["name"] ?></a> <br><small><?php echo $row["time"] ?></small><br></strong>
                                    <img class="mt-3" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row["img"]); ?>" width="700px" height="700px">
                                    <div class="container">
                                        <h5 class="card-title mt-2 text-wrap"><?php echo $row["topic"] ?></h5>
                                        <p class="text-wrap" style="width: 90vh;">
                                            <?php echo $row["detail"] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
</body>

</html>