<?php
include_once 'header.php';

?>
<div class="container2">
<div class="goods">
<div class="row">
<table style="width: 100%">
        <tr>
            <th  class="th"> usersName </th>
            <th style="padding-left: 5px;" class="th">orderID</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">addressId</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">total</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">Date</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">status</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">status</th>
        </tr>

        <?php
        $sql = "SELECT * FROM `orders` INNER JOIN users ON orders.usersId = users.usersId ORDER BY `orders`.`orderID` DESC;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "stmt eroor";
            exit();
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($resultData)) { ?>
        <tr>
            <th  class="td"><?php echo $row["usersName"]; ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["orderID"] ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["addressId"]; ?></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td">ريال<?php echo $row["total"]; ?></th>
            <th style="padding-left: 30px; padding-right: 30px;" class="td"><?php echo $row["Date"]; ?></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["status"]; ?></th>
            <th class="td">
                <p><a href='admin-order-info.php?orderID=<?php echo $row["orderID"]; ?> '>عرض معلومات الطلب</a></p>
            </th>
        </tr>
        <?php } ?>
    </table>
