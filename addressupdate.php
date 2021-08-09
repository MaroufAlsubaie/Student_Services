<?php
//تحديث العنوان
if (isset($_POST["update"])){
    $contry = $_POST["contry"];
    $ctiy = $_POST["ctiy"];
    $street = $_POST["street"];
    $pin = $_POST["pin"];
    $phoneNum = $_POST["phoneNum"];

    require 'inc/dbh-inc.php';
    require 'inc/functions-inc.php';

    if (addressEmptyImpot($contry, $ctiy, $street, $pin, $phoneNum) !== false) {// التاكد من عدم خلو المدخلات
        header("location: ../addressupdate.php?error=emptyinput");
        exit();
    }
    else{
    $adiD1= $_POST["hidden_address"];
    $address ="UPDATE `address` SET `contry` = '$contry', `ctiy` = '$ctiy', `street` = '$street',  `pin` = '$pin', `phoneNum` = '$phoneNum' WHERE `address`.`addressiD` = $adiD1 ;";    
    $res = mysqli_query($conn,$address);
    }
    echo "<script>alert('تم تحديث العنوان')
                  window.location='addressinfo.php'</script>";
                  exit();
}
if (isset($_POST["DEL"])){

}

include 'header.php'; 
  $adiD= $_GET["addressId"];  
  $addre="SELECT * FROM address WHERE addressiD= $adiD;";// تعريف سطر استرجاع المعلومات من قاعدة البيانات
  $get12 = mysqli_query($conn,$addre);// لاسترجاع المعلومات  addre اطلاق المتغير

  while($row = mysqli_fetch_assoc($get12)) {
      
// إظهار العنوان
  ?>
  <div class="container2">
  <div class="col-3">
  <form action="addressupdate.php" method="POST">
  <p style="font-size:23px; text-align:right;">المنطقة</p>
  <input value="<?php echo $row["contry"]?>" type="text" name="contry"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
  <p style="font-size:23px; text-align:right; margin-top: 25px;">المدينة</p>
  <input value="<?php echo $row["ctiy"]?>" type="text" name="ctiy"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
  <p style="font-size:23px; text-align:right; margin-top: 25px;" >الشارع</p>
  <input value="<?php echo $row["street"]?>" type="text" name="street" style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
  <p style="font-size:23px; text-align:right; margin-top: 25px;">الرمز البريدي</p>
  <input value="<?php echo $row["pin"]?>" type="text" name="pin"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
  <p style="font-size:23px; text-align:right; margin-top: 25px;">رقم التواصل</p>
  <input value="<?php echo $row["phoneNum"]?>" type="text" name="phoneNum"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
  <input type="hidden" name="hidden_address" value="<?php echo $row["addressiD"]?>">

  <input  type="submit" name="update" class="bottun1" value="تاكيد" style="font-size:16px;">
 
   <button class='bottun11' name="DEL" style="float:right; margin-top:40px;"> حذف العنوان</button>
  
  </form>
  
  
  
  </div>
  
  </div>
  <?php
}
//حذف العنوان
if (isset($_POST["DEL"])){
    $adiD121= $_POST["hidden_address"];
    $addre12="DELETE FROM `address` WHERE `address`.`addressiD` = $adiD121";
    $get1212 = mysqli_query($conn,$addre12);
    echo "<script>alert('تم حذف العنوان')
    window.location='addressinfo.php'</script>";
    exit();
}

?>