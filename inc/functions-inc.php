<?php
//-----------------------------------------singup
function emptyInputSignup($name, $email, $pas, $pasRep) {
    $result;
    if (empty($name) || empty($email) || empty($pas) || empty($pasRep))$result = true;
    else $result = false;
    return $result;
}

function invalidUid($name){
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) $result = true;
    else $result = false;
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $result = true;
    else $result = false;
    return $result;
}

function passMatch($pas, $pasRep) {
    $result;
    if ($pas !== $pasRep) $result = true;
    else $result = false;
    return $result;
}

function nameExists($conn, $name) {
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $pas) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPass) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedpass = password_hash($pas, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedpass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();
}
//----------------------------------------login
function emptyInputlogin($name, $pass) {
    $result;
    if (empty($name) || empty($pass))$result = true;
    else $result = false;
    return $result;
}

function loginUser($conn, $name, $pass){
    $nameExitsts = nameExists($conn, $name);

    if ($nameExitsts == false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $hashedpass = $nameExitsts["usersPass"];
    $checkpass = password_verify($pass, $hashedpass);

    if ($checkpass == false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkpass == true){
        session_start();
        $_SESSION["usersId"] = $nameExitsts["usersId"];
        $_SESSION["usersName"] = $nameExitsts["usersName"];
        header("location: ../ui.php");
        exit();
    }
}

//---------------------------------------------address

function addressEmptyImpot($contry, $ctiy, $street, $pin, $phoneNum) {
    $result;
    if (empty($contry) || empty($ctiy)|| empty($street)|| empty($pin)|| empty($phoneNum))$result = true;
    else $result = false;
    return $result;
}

function createAddress($conn, $usersId, $contry, $ctiy, $street, $pin, $phoneNum) {
    $sql = "INSERT INTO address (usersId, contry, ctiy, street, pin, phoneNum) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../address.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "isssii", $usersId, $contry, $ctiy, $street, $pin, $phoneNum);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../addressList.php");
    exit();
}

//-----------------------------------admin login
function ADMemptyInputlogin($name, $pass) {
    $result;
    if (empty($name) || empty($pass))$result = true;
    else $result = false;
    return $result;
}

function ADMloginUser($conn, $name, $pass){
    $nameExitsts = ADMnameExists($conn, $name);

    if ($nameExitsts == false){
        header("location: ../admin_login.php?error=wronglogin");
        exit();
    }

    $hashedpass = $nameExitsts["adminPass"];
    $checkpass = password_verify($pass, $hashedpass);

    if ($checkpass == false){
        header("location: ../admin_login.php?error=wronglogin");
        exit();
    }
    else if ($checkpass == true){
        session_start();
        $_SESSION["adminId"] = $nameExitsts["adminId"];
        $_SESSION["adminName"] = $nameExitsts["adminName"];
        header("location: ../AdminUi.php");
        exit();
    }
}

function ADMnameExists($conn, $name) {
    $sql = "SELECT * FROM admins WHERE adminName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
//--------------------------------------------order
function createOrder($conn, $usersId, $addressId, $total) {
    $sql = "INSERT INTO orders (`usersId`,`addressId`,`total`,`status`) VALUES (?, ?, ?, 'غير مدفوع');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../cart.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $usersId, $addressId, $total);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function getorderID($conn, $usersId, $addressId, $total){
    $sql = "SELECT * FROM `orders` WHERE `usersId` = ? and `addressId` = ? and `total` = ? ORDER BY `orders`.`Date` DESC;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../cart.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "iii", $usersId, $addressId, $total);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function send_file($conn, $usersId,$orderid){

}