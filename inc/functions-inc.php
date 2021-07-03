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
    if ($pass !== $pasRep) $result = true;
    else $result = false;
    return $result;
}

function nameExists($conn, $name) {
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed1");
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
        header("location: ../register.php?error=stmtfailed2");
        exit();
    }

    $hashedpass = password_hash($pas, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedpass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../register.php?error=none");
    exit();
}