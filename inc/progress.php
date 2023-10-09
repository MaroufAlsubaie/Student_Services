<?php
require 'dbh-inc.php';
require 'functions-inc.php';

if(isset($_POST["sendfile"])){
    $f_orderid= $_POST["hidden_orderID"];
    $file=$_POST["file_input"];
    //Stores the filename as it was on the client computer.
    $imagename = $_FILES['file_input']['name'];
    //Stores the filetype e.g file$file/jpeg
    $imagetype = $_FILES['file_input']['type'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['file_input']['error'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['file_input']['tmp_name'];

    //The path you wish to upload the file$file to
    $imagePath = "./Check_payment/";

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
            header("location: ../pay.php?error=Sussecfully uploaded your file$file.");
        }
        else {
            header("location: ../pay.php?error=Failed to move your file$file.");
        }
    }
    else {
        header("location: ../pay.php?error=Failed to upload your file$file.");
    }
    $query= "INSERT INTO `pay_check`VALUES ('$f_orderid', '$file');";
    $type_q = mysqli_query($conn,$query);
}