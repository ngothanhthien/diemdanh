<?php
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$state=$_POST['state'];
$lecture=$_SESSION['lecture'];
$class=$_POST['class'];
$subject=$_POST['subject'];
///kiem_tra_diem_danh.php require lecture subject class
require_once '../../root/kiem_tra_da_diem_danh.php';
/// @dateDiff>0 la da chua diem danh
///$attendances_id neu co
if($dateDiff>0){
    $mysqli->query("
        INSERT INTO attendances (subject_id,lecture_id,class_id)
        VALUES ('$subject','$lecture','$class');
    ");
    $attendances_id=$mysqli->insert_id;
    foreach ($state as $student_id=>$attend){
        $mysqli->query("
            INSERT INTO attendances_students (attendance_id,student_id,attend)
            VALUES ('$attendances_id','$student_id','$attend');
        ");
    }
    $_SESSION['status']='điểm danh';
}else{
    $mysqli->query("
        update attendances
        set updated_at=now()
        where id='$attendances_id'
    ");
    foreach ($state as $student_id=>$attend){
        $mysqli->query("
            update attendances_students 
            set attend='$attend'
            where attendance_id='$attendances_id' and student_id='$student_id';
        ");
    }
    $_SESSION['status']='cập nhật';
}
////
require_once '../../root/database_close.php';
header('Location: ../layouts/diemdanh.php');
