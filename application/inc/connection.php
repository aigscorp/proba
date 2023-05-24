<?php
    require "config.php";

    $db = mysqli_connect(HOST,USER, PASS, DB) or die(mysqli_error());
    mysqli_set_charset($db, "utf8mb4");

    mysqli_select_db($db, DB) or die("Cannot select DB");

?>