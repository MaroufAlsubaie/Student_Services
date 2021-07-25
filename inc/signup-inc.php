<?php

if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pas = $_POST["pas"];
    $pasRep = $_POST["pasRep"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (emptyInputSignup($name, $email, $pas, $pasRep) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (invalidUid($name) !== false) {
        header("location: ../register.php?error=invalidUid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidEmail");
        exit();
    }
    if (passMatch($pas, $pasRep) !== false) {
        header("location: ../register.php?error=passnotmatch");
        exit();
    }
    if (nameExists($conn, $name) !== false) {
        header("location: ../register.php?error=nametaken");
        exit();
    }
    createUser($conn, $name, $email, $pas);
}
else {
    header("location: ../register.php");
    exit();
}