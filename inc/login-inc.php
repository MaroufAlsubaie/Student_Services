<?php
//login user if the user hit the button named "sup"
if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (emptyInputlogin($name, $pass) !== false) {//التاكد من المدخلات
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $name, $pass);//ادخال المستخدم
}
else {
    header("location: ../login.php");
    exit();
}