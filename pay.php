<?php
include 'header.php';
//here where user ends up after choose address to delviry the payment page
?>
<br><br><br><br><br>

<div class="container2">
<div class="goods">
<div class="row">

<table style="width: 50%">
        <tr>
            <th  class="th">orderiD</th>
            <th style="padding-left: 5px; padding-right: 5px;" class="th">address</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">total</th>
            <th style="padding-left: 30px; padding-right: 30px;" class="th">status</th>
        </tr>

        <?php

        $usersId = $_SESSION["usersId"];
        $sql = "SELECT * FROM orders WHERE usersId= ? ORDER BY 'orderID' ASC;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "error";
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $usersId);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($resultData)) { ?>


        <tr>
            <td class="td"><?php echo $row["orderID"]; ?></td>
            <td class="td"><?php echo $row["addressId"]; ?></td>
            <td class="td"><?php echo $row["total"]; ?> ريال</td>
            <td class="td"><?php echo $row["status"]; ?></td>
        </tr>
        <?php } ?>
    </table>
   
</div>
</div>
</div>

<br><br><br><br>
<div class="bank">
    <img  src="images/alrajhi" >
    <h2>IPAN:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</h2>
    <br><br><br><br>
    <img  src="images/alahli" >
    <h2>IPAN:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</h2>

    
</div>
 <br><br><br><br><br>