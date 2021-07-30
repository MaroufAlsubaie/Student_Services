<?php
include 'header.php';

?>
<br><br><br><br><br>

<div class="container2">
<div class="goods">
<div class="row">

<table style="width: 50%">
        <tr>
            <th  class="th">orderiD</th>
            <th style="padding-left: 5px; padding-right: 5px;" class="th">address</th>
            <th style="padding-left: 40px; padding-right: 40px;" class="th">total</th>
            <th style="padding-left: 30px; padding-right: 30px;" class="th">status</th>
        </tr>

        <?php
        $useriD = $_SESSION["usersId"];
        $sql = "SELECT * FROM orders WHERE usersId= $useriD ORDER BY 'orderID' ASC;";
        $result = mysqli_query($conn,$sql); 
        
        while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td class="td"><?php echo $row["orderID"]; ?></td>
            <td class="td"><?php echo $row["addressId"]; ?></td>
            <td class="td"><?php echo $row["total"]; ?> ريال</td>
            <td class="td"><?php echo $row["status"]; ?></td>
        </tr>
        <?php } ?>
    </table>
   
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