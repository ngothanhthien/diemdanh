<?php
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$subject=$_POST['subject'];
$lecture=$_SESSION['lecture'];
$classRoom=$mysqli->query("
select classes.id as class_id, classes.name as class_name from 
(SELECT class_id FROM `assigns` WHERE lecture_id=$lecture and subject_id=$subject) as subclass
inner join classes on class_id=classes.id
");
$classRoom=mysqli_fetch_all($classRoom,MYSQLI_ASSOC);
require_once '../../root/database_close.php';
exit(json_encode($classRoom));