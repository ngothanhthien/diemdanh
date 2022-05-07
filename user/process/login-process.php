<?php 
function dang_nhap_that_bai(){
    $_SESSION['message_lecture']='Sai tài khoản hoặc mật khẩu';
    header('Location: ../layouts/login.php');
}
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$account=mysqli_real_escape_string($mysqli,$_POST['account']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$result =$mysqli->query( "SELECT id,name,password FROM lectures WHERE account = '$account'");
$count = mysqli_num_rows($result);
if($count != 1) {
    dang_nhap_that_bai();
    require_once '../../root/database_close.php';
}
$row = $result -> fetch_all(MYSQLI_ASSOC)[0];
$hash = $row['password'];
require_once '../../root/database_close.php';
if (password_verify($password, $hash)){
    $_SESSION['lecture'] = $row['id'];
    $_SESSION['lecture_name']=$row['name'];
    header('Location: ../layouts/diemdanh.php');
}
dang_nhap_that_bai();

