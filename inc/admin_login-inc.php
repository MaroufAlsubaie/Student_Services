<?php
//تسجيل الدخول مسؤول إذا قام المسؤول بالضغط على الزر المسمى "sup"
if (isset($_POST["sup"])){
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    require 'dbh-inc.php';
    require 'functions-inc.php';

    if (ADMemptyInputlogin($name, $pass) !== false) {//التاكد من المدخلات
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    ADMloginUser($conn, $name, $pass);//ادخال الادمن
}
else {
    header("location: ../login.php");
    exit();
}