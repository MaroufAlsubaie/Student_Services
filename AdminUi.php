<?php
include_once 'header.php';

if (isset($_SESSION["adminId"])){
    if (isset($_GET["DID"])){
        $delt = $_GET["DID"];
        $sqld = "DELETE FROM `product` WHERE `product`.`ID` = $delt;";
        $de = mysqli_query($conn,$sqld);
    }
    if (isset($_GET["DIDU"])){
        $delt = $_GET["DIDU"];
        $sqld = "DELETE FROM `users` WHERE `users`.`usersId` = $delt;";
        $de = mysqli_query($conn,$sqld);
    }
    if (isset($_POST["AddU"])){
        $name = $_POST["name"];
        $email= $_POST["email"];

        $hashedpass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

        $sqladd = "INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPass`) VALUES (NULL, '$name', '$email', '$hashedpass');";
        $de = mysqli_query($conn,$sqladd);
    }
    if (isset($_POST["Add"])){
        $name = $_POST["name"];
        $price= $_POST["price"];
        $quan= $_POST["quan"];
        $type= $_POST["typ"];
        $pho= $_POST["pho"];
        $sqladd = "INSERT INTO `product` (`Name`, `price`, `photo`, `quantity`, `type`) VALUES ('$name', '$price', '$pho', '$quan', '$type');";
        $de = mysqli_query($conn,$sqladd);
    }
    if (isset($_GET["DEID"])){
        $delt = $_GET["DEID"];
        $sqld = "DELETE FROM `orders` WHERE `orders`.`orderID` = $delt;";
        $de = mysqli_query($conn,$sqld);
    }
    if (isset($_POST["editU"])){
        $UID = $_POST["usID"];
        $name = $_POST["nameU"];
        $email= $_POST["Email"];
        $pass= $_POST["Pass"];
        $sqlup = "UPDATE `users` SET `usersName` = '$name' , `usersEmail`= '$email' , `usersPass`= '$pass'  WHERE `users`.`usersId` = $UID;";
        $de = mysqli_query($conn,$sqlup);
    }
    if (isset($_POST["edit"])){
        $PID = $_POST["ID"];
        $name = $_POST["name"];
        $price= $_POST["price"];
        $quan= $_POST["quan"];
        $type= $_POST["typ"];
        $pho= $_POST["pho"];
        $sqlup = "UPDATE `product` SET `Name` = '$name' , `price`= $price , `quantity`= $quan , `type` ='$type' , `photo`='$pho' WHERE `product`.`ID` = $PID;";
        $de = mysqli_query($conn,$sqlup);
    }
    if (isset($_GET["CON"])){
        $CONF = $_GET["CON"];
        $sqlCH ="SELECT status FROM `orders` WHERE `orders`.`orderID`= $CONF;";
        $ch = mysqli_query($conn,$sqlCH);
        $row = mysqli_fetch_assoc($ch);
        if ($row["status"] ==  'تم الدفع'){
            $sqld = "UPDATE `orders` SET `status` = 'غير مدفوع' WHERE `orders`.`orderID` = $CONF;";
            $de = mysqli_query($conn,$sqld);
        }
        else{
        $sqld = "UPDATE `orders` SET `status` = 'تم الدفع' WHERE `orders`.`orderID` = $CONF;";
        $de = mysqli_query($conn,$sqld);
    }
    echo '<script>window.location="AdminUi.php"</script>';
}
?>

<div class="container2">
<div class="goods">
<div class="row">
<h1 >الطلبات</h1>
<table style="width: 100%">
        <tr>
            <th  class="th"> usersName </th>
            <th style="padding-left: 5px;" class="th">orderID</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">addressId</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">total</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">Date</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">status</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">View</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">delete</th>
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
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["orderID"]; ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["addressId"]; ?></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td">ريال<?php echo $row["total"]; ?></th>
            <th style="padding-left: 25px; padding-right: 25px;" class="td"><?php echo $row["Date"]; ?></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["status"]; ?><br><a href='AdminUi.php?CON=<?php echo $row["orderID"]; ?>'>تغير الحاله</a></th>
            <th class="td">
                <p><a href='admin-order-info.php?orderID=<?php echo $row["orderID"]; ?> '>عرض معلومات الطلب</p>
                
            </th>
            <th class="td">
            <p><a href='AdminUi.php?DEID=<?php echo $row["orderID"]; ?> '>حذف الطلب</a></p>
            </th>
        </tr>
        <?php } ?>
    </table>


<div class="container2">
<div class="goods">
<div class="row">
    <h1>المنتجات</h1> 
