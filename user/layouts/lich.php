<?php require "../components/head.php";
require "../components/sidebar.php"; 
$month=date('m');
$year=date('Y');
$totalDay=cal_days_in_month(CAL_GREGORIAN,$month,$year);
$startDay=date('w', strtotime(date('Y-m-1')));
if($startDay==0){
    $startDay=7;
}
$dayTracking=0;
?>
<div class="flex w-full md:space-y-4">
    <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-full overflow-y-auto">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div class="wrapper bg-white rounded shadow w-full ">
                    <div class="header flex justify-between border-b p-2">
                        <span class="text-lg font-bold">
                            <span>Tháng&nbsp;</span><span><?php echo $month; ?></span>, <span><?php echo $year; ?></span>
                        </span>
                    </div>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ hai</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ ba</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ tư</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ năm</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ sáu</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Thứ bảy</span>
                                </th>
                                <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
                                    <span class="xl:block lg:block md:block sm:block hidden">Chủ nhật</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- first line  -->
                            <tr class="text-center h-20">
                                <?php for($i=1;$i<$startDay;$i++){ ?>
                                <td class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition duration-500 ease">
                                    <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto overflow-hidden">
                                        <div class="top h-5 w-full">
                                        </div>
                                    </div>
                                </td>
                                <?php } ?>
                                <?php for($i=1;$i<=8-$startDay;$i++){
                                   $dayTracking++  ?>
                                <td class="border p-1 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition duration-500 ease"
                                    id="day<?php echo $dayTracking ?>">
                                    <div class="flex flex-col mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                                        <div class="top h-5 w-full">
                                            <span class="text-gray-500"><?php echo $dayTracking ?></span>
                                        </div>
                                        <div class="bottom flex-grow h-30 py-1 w-full">
                                            <div class="group bg-purple-400 text-white rounded p-1 text-sm mb-1">
                                                <span class="">
                                                    BKC1
                                                </span>
                                                <span class="time">
                                                    12:00~14:00
                                                </span>
                                                <div>
                                                    Mạng máy tính
                                                </div>
                                            </div>
                                            <div class="group bg-orange-300 text-white rounded p-1 text-sm mb-1">
                                                <span class="">
                                                    BKC1
                                                </span>
                                                <span class="time">
                                                    12:00~14:00
                                                </span>
                                                <div>
                                                    Mạng máy tính
                                                </div>
                                            </div>
                                            <div class="group bg-lime-500 text-white rounded p-1 text-sm mb-1">
                                                <span class="">
                                                    BKC1
                                                </span>
                                                <span class="time">
                                                    12:00~14:00
                                                </span>
                                                <div>
                                                    Mạng máy tính
                                                </div>
                                            </div>
                                            <div class="group bg-purple-400 text-white rounded p-1 text-sm mb-1">
                                                <span class="">
                                                    BKC1
                                                </span>
                                                <span class="time">
                                                    12:00~14:00
                                                </span>
                                                <div>
                                                    Mạng máy tính
                                                </div>
                                            </div>
                                            <div class="bg-gray-600 text-white rounded p-1 text-sm mb-1">
                                                <span>
                                                    BKC2
                                                </span>
                                                <span class="time">
                                                    18:00~20:00
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <?php } ?>
                            </tr>
                            <!-- end first line-->
                            <!-- lines -->
                            <?php while($dayTracking<$totalDay){ ?>
                            <tr class="text-center h-20">
                                <?php for($i=0;$i<7;$i++){ 
                                $dayTracking++ ?>
                                <td class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition duration-500 ease"
                                    id="day<?php echo $dayTracking ?>">
                                    <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                                        <div class="top h-5 w-full">
                                            <span class="text-gray-500"><?php if($dayTracking<=$totalDay){ echo $dayTracking; } ?></span>
                                        </div>
                                        <div class="bottom flex-grow h-30 py-1 w-full"></div>
                                    </div>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                            <!-- end lines -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        //Current Day
        let today=new Date();
        today=today.getDate();
        currentDay=document.getElementById('day'+today);
        currentDay.classList.add('bg-red-200');
        //Current Tab
        setCssSidebar('lichday');
    })
</script>
<?php require "../components/footer.php" ?>