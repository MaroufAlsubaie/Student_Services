<?php
include 'header.php';
//هنا ياتي المستخدم بعد اختيار عنوان التوصيل
?>
<br><br><br><br><br>

<div class="container2">
<div class="goods">
<?php if (isset($_GET["orderID"])){
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

$row = mysqli_fetch_assoc($resultData);
?>
<div class="center">
<h3>تم ارسال الطلب</h3>
<h3>رقم طلبك <?php echo $row["orderID"]; ?></h3>
<h3>و اجمالي طلبك <?php echo $row["total"]; ?> ريال </h3>
<h3>يرجى تحويل المبلغ على الحساب البنكي</h3>
</div>

<?php
}
else { ?>
<div class="row">
<table style="width: 50%">
        <tr>
            <th  class="th">رقم الطلب</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">السعر</th>
            <th style="padding-left: 30px; padding-right: 30px;" class="th">الحاله</th>
        </tr>

        <?php
//عرض معلومات الطلبات
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
            <td class="td"><?php echo $row["total"]; ?> ريال</td>
            <td class="td"><?php echo $row["status"]; ?></td>
        </tr>
        <?php } ?>
    </table>
   <?php }?>
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