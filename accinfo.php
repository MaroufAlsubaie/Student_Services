<?php
include 'header.php';

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
        $sql = "SELECT * FROM users WHERE usersId= $useriD ORDER BY 'orderID' ASC;";
        $result = mysqli_query($conn,$sql); 
        
        while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td class="td" style="padding-bottom:7px; padding-top:7px;" ><input name="name" style="background:#f3c48659; text-align:center;" type="text" value="<?php echo $row["usersName"]; ?>"></input></td> 
            <td class="td" style="padding-bottom:7px; padding-top:7px; padding-left:25px; padding-right:25px;"><input name="email" style="background:#f3c48659; text-align:center;" type="text" value="<?php echo $row["usersEmail"]; ?>"></input></td>
            <td class="td" style="padding-bottom:7px; padding-top:7px;  padding-left:30px; padding-right:30px;"><input name="pass" style="background:#f3c48659; padding-left:8px; padding-right:8px;" type="text" value="<?php echo $row["usersPass"]; ?>"></input></td>
        </tr>
        
        <?php } ?>
    </table>
    
   
</div>
</div>
<button name="confirm1" type="submit" class="bottu1" style="font-size:16px; float:right;" > تاكيد</button>
</div>
<?php
if (isset($_POST["confirm1"])){
    if(($_POST("name")!==$row["usersName"])){
        $name = $_POST("name");
        $info_update ="UPDATE `users` SET `usersName` = $name WHERE `users`.`usersId` = $useriD;";  
    }
            $stmt1 = $conn->prepare($info_update);

            $stmt1->execute(); 
            
            mysqli_stmt_close($stmt);

}
?>