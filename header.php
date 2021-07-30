<?php
require 'inc/dbh-inc.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>STUDENT Service | Project of CTI Student</title> 
        <link rel="stylesheet" href="Style.css?version=6">
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
                        <li><a href="Contact.php">تعرف علينا اكثر</a></li>
                        <li><a href="suport.php">الدعم الفني</a></li>
                    </ul>
                </nav>
                <?php
                if (isset($_SESSION["usersId"])){
                    echo $_SESSION["usersName"];
                    ?> 
                    <div class="dropdown"  >
                    <img src='images/account.png'  width= 35px>
                    <div class="dropdown-content" style="right:-30px;">
                        <p style="text-align:right;">
                        <a href="accinfo.php">عرض المعلومات</a>
                        <a href="pay.php">عرض الطلبات</a>
                        <a href="inc/logout.php">تسجيل الخروج</a>
                    </p>
                    </div>
                    </div> <?php
                }
                else{
                    echo "<a href='login.php'><img src='images/account.png' width= 35px></a>";
                }
                ?>                
                    <a href="cart.php"><img src="images/cart.png" width= 35px></a>
            </div>
        </div>

        