<?php
require 'dbh-inc.php';
require 'functions-inc.php';
session_start();

if (isset($_GET["addressId"])){
    $usersId = $_SESSION["usersId"];
    $addressId = $_GET["addressId"];
    $total = $_SESSION["total"];

    createOrder($conn, $usersId, $addressId, $total);






}
else {
    header("location: ../cart.php");
    exit();
}
    




 /*   
if(!empty($_SESSION["cart"])){
    $total = 0;
    foreach ($_SESSION["cart"] as $key => $value) {
        echo $value["Name"];
        echo $value["quantity"];
        echo number_format($value["quantity"]);
        echo $value["ID"];
        echo "<br>";

        $total = $total + ($value["quantity"] * $value["price"]);

        echo $total;
    }
}