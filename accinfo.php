<?php
include 'header.php';
require 'inc/functions-inc.php';
// here where user can revail his info 
?>

<div class="container2">
<div class="goods">
<div class="row">

<table style="width: 80%">
        <tr>
            <th  class="th">اسم المستخدم</th>
            <th style="padding-left: 5px; padding-right: 5px;" class="th">الايميل الالكتروني</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">كلمة المرور</th>
        </tr>

        <?php
        $useriD = $_SESSION["usersId"];
        $sql = "SELECT * FROM users WHERE usersId= $useriD ;";
        $result = mysqli_query($conn,$sql); 
        
        while($row = mysqli_fetch_assoc($result)) { ?>
        <form action="accinfo.php" method="POST">
        <tr>
            <td class="td" style="padding-bottom:7px; padding-top:7px;" ><input type="text" name="username" placeholder="<?php echo $row["usersName"]; ?>" style="background:#f3c48659; text-align:center;" /></td> 
            <td class="td" style="padding-bottom:7px; padding-top:7px; padding-left:25px; padding-right:25px;"><input name="email" style="background:#f3c48659; text-align:center;" type="text" placeholder="<?php echo $row["usersEmail"]; ?>"></td>
            <td class="td" style="padding-bottom:7px; padding-top:7px;  padding-left:30px; padding-right:30px;"><input name="old-pass" style="background:#f3c48659; padding-left:8px; padding-right:8px; text-align:center;" type="password" placeholder="ادخل كلمة المرور الحالية"></td>
        </tr>
        <tr>
                <td></td>
                <td></td>
                <td class="td" style="padding-bottom:7px; padding-top:7px;  padding-left:30px; padding-right:30px;"><input name="new-pass" style="background:#f3c48659; padding-left:8px; padding-right:8px; text-align:center;" type="password" placeholder="ادخل كلمة المرور الجديدة"></td>
            </tr>
        <tr>
                <td></td>
                <td></td>
                <td class="td" style="padding-bottom:7px; padding-top:7px;  padding-left:30px; padding-right:30px;"><input name="new-pass-2" style="background:#f3c48659; padding-left:8px; padding-right:8px; text-align:center;" type="password" placeholder="اعد ادخال كلمة المرور الجديدة"></td>
            </tr>
        <?php } ?>
    </table>
</div>
</div>
<button  type="submit" name="1co" class="bottu1" style="font-size:16px; float:right;" >تاكيد</button>
      </form>   
</div>
  </body>
  </html>
<?php

if (isset($_POST["1co"])){
    if (isset($_POST["username"])){
    $na = $_POST["username"];  
    if($na !== "")  {
        $info_update ="UPDATE `users` SET `usersName` = '$na' WHERE `users`.`usersId` = $useriD;";  
    
        $result123 = mysqli_query($conn,$info_update);
        echo '<script>window.location="accinfo.php"</script>';
    }

}
if (isset($_POST["email"])){
    $ea = $_POST["email"];  
    if($ea !== "")  {
        $info_update ="UPDATE `users` SET `usersEmail` = '$ea' WHERE `users`.`usersId` = $useriD;";  
    
        $result123 = mysqli_query($conn,$info_update);
        echo '<script>window.location="accinfo.php"</script>';
}
}

if (isset($_POST["new-pass"])){
    if (passMatch($_POST["new-pass"], $_POST["new-pass-2"]) !== false) {
        echo("passnotmatch");
        exit();
    }
    $nameExitsts = nameExists($conn, $_SESSION["usersName"]);
    if ($nameExitsts == false){
        echo("wrongPass");
        exit();
    }

    $hashedpass = $nameExitsts["usersPass"];
    $checkpass = password_verify($_POST["new-pass"], $hashedpass);

    if ($checkpass == false){
        echo("wrongPassH");
        exit();
    }

    else if ($checkpass == true){
        $sql ="UPDATE `users` SET `usersPass` = ? WHERE `users`.`usersId` = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo("stmtfailed");
            exit();
        }
        $hashedpass = password_hash($_POST["new-pass"], PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "si", $hashedpass, $_SESSION["usersId"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}
}
?>
