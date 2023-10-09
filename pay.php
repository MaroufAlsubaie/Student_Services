<?php
include 'header.php';
//هنا ياتي المستخدم بعد اختيار عنوان التوصيل
?>
        <link rel="stylesheet" href="Style.css?version=13">

<br><br><br><br><br>

<div class="container2">
<div class="goods">
<?php 
if (isset($_GET["orderID"])){
$usersId = $_SESSION["usersId"];
$sql = "SELECT * FROM orders WHERE usersId=? ORDER BY `orders`.`orderID` DESC;";
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
            <th style="padding-left: 30px; padding-right: 30px;" class="th">ارفق الايصال</th>
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
<form action="inc/progress.php" method="post">
        <tr>
            <td class="td"><input type="hidden" name="hidden_orderID" value="<?php echo $row["orderID"]; ?>"><?php echo $row["orderID"]; ?></td>
            <td class="td"><?php echo $row["total"]; ?> ريال</td>
            <td class="td"><?php echo $row["status"]; ?></td>
            <td class="td"><input type="file" id="file" name="file_input" class="files" accept="image/*,.pdf" required/><label class="files-l" for="file">Click me</label></td>
        </tr>
        <?php } ?>
    </table>
</div>
<button class="send-file" name="sendfile" type="submit">Send</button>
<?php }?>
</form>
</div>
</div>

<br><br><br><br>
<div class="bank">
    <img  src="images/alrajhi.png" >
    <h2>IBAN:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</h2>
    <br><br><br><br>
    <img  src="images/alahli.png" >
    <h2>IBAN:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</h2>

    
</div>
 <br><br><br><br><br>
 