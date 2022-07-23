<?php
include('..\server.php');

if (isset($_POST['add'])) {
    $uid = $_SESSION['uid'];
    $topic = $_POST["topic"];
    $detail = $_POST["detail"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $image = $_FILES['img']['tmp_name'];
    $img = file_get_contents($image);

    $sql = "INSERT into posts(img , uid , topic , detail , date , time) 
            values(? ,'$uid','$topic','$detail','$date','$time')";
    $stmt = mysqli_prepare($conn, $sql);

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $img);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Add Post Successful')</script>";
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
                    <a class="nav-link mr-3" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="add.php">Add Post</a>
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
        <div class="col-3">

        </div>
        <div class="col-6">
            <div class="container">
                <h1 class="mt-4">Add Post</h1>
                <hr>
                <div class="card mt-3">
                    <div class="container">
                        <form action="add.php" enctype="multipart/form-data" method="post">
                            <input type="hidden" id="current_date" name="date">
                            <input type="hidden" id="current_time" name="time">
                            <div class="form-group mt-3">
                                <label>Image:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="img">
                                    <label class="custom-file-label"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Topic:</label>
                                <input type="text" name="topic" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Details:</label>
                                <textarea type="text" name="detail" class="form-control" style="resize: none;height: 200px;"></textarea>
                            </div>
                            <button class="btn btn-primary w-100 mt-5" type="submit" name="add">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">

        </div>
    </div>
</body>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    date = new Date();
    year = date.getFullYear();
    month = date.getMonth() + 1;
    day = date.getDate();
    time = date.toLocaleTimeString(navigator.language, {
        hour: '2-digit',
        minute: '2-digit'
    })
    document.getElementById("current_date").value = month + "/" + day + "/" + year;
    document.getElementById("current_time").value = time;
</script>

</html>