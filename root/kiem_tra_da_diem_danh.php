<?php 
$attendances_result=$mysqli->query("
    select created_at,id from attendances where class_id=$class and lecture_id=$lecture and subject_id=$subject
    order by created_at DESC
    limit 1
");
$attendances_result=$attendances_result->fetch_all(MYSQLI_ASSOC);
$dateDiff=1;
if(count($attendances_result)>0){
    $ngay_diem_danh_gan_nhat=$attendances_result[0]['created_at'];
    $ngay_diem_danh_gan_nhat=date("Y-m-d",strtotime($ngay_diem_danh_gan_nhat));
    $today=date("Y-m-d",time());
    $dateDiff=(strtotime($today)-strtotime($ngay_diem_danh_gan_nhat))/(60*60*24);
    $attendances_id=$attendances_result[0]['id'];
}
