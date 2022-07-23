<?php
include('..\server.php');
$uid = $_SESSION['uid'];
$sel = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$uid'");

$user = mysqli_fetch_assoc($sel);

$post = mysqli_query($conn, "SELECT * FROM posts WHERE uid = '$uid' order by id desc");

if (isset($_GET["del"])) {
    $id = $_GET["del"];

    mysqli_query($conn, "DELETE FROM posts WHERE id = '$id'");

    header("Location: profile.php");
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
                    <a class="nav-link mr-3" href="..\dashboard\dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="..\dashboard\add.php">Add Post</a>
                </li>
                <li class="nav-item mr-3">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if ($user["img"] == "") { ?>

                            <img src="../profile.png" width="30px" height="30px" style="border-radius: 50%;">

                        <?php } else { ?>

                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($user["img"]); ?>" width="30px" height="30px" style="border-radius: 50%;">

                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="container">
                            <?php if ($user["img"] == "") { ?>

                                <img src="../profile.png" width="60px" height="60px" style="border-radius: 50%;  display: block;margin-left: auto;margin-right: auto;">

                            <?php } else { ?>

                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($user["img"]); ?>" width="60px" height="60px" style="border-radius: 50%;  display: block;margin-left: auto;margin-right: auto;">

                            <?php } ?>
                            <p class="text-center"><?php echo $user["name"]; ?><br><small class="text-primary">uid : <?php echo $user["uid"]; ?></small></p>
                            <hr>
                        </div>
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <a class="dropdown-item" href="setting.php">Setting</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8">
            <div class="card mt-2">
                <?php if ($user["img"] == "") { ?>

                    <img src="../profile.png" width="200px" height="200px" style="margin-top: 5vh; border-radius: 50%;  display: block;margin-left: auto;margin-right: auto;">

                <?php } else { ?>

                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($user["img"]); ?>" width="200px" height="200px" style="margin-top: 5vh; border-radius: 50%;  display: block;margin-left: auto;margin-right: auto;">

                <?php } ?>
                <h1 class="mt-3 text-center text-wrap"><?php echo $user['name'] ?></h1><br>
            </div>
            <div class="row mt-4">
                <div class="col-2">

                </div>
                <div class="col-8">
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

                                            <img class="ml-4" src="../profile.png" width="50px" height="50px" style="border-radius: 50%;">

                                        <?php } else { ?>

                                            <img class="ml-4" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($use["img"]); ?>" width="50px" height="50px" style="border-radius: 50%;">

                                        <?php } ?>
                                        <strong class="ml-4"><a href="#"><?php echo $use['name'] ?></a> <br><small><?php echo $row['time'] ?></small></strong>

                                        <div class="nav-item mr-3 ml-auto">
                                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="..\dashboard\edit.php?e=<?php echo $row["id"]; ?>">Edit</a>
                                                <a class="dropdown-item" href="profile.php?del=<?php echo $row["id"]; ?>">Delete</a>
                                            </div>
                                        </div>

                                        <img class="mt-3" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row["img"]); ?>" width="600px" height="600px">
                                        <div class="container">
                                            <h5 class="card-title mt-2 text-wrap"><?php echo $row['topic'] ?></h5>
                                            <p class="text-wrap" style="width: 80vh;">
                                                <?php echo $row['detail'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-2">

                </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
</body>

</html>