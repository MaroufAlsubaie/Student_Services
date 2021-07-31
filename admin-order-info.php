<?php
include 'header.php';

if (isset($_GET["orderID"])){

}
else {
    header("url=AdminUi.php");
    exit();
}
?>

<div class="container2">
<div class="goods">
<div class="row">
<h1>معلومات الطلاب</h1>
<table style="width: 80%">
    <tr>
        <th  class="th"> usersName </th>
        <th style="padding-left: 5px;" class="th">orderID</th>
        <th style="padding-left: 40px; padding-right: 40px;" class="th">addressId</th>
        <th style="padding-left: 40px; padding-right: 40px;" class="th">total</th>
        <th style="padding-left: 40px; padding-right: 40px;" class="th">Date</th>
        <th style="padding-left: 40px; padding-right: 40px;" class="th">usersEmail</th>
        <th style="padding-left: 40px; padding-right: 40px;" class="th">status</th>
    </tr>
<?php
$orderID = $_GET["orderID"];
        $sql = "SELECT * FROM `orders` INNER JOIN users ON orders.usersId = users.usersId WHERE `orderID` = ? ORDER BY `orders`.`orderID` DESC;";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "stmt eroor";
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $orderID);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData)?>
        <tr>
        <th  class="td"> <?php echo $row["usersName"]; ?> </th>
        <th style="padding-left: 5px;" class="td"><?php echo $row["orderID"]; ?></th>
        <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["addressId"]; ?></th>
        <th style="padding-left: 40px; padding-right: 40px;" class="td">ريال<?php echo $row["total"]; ?></th>
        <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["Date"]; ?></th>
        <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["usersEmail"]; ?></th>
        <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["status"]; ?></th>
    </tr>
</table>
</div>
<?php mysqli_stmt_close($stmt);?>
<hr style="height:2px;border-width:0;color:gray;background-color:black">
<div class="row">


<table style="width: 80%">
        <tr>
            <th  class="th"> Name </th>
            <th style="padding-left: 5px;" class="th">productiD</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">quantity</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">price</th>
        </tr>
<?php
$orderID = $_GET["orderID"];
        $sql = "SELECT * FROM items_order INNER JOIN product ON items_order.productiD = product.ID WHERE `orderID` = ?";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "stmt eroor";
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $orderID);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)) { ?>
        <tr>
            <th  class="td"><?php echo $row["Name"]; ?> </th>
            <th style="padding-left: 5px;" class="td"><?php echo $row["productiD"]; ?></th>
            <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["quantity"]; ?></th>
            <th style="padding-left: 40px; padding-right: 40px;" class="td"><?php echo $row["price"]; ?></th>
        </tr>
            </tr>
            <?php }mysqli_stmt_close($stmt); ?>
