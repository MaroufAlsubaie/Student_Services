<?php
include 'header.php';

?>

<div class="container2">

<div class="col-3">

<form action="inc/address-inc.php" method="POST">
<p style="font-size:23px; text-align:right;">المنطقة</p>
<input type="text" name="contry"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
<p style="font-size:23px; text-align:right; margin-top: 25px;">المدينة</p>
<input type="text" name="ctiy"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
<p style="font-size:23px; text-align:right; margin-top: 25px;" >الشارع</p>
<input type="text" name="street" style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
<p style="font-size:23px; text-align:right; margin-top: 25px;">الرمز البريدي</p>
<input type="text" name="pin"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
<p style="font-size:23px; text-align:right; margin-top: 25px;">رقم التواصل</p>
<input type="text" name="phoneNum"  style="width: 400px;  height: 40px; margin-top: 10px; font-size:22px;  text-align:right; margin-left: 680px;">
<input type="submit" name="add" class="bottun1" value="تاكيد" style="font-size:16px;">

<?php  //error Handler

if (isset($_GET["error"])){
    if ($_GET["error"] == "emptyinput"){
      echo "الرجاء اكمال الفرغات";
    }
}
?>

</div>

</div>

