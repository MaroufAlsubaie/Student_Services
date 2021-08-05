<?php
    include_once 'header.php';
    // here where user can revail his address info
    ?>
    
<div class="container2">
   <br>
   <br>
   <br>
  <div class="row">

<?php
    require 'inc/dbh-inc.php';

    $usersId = $_SESSION["usersId"];
    $i = 0;

    $sql = "SELECT * FROM `address` WHERE `usersId` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $usersId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt); ?>
    <form action="addressupdate.php" method="POST"> <?php
    while($row = mysqli_fetch_assoc($resultData)) {
        echo "<div class='col-3'>";
        echo "<h4>${row['contry']}</h4>";
        echo "<h4>${row['ctiy']}</h4>";
        echo "<h4>${row['street']}</h4>";
        echo "<h4>${row['pin']}</h4>";
        echo "<h4>${row['phoneNum']}</h4>"; ?>
          <input type="hidden" name="hidden_address" value="<?php echo $row["addressiD"]?>">
        <p><a href='addressupdate.php?addressId=<?php echo $row['addressiD']; ?>' class='bottun'>تعديل العنوان</a></p>
        </form>
        </div>
        <?php
        $i ++;
    }
    if ($i==0) { 
        header("location: address.php");
        exit();
    }
    mysqli_stmt_close($stmt);
?>
<p style="margin-top:120px;"><a href="address.php" class="bottun">اضافة عنوان</a></p>
