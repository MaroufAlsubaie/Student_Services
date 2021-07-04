<?php

if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (emptyInputlogin($name, $pass) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $name, $pass);
}
else {
    header("location: ../login.php");
    exit();
}