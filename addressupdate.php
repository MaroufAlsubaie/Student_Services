<?php
if (isset($_POST["update"])){
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
    else{
    $address ="UPDATE 'address' SET `contry` = '$contry', `ctiy` = '$ctiy', `street` = '$street',  `pin` = '$pin', `phoneNum` = '$phoneNum' WHERE `address`.'addressiD' = $addressiD1 ";    
    $res = mysqli_query($conn,$address);
    }}
    ?>