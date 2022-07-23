<?php
include('..\server.php');

if (isset($_POST['change'])) {
    $uid = $_SESSION['uid'];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $image = $_FILES['img']['tmp_name'];
    $img = file_get_contents($image);

    $sql = "UPDATE users SET name = '$name', email = '$email', img = ? WHERE uid = '$uid'";
    $stmt = mysqli_prepare($conn, $sql);

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $img);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Update Successful')</script>";
}
$uid = $_SESSION['uid'];
$sel = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$uid'");

$user = mysqli_fetch_assoc($sel);
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
                        <a class="dropdown-item" href="..\user\profile.php">Profile</a>
                        <a class="dropdown-item" href="..\user\setting.php">Setting</a>
                        <a class="dropdown-item" href="..\user\logout.php">Logout</a>
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
                <hr>
                <div class="container">
                    <form action="setting.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Image:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="img">
                                <label class="custom-file-label"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <button class="btn btn-primary w-100 mt-5" type="submit" name="change">Change</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-2">

        </div>
    </div>
    </div>
</body>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

</html>