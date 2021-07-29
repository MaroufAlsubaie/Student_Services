<?php
require 'dbh-inc.php';
require 'functions-inc.php';
session_start();


if(!empty($_SESSION["cart"])){
if (isset($_GET["addressId"])){
    $usersId = $_SESSION["usersId"];
    $addressId = $_GET["addressId"];
    $total = $_SESSION["total"];

    createOrder($conn, $usersId, $addressId, $total);

    $orderdata = getorderID($conn, $usersId, $addressId, $total);

    if ($orderdata == false){
        header("location: ../admin_login.php?error=wronglogin");
        exit();
    }

    $orderID = $orderdata["orderID"];



    $sql = "INSERT INTO items_order (`orderID`,`productiD`,`quantity`,`price`) VALUES (? ,? ,? ,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../cart.php?error=stmtfailed");
        exit();
    }

    foreach ($_SESSION["cart"] as $key => $value) {
        $total = ($value["quantity"] * $value["price"]);
        mysqli_stmt_bind_param($stmt, "iiii", $orderID, $value["ID"], $value["quantity"], $total);
        mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);

        header("location: ../pay.php");
        exit();
}}
else {
    header("location: ../cart.php");
    exit();
}