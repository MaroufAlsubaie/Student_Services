<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>STUDENT Service | Project of CTI Student</title>
    <link rel="stylesheet" href="login_style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <div class="headbackground">
      <div class="wrapper">
        <header>تسجيل الدخول</header>
        <form action="login-inc.php" method="POST">
          <div class="field email">
            <div class="input-area">
              <input type="text" name="name" placeholder="البريد الالكتروني" />
              <i class="icon fas fa-envelope"></i>
              <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Email can't be blank</div>
          </div>
          <div class="field password">
            <div class="input-area">
              <input type="password" name="pas" placeholder="الرقم السري" />
              <i class="icon fas fa-lock"></i>
              <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Password can't be blank</div>
          </div>
          <div class="pass-txt"><a href="#">نسيت رقمك السري؟</a></div>
          <input type="submit" value="تسجيل الدخول" />
        </form>
        <div class="sign-txt">عضو جديد ؟ <a href="register.php">سجل الان</a></div>
      </div>
    </div>
  </body>
</html>
