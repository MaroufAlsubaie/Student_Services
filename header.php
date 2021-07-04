<?php
session_start();
$name = $_SESSION["usersName"]
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>STUDENT Service | Project of CTI Student</title> 
        <link rel="stylesheet" href="Style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="headbackground">
        <div class="container"> 
            <div class="bar">
                <div class="logo">
                    <a href="Ui.php"><img src="images/logo_transparent22-removebg.png" width="300px"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="Ui.php">الصفحة الرئيسة</a></li>
                        <li><a href="Product.php">المنتجات</a></li>
                        <li><a href="">تعرف علينا اكثر</a></li>
                        <li><a href="">الدعم الفني</a></li>
                    </ul>
                </nav>
                <?php
                if (isset($_SESSION["usersId"])){
                    echo "$name";
                }
                //else{}
                ?>
                    <a href="login.php"><img src="images/account.png" width= 35px></a>
                
                    <a href="cart.php"><img src="images/cart.png" width= 35px></a>
            </div>
        </div>