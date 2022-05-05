<?php
session_start();
require_once('../auth/isLogin.php');
require_once('../components/head.php');
require_once("../components/sidebar.php");
require_once("../../root/database_connect.php");
$lecture_id=$_SESSION['lecture'];
$lecture_specialization = $mysqli->query("
    select specialization_id from lectures where id='$lecture_id'
");
$lecture_specialization=$lecture_specialization -> fetch_row();
$lecture_specialization=$lecture_specialization[0];
$lecture_subjects=$mysqli->query("
select subject_id,name from 
(SELECT subject_id FROM `subjects_specializations` 
WHERE specialization_id=$lecture_specialization) 
as sbj inner join subjects on subjects.id=subject_id
");
require_once("../../root/database_close.php");
?>
    <div class="flex w-full md:space-y-4">
        <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-full overflow-y-auto">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                        <div>
                            <form class="flex flex-col md:flex-row w-3/4 md:w-full md:space-x-3 space-y-3 md:space-y-0 justify-center">
                                <div class=" relative ">
                                    <select class="cursor-pointer block min-w-[13rem] text-white py-2 px-3 border border-gray-300 bg-sky-500 rounded-md shadow focus:outline-none focus:ring-primary-500 focus:border-primary-500" 
                                    name="subject" onchange="getClassRoom()" id="subjects">
                                        <option value="null" hidden>
                                            Chọn môn
                                        </option>
                                        <?php foreach($lecture_subjects as $subject){ ?>
                                        <option value="<?php echo $subject['subject_id'] ?>">
                                            <?php echo $subject['name'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class=" relative ">
                                    <select disabled name="class" id="select-class" onchange="getStudent()"
                                    class="cursor-pointer text-white bg-sky-500 disabled:cursor-auto block w-52 disabled:text-gray-700 py-2 px-3 border border-gray-300 disabled:bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" >
                                        <option value="null" hidden>
                                            Chọn lớp
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
                        <div class="inline-block min-w-full shadow rounded-lg">
                            <form method="post" action="../process/diemdanh-process.php">
                                <table class="table-auto w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                Mã sinh viên
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                Họ tên
                                            </th>
                                            <th scope="col" class="px-7 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                Điểm danh
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                Số buổi nghỉ
                                            </th>
                                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                                Trạng thái
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="students">
                                            
                                    </tbody>
                                </table>
                                <div id="diemdanh-submit" class="flex justify-center">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //Current Tab
        setCssSidebar('diemdanh');
    })
    function getClassRoom(){
        let subject=document.getElementById('subjects');
        let classRoom=document.getElementById('select-class');
        let formData = new FormData();
        let url='../api/diemdanh-class-filter.php';
        formData.append('subject', subject.value);
        fetchAPIFormData(formData,url,response=>{
            let content=`<option value="null" hidden>
                            Chọn lớp
                        </option>`;
            for(let i=0;i<response.length;i++){
                content+=
                `<option value="${response[i]['class_id']}">
                    ${response[i]['class_name']}
                </option>`
            }
            classRoom.innerHTML=content;
            classRoom.disabled = false;
        })
    }
    function getStudent(){
        let subject=document.getElementById('subjects');
        let classRoom=document.getElementById('select-class');
        subject.disabled = true;
        classRoom.disabled = true;
        let students=document.getElementById('students');
        let submit=document.getElementById('diemdanh-submit');
        let formData = new FormData();
        let url='../api/diemdanh-student-filter.php';
        formData.append('classRoom', classRoom.value);
        fetchAPIFormData(formData,url,response=>{
            let content=``;
            for(let i=0;i<response.length;i++){
                let id=response[i]['id'];
                content+=
                `<tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                ${id}
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            ${response[i]['name']}
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="min-w-250 flex">
                            <div class="mx-2">
                                <input class="cursor-pointer" checked id="dihoc-${id}" type="radio" name="state-${id}" value="0">
                                <label class="cursor-pointer" for="dihoc-${id}">Đi học</label>
                            </div>
                            <div class="mx-2">
                                <input class="cursor-pointer" id="nghihoc-${id}" type="radio" name="state-${id}" value="1">
                                <label class="cursor-pointer" for="nghihoc-${id}">Nghỉ học</label>
                            </div>
                            <div class="mx-2">
                                <input class="cursor-pointer" id="cophep-${id}" type="radio" name="state-${id}" value="2" />
                                <label class="cursor-pointer" for="cophep-${id}">Có phép</label>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap text-green-900 font-semibold">
                            10/30
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden="true" class="absolute inset-0 ${stateToStyle(response[i]['state'])} opacity-50 rounded-full">
                            </span>
                            <span class="relative">
                                ${stateToText(response[i]['state'])}
                            </span>
                        </span>
                    </td>
                </tr>`
            }
            students.innerHTML=content;
            submit.innerHTML=`
            <div class="m-4 p-4 min-w-[400px] bg-white inline-block rounded">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div>
                            <span class="font-semibold text-xl">${subject.options[subject.selectedIndex].text}</span>
                            <span class="font-semibold text-xl">-</span>
                            <span class="font-semibold text-xl">${classRoom.options[classRoom.selectedIndex].text}</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <input type="hidden" name="startTime" value="15:30">
                    <input type="hidden" name="endTime" value="17:30">
                    <input type="hidden" name="subject" value="${subject.value}">
                    <input type="hidden" name="class" value="${classRoom.value}">
                    <button type="submit" class="mt-2 py-2 px-4 w-20 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Gửi
                    </button>
                </div>
            </div>`
            subject.disabled = false;
            classRoom.disabled = false;
        })
    }
    function stateToText(state){
        if (state==1){
            return "Đi học";
        }
        if (state==2){
            return "Bảo lưu";
        }
        return "Nghỉ học";
    }
    function stateToStyle(state){
        if(state==1){
            return 'bg-green-200';
        }
        if(state==2){
            return "bg-cyan-500";
        }
        return "bg-red-600";
    }
</script>
<?php require('../components/footer.php') ?>