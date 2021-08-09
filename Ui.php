<?php
    include_once 'header.php';
    //first page 
?>
    <form class="example" action="product.php" style="width: 1080px; ; margin-left: 435px; padding-right: 30px;" method="get">
        <input type="text" name="search" style="padding: 10px; text-align:right;" placeholder="وش نبي تبحث عنه...؟">
        <button type="submit" name="submit-search" style="padding: 2.5px;"><img src="images/search.png"><i class="fa fa-search"></i></button>
      </form> 
    <div class="row">
        <div class="col-2">
            <h1>عندك واجب وماحليته؟</h1>
            <p>مالك الا موقعنا نحل الواجب عنك مهما كان المقرر ولا جامعتك <br> كلها نص ساعه ويكون عندك</p>
            <p><a href="Product.php" class="bottun">شوف الخيارات</a></p>
        </div>
    </div>
    <div class="container2">
        
        <h2>احدث المنتجات</h2>
        
             <div class="goods">
               <div class="row">
               <?php 
                    $query ="SELECT * FROM `product` ORDER BY `product`.`Date-add` DESC";
                    $result = mysqli_query($conn,$query);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        if($i > 9)
                        break
                        ?>
                        <?php
if($row["quantity"] > 0){//عرض المنتجات
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
                     $i++;
                    } 

                    ?>                  
         </div>
    </div>
</div>
</body>
</html>