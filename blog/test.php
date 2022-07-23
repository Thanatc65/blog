<?php
include('server.php');

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
    <?php
    while ($row = mysqli_fetch_array($post)) {
    ?>
<ul id="id01">
    <li><?php
    echo $row['id'];
    ?></li>
</ul>
<?php
    }
    ?>
</body>
<script>
        var list, i, switching, b, shouldSwitch;
        list = document.getElementById("id01");
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // start by saying: no switching is done:
            switching = false;
            b = list.getElementsByTagName("LI");
            // Loop through all list-items:
            for (i = 0; i < (b.length - 1); i++) {
                // start by saying there should be no switching:
                shouldSwitch = false;
                /* check if the next item should
                switch place with the current item: */

                if (Number(b[i].innerHTML) > Number(b[i + 1].innerHTML)) {
                    /* if next item is numerically
                    lower than current item, mark as a switch
                    and break the loop: */
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark the switch as done: */
                b[i].parentNode.insertBefore(b[i + 1], b[i]);
                switching = true;
            }
        }
</script>

</html>