<?php
session_start();
if (isset($_POST["sup"])){
    $contry = $_POST["contry"];
    $ctiy = $_POST["ctiy"];
    $street = $_POST["street"];
    $pin = $_POST["pin"];
    $phoneNum = $_POST["phoneNum"];
    $usersId = $_SESSION["usersId"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (addressEmptyImpot($contry, $ctiy, $street, $pin, $phoneNum) !== false) {
        header("location: ../address.php?error=emptyinput");
        exit();
    }

    createAddress($conn, $usersId, $contry, $ctiy, $street, $pin, $phoneNum);
}
else {
    header("location: ../address.php");
    exit();
}