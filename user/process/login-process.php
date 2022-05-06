<?php 
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$account=mysqli_real_escape_string($mysqli,$_POST['account']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$sql = "SELECT id,name FROM lectures WHERE account = '$account' and password = '$password'";
$result =$mysqli->query($sql);
$count = mysqli_num_rows($result);
$row = $result -> fetch_all(MYSQLI_ASSOC);
require_once '../../root/database_close.php';
if($count == 1) {
    $_SESSION['lecture'] = $row[0]['id'];
    $_SESSION['lecture_name']=$row[0]['name'];
    header('Location: ../layouts/diemdanh.php');
 }else {
    // $error = "Your Login Name or Password is invalid";
    $_SESSION['message_lecture']='Sai tài khoản hoặc mật khẩu';
    header('Location: ../layouts/login.php');
 }
