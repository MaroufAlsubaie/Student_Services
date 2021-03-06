<!DOCTYPE html>
<html lang="en">
  <!--هنا حيث يمكن للمسؤول تسجيل الدخول-->
  <head>
    <meta charset="UTF-8" />
    <title>STUDENT Service | Project of CTI Student</title>
    <link rel="stylesheet" href="login_style.css?version=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <div class="headbackground">
      <div class="wrapper">
        <header>تسجيل الدخول</header>
        <form action="inc/admin_login-inc.php" method="POST">
          <div class="field email">
            <div class="input-area">
              <!--ادخال معلومات الادمن-->
              <input type="text" name="name" placeholder="اسم الادمن" /> 
              <i class="icon fas fa-envelope"></i>
              <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
          </div>
          <div class="field password">
            <div class="input-area">
              <input type="password" name="pass" placeholder="الرقم السري" />
              <i class="icon fas fa-lock"></i>
              <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <!--اظهار خطاء اذا كان المدخل غير صحيح-->
            <div class="field error-txt"><?php
            if (isset($_GET["error"])){
              if ($_GET["error"] == "emptyinput"){
                echo "الرجاء الدخال المعلومات";
              }
              else if ($_GET["error"] == "wronglogin"){
                echo "اسم الادمن أو رقم سري غير صحيح";
              }
            }
            ?>

            </div>
          </div>
          <input type="submit" name="sup" value="تسجيل الدخول" />
        </form>
      </div>
    </div>
  </body>
</html>
