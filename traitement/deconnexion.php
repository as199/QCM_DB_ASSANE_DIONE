<?php
session_start();
setcookie('username','', time()-3600);
setcookie('password','', time()-3600);
unset($_SESSION['sess_user_id']);
unset($_SESSION['connecter'] );
unset($_SESSION['sess_user_id']);
unset($_SESSION['sess_username']);
unset($_SESSION['sess_name'] );

session_destroy();  
 header("Location:../index.php");
 ?>