<table style="width: 100%">
        <tr>
            <th  class="th"> ID </th>
            <th style="padding-left: 5px;" class="th">Name</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">price</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">quantity</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">type</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">Date-add</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">photo</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">edit</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">delete</th>
        </tr>

        <?php
        $sqlq = "SELECT * FROM `product`;";
        $stmts = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmts, $sqlq)) {
            echo "stmt eroor";
            exit();
        }
        mysqli_stmt_execute($stmts);
        $resultDatad = mysqli_stmt_get_result($stmts);

        while($row = mysqli_fetch_assoc($resultDatad)) { 
            if (isset($_GET["IDE"])){ 
                $IDE =$_GET["IDE"];
                if ($IDE == $row["ID"]){
                ?>
                <tr>
                    <form action="AdminUi.php" method="POST">
            <th  class="td"  style="padding-left: 5px; padding-right: 5px;"><?php echo $row["ID"]; ?><input name="ID" type="hidden" value="<?php echo $row["ID"];?>"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="name" type="text" value="<?php echo $row["Name"] ?>"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"> <input name="price" type="number" min=0 value=<?php echo $row["price"]; ?>></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input name="quan" type="number" min=0 value=<?php echo $row["quantity"]; ?>></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input  name="typ" type="text" value="<?php echo $row["type"]; ?>"></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["Date-add"]; ?></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><input name="pho" type="text" value="<?php echo $row["photo"]; ?>"></th>
            <th class="td">
            <button  type="submit" name="edit" class="bottun11" style="text-align:left;">تاكيد التعديل</button>
            </th>
            <th class="td">
                <p><a href='AdminUi.php?DID=<?php echo $row["ID"]; ?> '>حذف المنتج</a></p>
            </th>
        </tr></form>
            <?php } }
            ?>
        
        <tr>
            <th  class="td"  style="padding-left: 5px; padding-right: 5px;"><?php echo $row["ID"]; ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["Name"] ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td">ريال<?php echo $row["price"]; ?></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><?php echo $row["quantity"]; ?></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><?php echo $row["type"]; ?></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["Date-add"]; ?></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["photo"]; ?></th>
            <th class="td">
                <p><a href='AdminUi.php?IDE=<?php echo $row["ID"]; ?> '>تعديل المنتج</a></p>
            </th>
            <th class="td">
                <p><a href='AdminUi.php?DID=<?php echo $row["ID"]; ?> '>حذف المنتج</a></p>
            </th>
        </tr>
        
        <?php } ?>
        <tr>
            <form action="AdminUi.php" method="POST">
            <th  class="td"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="name" type="text"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="price" type="number" min=0></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input name="quan" type="number" min=0 value=1></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input name="typ" type="text"></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"></th>
            <th style="padding-left: 5px; padding-right: 5px;" class="td"><input name="pho" type="text"></th>
            <th class="td">
            <button  type="submit" name="Add" class="bottun11" style="text-align:left;">اضف المنتج</button>
            </th>
        </form>
        </tr>
    </table>


    
<div class="container2">
<div class="goods">
<div class="row">
    <h1>الحسابات</h1> 
<table style="width: 100%">
        <tr>
            <th  class="th"> ID </th>
            <th style="padding-left: 5px;" class="th">Name</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">Email</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">Password</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">edit</th>
            <th style="padding-left: 25px; padding-right: 25px;" class="th">delete</th>
        </tr>

        <?php
        $sqlq = "SELECT * FROM `users`;";
        $stmts = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmts, $sqlq)) {
            echo "stmt eroor";
            exit();
        }
        mysqli_stmt_execute($stmts);
        $resultDatad = mysqli_stmt_get_result($stmts);

        while($row = mysqli_fetch_assoc($resultDatad)) { 
            if (isset($_GET["IDEU"])){ 
                $IDE =$_GET["IDEU"];
                if ($IDE == $row["usersId"]){
                ?>
                <tr>
                    <form action="AdminUi.php" method="POST">
            <th  class="td"  style="padding-left: 5px; padding-right: 5px;"><?php echo $row["usersId"]; ?><input name="usID" type="hidden" value="<?php echo $row["usersId"];?>"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="nameU" type="text" value="<?php echo $row["usersName"]; ?>"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"> <input name="Email" type="text" value="<?php echo $row["usersEmail"]; ?>"></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input name="Pass" type="text" value="<?php echo $row["usersPass"]; ?>"></th>
            <th class="td">
            <button  type="submit" name="editU" class="bottun11" style="text-align:left;">تاكيد التعديل</button>
            </th>
            <th class="td">
                <p><a href='AdminUi.php?DIDU=<?php echo $row["usersId"]; ?> '>حذف الحساب</a></p>
            </th>
        </tr></form>
            <?php } }
            ?>
        
        <tr>
            <th  class="td"  style="padding-left: 5px; padding-right: 5px;"><?php echo $row["usersId"];?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["usersName"] ?></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><?php echo $row["usersEmail"]; ?></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><?php echo $row["usersPass"]; ?></th>
            <th class="td">
                <p><a href='AdminUi.php?IDEU=<?php echo $row["usersId"]; ?> '>تعديل الحساب</a></p>
            </th>
            <th class="td">
                <p><a href='AdminUi.php?DIDU=<?php echo $row["usersId"]; ?> '>حذف الحساب</a></p>
            </th>
        </tr>
        
        <?php } ?>
        <tr>
            <form action="AdminUi.php" method="POST">
            <th  class="td"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="name" type="text"></th>
            <th  style="padding-left: 5px; padding-right: 5px;" class="td"><input name="email" type="text"></th>
            <th style="padding-left: 10px; padding-right: 10px;" class="td"><input name="pass" type="text"></th>
            <th class="td">
            <button  type="submit" name="AddU" class="bottun11" style="text-align:left;">اضف الحساب</button>
            </th>
        </form>
        </tr>
    </table>

    <?php }
    else {
        header("location: admin_login.php");
        exit();
    }
    ?>