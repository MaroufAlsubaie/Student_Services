<?php
session_start();
if (isset($_POST["confirm"])){
    $contry = $_POST["contry"];
    $ctiy = $_POST["ctiy"];
    $street = $_POST["street"];
    $pin = $_POST["pin"];
    $phoneNum = $_POST["phoneNum"];
    $usersId = $_SESSION["usersId"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (addressEmptyImpot($contry, $ctiy, $street, $pin, $phoneNum) !== false) { //التاكد من المدخلات
        header("location: ../address.php?error=emptyinput");
        exit();
    }

    createAddress($conn, $usersId, $contry, $ctiy, $street, $pin, $phoneNum);//ادخال العنوان
}
else {
    header("location: ../address.php");
    exit();
}