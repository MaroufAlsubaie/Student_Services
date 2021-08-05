<?php
    include_once 'header.php';



    if(isset($_POST["send"])){
       

//our support

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  elseif (empty($_POST["email"])) {
    $emailErr = "Email is required";
  }
  elseif (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $n1=$_POST["name"];
        $n2=$_POST["email"];
        $n3=$_POST["comment"];
        $s ="INSERT INTO `text` (`text`, `email`, `name`, `id`) VALUES ('$n3', '$n2', '$n1', NULL);";
        $sug = mysqli_query($conn,$s);
        echo "<script>alert('تم الأرسال \ شكراً على اقتراحك ')</script>";
  }
  $n1=null;
  $n2=null;
  $n3=null;

    }
    ?>
    
        <div class="row">
            <div class="col-2">


              <br>
            <h1 style=" text-align:right;">التواصل</h1>
                    <br>
                    </div>
             <div class="row">
                <div class="col-3">
                <div class="goods">
                        <div class="image">
                       <a href="https://www.instagram.com/student_services012/"><img style="display: block; margin-left: 380px; margin-right: auto; width: 30%; height: 30%;" src ="images/insta.png"></a> 
                      </div></div>
                      </div>
                      <div class="col-3">
                      <div class="goods">
                        <div class="image">
                       <a href="https://twitter.com/student42495320"><img style=" display: block; margin-left: auto; margin-right: auto; width: 40%; height: 40%;" src ="images/twitter.png" ></a>                         </div></div>
                      </div>
                      <div class="col-3">
                      <div class="goods">
                        <div class="image">
                       <a href="https://wa.me/966530422106"><img style=" display: block; margin-left: auto; margin-right: 380px; width: 40%; height: 40%;" src ="images/whatsapp.png"></a>   
                      </div></div>
                      </div>                    


                <div class="col-3">
                <div class="goods">
                        <div class="image">
                        <img style=" display: block; margin-left: auto; margin-right: auto; width: 70%; height: 70%;" src ="images/imt.png" >
                      </div></div>
                      </div>
                      <div class="col-3">
                      <div class="goods">
                        <div class="image">
                       <a href="mailto:dhalimh503@gmail.com"><img style=" display: block; margin-left: auto; margin-right: 170px; width: 60%; height: 60%;" src ="images/email.png" ></a>                         </div></div>
                      </div>
                      <div class="col-3">
                      <div class="goods">
                        <div class="image">
                        <img style=" display: block; margin-left: auto; margin-right: auto; width: 70%; height: 70%;" src ="images/wmt.png" >
                      </div></div>
                      </div></div></div>
               <?php $nameErr = $emailErr  = "";
                     $name = $email  = $comment = "";


?>

<div class="col-2" style="margin-right:200px">
<h2  style=" text-align:right;">صندوق الشكاوي و الاقتراحات</h2>
<br>
<p  style="text-align:right;"><span> </span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 <p style="text-align:right;"> الاسم</p>: <input type="text"   style=" float:right; text-align:right;" name="name">
  <span> <?php echo $nameErr?></span>
  <br><br>
 <p style="text-align:right;">الايميل</p>: <input type="text"   style=" float:right; text-align:right;" name="email">
  <span><?php echo $emailErr?></span>
  <br>

  <br><br>
  <p style="text-align:right;">شكوى/اقتراحك؟</p>: <textarea name="comment"  style=" float:right; text-align:right;" rows="5" cols="40"></textarea>
  <br><br>


  <br><br>
                <br>                
                <br>


  <input  type="submit" name="send" class="bottun1" value="ارسال" style="font-size:16px; float:right;" >


</form>


                <br><br>
                <br>                
                <br>
                <br><br>
                <br>                
                <br>
                <br>
                








                   






                   
                        

            