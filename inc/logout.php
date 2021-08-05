<?php
//logout admin or user if he enter this page
session_start ();
session_unset ();
session_decode ();

header("location: ../ui.php");
exit();