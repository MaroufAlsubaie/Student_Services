<?php
    include_once 'header.php';
    //here where user can see our product 
?>

        <div class="container2">

<form class="example" action="product.php" method="GET"><!--search-->
     <input type="text" name="search" placeholder="وش نبي تبحث عنه...؟" style="text-align:right;">
     <button  type="submit" style="padding: 2.5px;"><img src="images/search.png"></button>

     <select name="sort" style="margin-left:890px; margin-bottom:20px ;">
   <option value="">....الترتيب</option>
   <option value="">عادي</option>
   <option value="low">من الاقل للاعلى</option>
   <option value="high">من الاعلى للاقل</option>
   <option value="abc">من الالف للياء</option>
   <option value="cba">من الياء للالف</option>
   </select>

<?php //type
$query_t ="SELECT * FROM `product` ORDER BY `product`.`type` DESC";
$type_q = mysqli_query($conn,$query_t);
$temp = "";
if (mysqli_num_rows($type_q)>0){?>
   <p style=" text-align:right;"><?php
   foreach($type_q as $typelist){?>
       
       <?php 
       $checked = [];
       if(isset($_GET['type'])){
           $checked = $_GET['type'];
       }

        if($temp !== $typelist['type']){?>

        <label style="margin-right:10px " > <?= $typelist['type'] ?></label>
        <input style="margin-top:10px " type="checkbox" name="type[]"  value="<?= $typelist['type'] ?>"
        <?php if(in_array($typelist['type'],$checked)){ echo "checked"; } ?>>
        
        <br>
        <?php
        }
        $temp = $typelist['type'];?>
       <?php
   }?></p><?php
   
}
?>

<button type="submit" class="bottu1" > فلتر</button>
</form>

<div class="row">



<?php
if (isset($_GET['search'])) 
$search='%'.$_GET['search'].'%';

else $search='%'.'%';

       $sql = "SELECT * FROM product WHERE(Name LIKE ? OR photo LIKE ? OR type LIKE ?)";

       if(isset($_GET['type']))
       {
           $typechecked = [];
           $typechecked = $_GET['type'];
           foreach($typechecked as $rowbrand){
            $sql = $sql."AND type in ('$rowbrand') ";
           }}


       if (isset($_GET["sort"])){
        if ($_GET["sort"] == "low")
        $sql =$sql."ORDER BY `product`.`price` ASC";
        elseif ($_GET["sort"] == "high")
        $sql =$sql."ORDER BY `product`.`price` DESC";
        elseif ($_GET["sort"] == "abc")
        $sql =$sql."ORDER BY `product`.`Name` ASC";
        elseif ($_GET["sort"] == "cba")
        $sql =$sql."ORDER BY `product`.`Name` DESC";
       }
       $stmt = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt, $sql)) {
           echo "stmt eroor";
           exit();
       }

        mysqli_stmt_bind_param($stmt, "sss", $search,$search,$search);

       mysqli_stmt_execute($stmt);
       $resultData = mysqli_stmt_get_result($stmt);
       while($row = mysqli_fetch_assoc($resultData)) {
        if($row["quantity"] > 0){
        ?>
    <div class="col-3">
        <div class="image">
        <form method="post" action="cart.php?id=<?=$row['ID']?>">
        <img src="images/<?=$row['photo']?>">
        <h4><?=$row['Name'];?></h4>
        <p><?=$row['price'];?> ريال</p>
        <input type="number" name="quantity" class="input1" value="1" min="1" max=<?php echo $row["quantity"]?>>
        <input type="hidden" name="hidden_name" value="<?php echo $row["Name"]?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]?>">
        <input type="submit" name="add" class="bottun1" value="اضف الى السلة" >
    </div>
    </form>
    </div>
    <?php }
    else {
        ?>
    <div class="col-3">
        <div class="image">
        <img src="images/<?=$row['photo']?>">
        <h4><?=$row['Name'];?></h4>
        <p><?=$row['price'];?> ريال</p>
        <input type="number" name="quantity" class="input1" value="<?php echo $row["quantity"]?>" min="0" max=<?php echo $row["quantity"]?>>
        <input type="hidden" name="hidden_name" value="<?php echo $row["Name"]?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]?>">
        <button class="bottun1" style="font-size:15px; background:rgb(107, 57, 0);" >نفذت الكمية</button>
    </div> 
    </div>
    <?php
    }
} 
?>

</div>
</div>
</div>
    </body>
</html>