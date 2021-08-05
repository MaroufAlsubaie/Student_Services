<?php
//logout admin or user if he enter this page
session_start ();
session_unset ();//حذف المتغيرات
session_decode ();

header("location: ../ui.php");
exit();