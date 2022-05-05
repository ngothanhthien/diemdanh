<?php
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$classRoom=$_POST['classRoom'];
$students=$mysqli->query("
SELECT id,name,state FROM `students` WHERE class_id=$classRoom
");
$students=mysqli_fetch_all($students,MYSQLI_ASSOC);
require_once '../../root/database_close.php';
exit(json_encode($students));