<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>STUDENT Service | Project of CTI Student</title>
    <link rel="stylesheet" href="login_style.css?version=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
  </head>
  <body>
    <div class="headbackground">
        <div class="wrapper">
          <header>التسجيل </header>
          <form action="inc/signup-inc.php" method="POST">
            <div class="field email">
                <div class="input-area">
                    <input type="text" name="name" placeholder="اسم المستخدم" />
                  </div>
            </div>

            <div class="field email">
              <div class="input-area">
                <input type="text" name="email" placeholder="البريد الالكتروني" />
                <i class="icon fas fa-envelope"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
              </div>
            </div>

            <div class="field password">
              <div class="input-area">
                <input type="password" name="pas" placeholder="الرقم السري" />
                <i class="icon fas fa-lock"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
              </div>
            </div>

              <div class="field password">
                <div class="input-area">
                  <input type="password" name="pasRep" placeholder="اعادة الرقم السري" />
                  <i class="icon fas fa-lock"></i>
                  <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                
                <div class="field error-txt"><?php
            if (isset($_GET["error"])){
              if ($_GET["error"] == "emptyinput"){
                echo "الرجاء الدخال جميع المعلومات";
              }
              else if ($_GET["error"] == "invalidUid"){
                echo "اسم المستخدم غير مكتوب بطريقه صحيحة";
              }
              else if ($_GET["error"] == "invalidEmail"){
                echo "البريد الالكتروني غير مكتوب بطريقه صحيحة";
              }
              else if ($_GET["error"] == "passnotmatch"){
                echo "الرقم السري لا يتطابق";
              }
              else if ($_GET["error"] == "nametaken"){
                echo "اسم المستخدم ماخوذ";
              }
              else if ($_GET["error"] == "stmtfailed"){
                echo "خطأ في إرسال المعلومات";
              }
            }
            ?>
            </div>

            </div>
            <input type="submit" name="sup" value="تسجيل حساب" />
          </form>
          <div class="sign-txt">عندك حساب ؟ <a href="login.php">سجل دخولك</a></div>
        </div>
      </div>
  </body>
  </html>