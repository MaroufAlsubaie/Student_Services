<?php
    include_once 'header.php';
?>
        
             <div class="container2">

                 <form class="example" action="/product.php">
                      <input type="text"name="search">
                      <button type="submit" style="padding: 2.5px;"><img src="/images/search.png"><i class="fa fa-search"></i></button>
                    </form>
                    <br>
                    <br>
                    <br>
                 <div class="goods">
                     <?php
                     $query ="SELECT * FROM product ORDER BY id ASC ";
                        if (isset($_GET["sort"])){
                            if ($_GET["sort"] == "low")
                            $query ="SELECT * FROM `product` ORDER BY `product`.`price` ASC";
                            elseif ($_GET["sort"] == "high")
                            $query ="SELECT * FROM `product` ORDER BY `product`.`price` DESC";
                            elseif ($_GET["sort"] == "abc")
                            $query ="SELECT * FROM `product` ORDER BY `product`.`Name` ASC";
                            elseif ($_GET["sort"] == "high")
                            $query ="SELECT * FROM `product` ORDER BY `product`.`Name` DESC";

                        }
                            ?>

                 <form method="get">
                   <select name="sort" style="margin-left:890px; margin-bottom:20px ;" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option >....الترتيب</option>
                    <option >عادي</option>
                    <option value="low">من الاقل للاعلى</option>
                    <option value="high">من الاعلى للاقل</option>
                    <option value="abc">من الالف للياء</option>
                    <option value="cba">من الياء للالف</option>
                    </select>
                </form>
                <form method="get">
                <?php 
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
                
                <button type="submit" class="bottun11" > فلتر</button>
                </form>
                   <div class="row">
                   
                   <?php 
                    if(isset($_GET['type']))
                    {
                        $typechecked = [];
                        $typechecked = $_GET['type'];
                        foreach($typechecked as $rowbrand)
                        {
                            
                            
                    
                    if (isset($_GET["sort"])){
                        if ($_GET["sort"] == "low")
                        $query ="SELECT * FROM `product` where type = '$rowbrand' ORDER BY `product`.`price` ASC";
                        elseif ($_GET["sort"] == "high")
                        $query ="SELECT * FROM `product` where type IN ($rowbrand) ORDER BY `product`.`price` DESC";
                        elseif ($_GET["sort"] == "abc")
                        $query ="SELECT * FROM `product` where type IN ($rowbrand) ORDER BY `product`.`Name` ASC";
                        elseif ($_GET["sort"] == "high")
                        $query ="SELECT * FROM `product` where type IN ($rowbrand) ORDER BY `product`.`Name` DESC";
                        else 
                        $query ="SELECT * FROM `product` where type = '$rowbrand' ORDER BY `ID` ASC";
                    }}}
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
                        <input type="submit" name="add" class="bottun1" value="اضف الى السلة" style="font-size:16px;">
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