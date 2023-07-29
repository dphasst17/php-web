<?php 
    include '../model/user.php';
    $data = user_select_by_role('1');
?>
<table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="px-6 py-3">Mã nhân viên</th>
        <th class="hidden lg:table-cell px-6 py-3">Ảnh đại diện</th>
        <th class="px-6 py-3">Họ và tên</th>
        <th class="hidden md:table-cell px-6 py-3">Email</th>
        <th class="hidden sm:table-cell px-6 py-3">Vai trò</th>
        <th class="w-[10%] text-center px-6 py-3">Chỉnh sửa</th>
      </tr>
  </thead>
</table>

<script>
    let data = [];
    fetch('/api/statistics/staff')
    .then(res => {return res.json()})
    .then(restData => {
        data = restData;
        viewDataStaff(restData)
    })
    const viewDataStaff = (data) =>{
        let viewProduct = data.map(e => `<tbody class="border-b-solid border-b-white border-b-[1px]">
            <tr class="bg-slate-800 ">
                <th class="w-[10%] px-6 py-4">${e.idUser}</th>
               
                <th class="hidden lg:table-cell w-[15%] min-w-[150px] px-6 py-4">
                    <img class="rounded-[10px] border-solid border-white border-[1px]" src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`../public/images/uploads/${e.img}`}  
                        alt="User-image"  style="width:100px;height:100px;object-fit:contain;"/>
                </th>
                <th class="px-6 py-4">${e.nameUser}</th>
                <th class="hidden md:table-cell px-6 py-4">${e.email}</th>
                <th class="hidden sm:table-cell px-6 py-4">Nhân viên</th>
                <th class="w-[10%] justify-center items-center px-6 py-4">
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white">Edit</button>
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] mt-[5%] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white">Delete</button>
                </th>

            </tr>
        </tbody>`).join('');
        document.getElementById("myTable").insertAdjacentHTML('beforeend', viewProduct);
    }
</script>