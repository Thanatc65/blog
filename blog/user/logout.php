<?php 
include("..\server.php");
session_destroy();

header("Location: ..\index.php");
?>