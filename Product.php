<?php
    include_once 'header.php';
?>
        
             <div class="container2">

                 <form class="example" action="/action_page.php">
                      <input type="text"name="search">
                      <button type="submit" style="padding: 2.5px;"><img src="/images/search.png"><i class="fa fa-search"></i></button>
                    </form>
                    <br>
                    <br>
                    <br>
                 <div class="goods">
                   <div class="row">
                    
                   <?php 
                    $query ="SELECT * FROM product ORDER BY id ASC ";
                    $result = mysqli_query($conn,$query);


                    while($row = mysqli_fetch_assoc($result)) {?>
                    <div class="col-3">
                        <div class="image">
                        <form method="post" action="cart.php?id=<?=$row['ID']?>">
                        <a href=<?=$row['src'];?>><img src="images/<?=$row['photo']?>"></a>
                        <h4><?=$row['Name']; ?></h4>
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