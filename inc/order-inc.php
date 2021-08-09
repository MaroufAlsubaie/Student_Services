<?php
require 'dbh-inc.php';
require 'functions-inc.php';
session_start();
//create order 

//check cart if it is empty
if(!empty($_SESSION["cart"])){
if (isset($_GET["addressId"])){
    $usersId = $_SESSION["usersId"];
    $addressId = $_GET["addressId"];
    $total = $_SESSION["total"];

    createOrder($conn, $usersId, $addressId, $total);//انشاء طلب

    $orderdata = getorderID($conn, $usersId, $addressId, $total);//اخذ رقم لبطلب

    if ($orderdata == false){
        header("location: ../admin_login.php?error=wronglogin");
        exit();
    }

    $orderID = $orderdata["orderID"];



    


    //ادخال الطلابات
    $sql = "INSERT INTO items_order (`orderID`,`productiD`,`Quantity`,`price`) VALUES (? ,? ,? ,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../cart.php?error=stmtfailed");
        exit();
    }

    foreach ($_SESSION["cart"] as $key => $value) {
        $total = ($value["quantity"] * $value["price"]);
        mysqli_stmt_bind_param($stmt, "iiii", $orderID, $value["ID"], $value["quantity"], $total);
        mysqli_stmt_execute($stmt);           
        $iD = $value["ID"];
        $sql1 = "SELECT * FROM `product` WHERE ID =$iD";
        $update = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_assoc($update);
        $qu =  $row["quantity"] - $value["quantity"];
        $sql_update ="UPDATE `product` SET `quantity` = $qu WHERE `product`.`ID` = $iD;";
        $stmt1 = $conn->prepare($sql_update);

        // execute the query
        $stmt1->execute();
        }
        mysqli_stmt_close($stmt);
        $_SESSION["cart"] = null;
        header("location: ../pay.php?orderID=$orderID");
        exit();
}}
else {
    header("location: ../cart.php");
    exit();
}