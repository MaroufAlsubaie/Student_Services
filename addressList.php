<?php
    include_once 'header.php';
    if (isset($_POST["confirm"])){
        echo '<script>window.location="addressList.php"</script>';
    }
    // here where user choose address for checkout
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

    $sql = "SELECT * FROM `address` WHERE `usersId` = ?;";// تعريف سطر استرجاع المعلومات من قاعدة البيانات
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usersId);// User iD استبدال قيمة الاستفهام في السطر 21 ب 
    mysqli_stmt_execute($stmt);// لاسترجاع المعلومات  sql اطلاق المتغير
    $resultData = mysqli_stmt_get_result($stmt);// اعطاء المتغير المعلومات المسترجعه من قاعدة البيانات

    while($row = mysqli_fetch_assoc($resultData)) {//عرض معلومات العنوان 
        echo "<div class='col-3'>";
        echo "<h4>${row['contry']}</h4>";
        echo "<h4>${row['ctiy']}</h4>";
        echo "<h4>${row['street']}</h4>";
        echo "<h4>${row['pin']}</h4>";
        echo "<h4>${row['phoneNum']}</h4>";

        ?>
        <p><a href='inc/order-inc.php?addressId=<?php echo $row['addressiD']; ?>' class='bottun'>اختيار العنوان</a></p>

        </div>
        <?php
        $i ++;
    }
    if ($i==0) { 
        header("location: address.php");
        exit();
    }
    mysqli_stmt_close($stmt);
?>
<p style="margin-top:120px;"><a href="address.php" class="bottun">اضافة عنوان</a></p>
