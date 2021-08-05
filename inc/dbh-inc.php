<?php
//link the database with the php
$serberName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "student_services";

$conn = mysqli_connect($serberName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("connectino failed: " . mysqli_connect_error);
}