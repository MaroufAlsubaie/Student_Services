<?php
    include_once 'header.php';
    //إضافة إلى سلة التسوق إذا قام المستخدم بالضغط على زر الإضافة
    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"ID");
            $getid = $_GET["id"];
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);    //تخزين المنتجات في دالة
                $item_array = array(
                    'ID' => $_GET["id"],
                    'Name' => $_POST["hidden_name"],
                    'price' => $_POST["hidden_price"],
                    'quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="cart.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }else{
            $item_array = array(
                'ID' => $_GET["id"],
                'Name' => $_POST["hidden_name"],
                'price' => $_POST["hidden_price"],
                'quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){//حذف المنتج اذا تم الضغط على حذف
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["ID"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }

?>
<br>
<br><br><br><br><br><br>
<div class="container2">
<div class="goods">
<div class="row">

<table class="table">
    <tr>
        <th  class="th">Product Name</th>
        <th  style="padding-left: 5px; padding-right: 5px;" class="th">Quantity</th>
        <th style="padding-left: 10px; padding-right: 10px;" class="th">Price Details</th>
        <th style="padding-left: 30px; padding-right: 30px;" class="th">Total Price</th>
        <th style="padding-left: 5px; padding-right: 5px;" class="th">Remove Item</th>
    </tr>

    <?php

        if(!empty($_SESSION["cart"])){
            $total = 0;
            foreach ($_SESSION["cart"] as $key => $value) {//عرض المنتجات المضافة الى السلة
                ?>
                <tr>
                    <td class="td"><?php echo $value["Name"]; ?></td>
                    <td class="td"><?php echo $value["quantity"]; ?></td>
                    <td class="td"><?php echo $value["price"]; ?></td>
                    <td class="td"><?php echo number_format($value["quantity"] * $value["price"], 2); ?></td>
                    <td class="td"><a href="cart.php?action=delete&id=<?php echo $value["ID"]; ?>"><span class="text-danger">Remove Item</span></a></td>

                </tr>
                <?php
                $total = $total + ($value["quantity"] * $value["price"]);
               
            }
            $_SESSION["total"] = $total;
                ?>

                <tr>
                    <th class="th">Total</th>
                    <th class="th"></th>
                    <th class="th"></th>
                    <th class="th"><?php echo number_format($total, 2);?>ريال</th>
                    <?php
                if (isset($_SESSION["usersId"])){
                    echo "<td class='th'><a href='addressList.php'><span class='text-danger'>Checkout</span></a></td>";
                }
                else{
                    echo "<td class='th'><a href='login.php'><span class='text-danger'>Checkout</span></a></td>";

                }
                ?> 
                </tr>
                <?php
            }
           
        ?>
        
    </table>
    </div>

    </div>
        </div>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
        <br><br><br><br><br>
    </body>
</html>
