<?php
    include_once 'header.php';
?>
    <form class="example" action="product.php" style="width: 1080px; ; margin-left: 435px; padding-right: 30px;">
        <input type="text" name="search" style="padding: 10px;">
        <button type="submit" style="padding: 2.5px;"><img src="/images/search.png"><i class="fa fa-search"></i></button>
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
                    $query ="SELECT * FROM product ORDER BY id ASC ";
                    $result = mysqli_query($conn,$query);


                    while($row = mysqli_fetch_assoc($result)) {?>
                    <div class="col-3">
                        <div class="image">
                        <form method="post" action="cart.php?id=<?=$row['ID']?>">
                        <img src="images/<?=$row['photo']?>">
                        <h4><?=$row['Name'];?></h4>
                        <p><?=$row['price'];?> ريال</p>
                        <input type="number" name="quantity" class="input1" value="1">
                        <input type="hidden" name="hidden_name" value="<?php echo $row["Name"]?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]?>">
                        <input type="submit" name="add" class="bottun1" value="اضف الى السلة">
                    </div>
                    </form>
                    </div>
                    <?php } 

                    ?>                  
         </div>
    </div>
</div>
</body>
</html>