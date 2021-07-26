<?php
    include_once 'header.php';
    ?>
    
<div class="container2">
   <br>
   <br>
   <br>
  <div class="row">

<?php
    require 'inc/dbh-inc.php';

    $usersId = $_SESSION["usersId"];
    $i = 0;

    $sql = "SELECT * FROM `address` WHERE `usersId` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usersId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($resultData)) {
        echo "<div class='col-3'>";
        echo "<h4>${row['contry']}</h4>";
        echo "<h4>${row['ctiy']}</h4>";
        echo "<h4>${row['street']}</h4>";
        echo "<h4>${row['pin']}</h4>";
        echo "<h4>${row['phoneNum']}</h4>";

        echo "<p><a href='#' class='bottun'>اختيار العنوان</a></p>";

        echo "</div>";
        $i ++;
    }
    if ($i==0) { 
        header("location: address.php");
        exit();
    }
    mysqli_stmt_close($stmt);
?>
<p><a href="address.php" class="bottun">اضافة عنوان</a></p>
