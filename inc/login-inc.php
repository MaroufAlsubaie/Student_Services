<?php

if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $pas = $_POST["pass"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (emptyInputlogin($name, $pas) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $name, $pas);
}
else {
    header("location: ../login.php");
    exit();
}