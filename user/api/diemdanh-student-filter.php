<?php
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}
require_once '../../root/database_connect.php';
$classRoom=$_POST['classRoom'];
$subject=$_POST['subject'];
$students=$mysqli->query("
SELECT id,name,state FROM `students` WHERE class_id=$classRoom
");
$students=mysqli_fetch_all($students,MYSQLI_ASSOC);
///////////////////////////
$attendances=$mysqli->query("
SELECT id FROM `attendances` WHERE subject_id=$subject and class_id=$classRoom"
);
$num_attendance=mysqli_num_rows($attendances);
/////////////
$mang_bao_danh=array();
foreach($students as $student){
    $student_id=$student['id'];
    $total=0;
    $bao_danh=$mysqli->query("
        select attend from (SELECT * FROM `attendances_students` WHERE student_id=$student_id) as student_target
        inner join attendances on attendance_id=attendances.id
        where subject_id=$subject"
    );
    $bao_danh=mysqli_fetch_all($bao_danh,MYSQLI_ASSOC);
    foreach($bao_danh as $one){
        if($one['attend']==0){
            $total++;
        }elseif($one['attend']==2){
            $total+=1/3;
        }
    }
    if(is_float($total)){
        $total=number_format($total,1);
    }
    $mang_bao_danh[$student_id]=$total;
}
/////////////////////////////////////////
$lecture=$_SESSION['lecture'];
$class=$classRoom;
///kiem_tra_diem_danh.php require lecture subject class
require_once '../../root/kiem_tra_da_diem_danh.php';
/// dateDiff>0 la da chua diem danh
//////$attendances_id neu da diem danh
$attends=null;
if(!$dateDiff>0){
    $attends=$mysqli->query("
        select	student_id,attend from attendances_students where attendance_id=$attendances_id
    ");
    $attends=$attends->fetch_all(MYSQLI_ASSOC);
}
/////////////////////////////////////////
$data=array("students"=>$students,
            "totalDay"=>$num_attendance,
            "baoDanh"=>$mang_bao_danh,
            "attends"=>$attends,
        );
require_once '../../root/database_close.php';
exit(json_encode($data));