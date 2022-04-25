<?php require('../components/head.php') ?>
<?php require "../components/sidebar.php" ?>
<div class="flex w-full md:space-y-4">
    <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-full overflow-y-auto">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                    <div>
                        <form class="flex flex-col md:flex-row w-3/4 md:w-full max-w-sm md:space-x-3 space-y-3 md:space-y-0 justify-center">
                            <div class=" relative ">
                                <select class="cursor-pointer block w-52 text-white py-2 px-3 border border-gray-300 bg-sky-500 rounded-md shadow focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals">
                                    <option value="null">
                                        Chọn môn
                                    </option>
                                    <option value="dog">
                                        Dog
                                    </option>
                                    <option value="cat">
                                        Cat
                                    </option>
                                    <option value="hamster">
                                        Hamster
                                    </option>
                                    <option value="parrot">
                                        Parrot
                                    </option>
                                    <option value="spider">
                                        Spider
                                    </option>
                                    <option value="goldfish">
                                        Goldfish
                                    </option>
                                </select>
                            </div>
                            <div class=" relative ">
                                <select disabled class="cursor-pointer text-white bg-sky-500 disabled:cursor-auto block w-52 disabled:text-gray-700 py-2 px-3 border border-gray-300 disabled:bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals">
                                    <option value="null">
                                        Chọn lớp
                                    </option>
                                    <option value="dog">
                                        Dog
                                    </option>
                                    <option value="cat">
                                        Cat
                                    </option>
                                    <option value="hamster">
                                        Hamster
                                    </option>
                                    <option value="parrot">
                                        Parrot
                                    </option>
                                    <option value="spider">
                                        Spider
                                    </option>
                                    <option value="goldfish">
                                        Goldfish
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
                    <div class="inline-block min-w-full shadow rounded-lg">
                        <form method="post" action="../process/diemdanh.php">
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
                                <tbody>
                                    <?php for ($x = 0; $x <= 30; $x++) { ?>

                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        BK-1
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    Ngô Thanh Thiên
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="min-w-250 flex">
                                                    <div class="mx-2">
                                                        <input class="cursor-pointer" checked id="dihoc-1" type="radio" name="state[1]" value="0">
                                                        <label class="cursor-pointer" for="dihoc-1">Đi học</label>
                                                    </div>
                                                    <div class="mx-2">
                                                        <input class="cursor-pointer" id="nghihoc-1" type="radio" name="state[1]" value="1">
                                                        <label class="cursor-pointer" for="nghihoc-1">Nghỉ học</label>
                                                    </div>
                                                    <div class="mx-2">
                                                        <input class="cursor-pointer" id="cophep-1" type="radio" name="state[1]" value="2" />
                                                        <label class="cursor-pointer" for="cophep-1">Có phép</label>
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
                                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                                    </span>
                                                    <span class="relative">
                                                        Đi học
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="flex justify-center">
                                <div class="m-4 p-4 bg-white inline-block rounded">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center">
                                            <div>
                                                <span class="font-semibold text-xl">Lập trình Web</span>
                                                <span class="font-semibold text-xl">-</span>
                                                <span class="font-semibold text-xl">BKC1</span>
                                            </div>
                                            <div class="bg-white inline-flex items-center border-solid border-2 border-indigo-600 p-2 my-2 mx-2">
                                                <span class="text-left">
                                                    <svg class="m-auto" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                                                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z" />
                                                    </svg>
                                                </span>
                                                <div class="ml-2">
                                                    <span>15:30</span>
                                                    <span>-</span>
                                                    <span>17:30</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <input type="hidden" name="startTime" value="15:30">
                                        <input type="hidden" name="endTime" value="17:30">
                                        <input type="hidden" name="subject" value="Lập trình web">
                                        <input type="hidden" name="class" value="BKC1">
                                        <button type="submit" class="mt-2 py-2 px-4 w-20 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        //Current Tab
        setCssSidebar('diemdanh');
    })
</script>
<?php require('../components/footer.php') ?>