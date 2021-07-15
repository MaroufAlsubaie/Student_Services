<?php

function emptyInputSignup($name, $email, $pas, $pasRep) {
    $result;
    if (empty($name) || empty($email) || empty($pas) || empty($pasRep))$result = true;
    else $result = false;
    return $result;
}

function invalidUid($name){
    $result;
    if (!preg_match("/^[a-zA-z0-9]*$/", $name)) $result = true;
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