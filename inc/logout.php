<?php

session_start ();
session_unset ();//حذف المتغيرات
session_decode ();

header("location: ../ui.php");
exit();