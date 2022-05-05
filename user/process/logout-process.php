<?php 
session_start();
require_once('../auth/isLogin.php');
unset($_SESSION['lecture']);
header('Location: ../layouts/login.php');
?>