<?php

if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (ADMemptyInputlogin($name, $pass) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    ADMloginUser($conn, $name, $pass);
}
else {
    header("location: ../login.php");
    exit();
}