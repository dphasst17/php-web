<button class="w-[200px] h-[40px] text-[20px] text-center font-semibold rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white">Thêm mới nhân viên</button>
<div class="title text-[30px] text-center font-semibold text-white mb-[2%]">Danh sách nhân viên</div>
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
<div class="title text-[30px] text-center font-semibold text-white mt-[8%] mb-[2%]">Danh sách người dùng</div>
<table id="all" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="px-6 py-3">Id</th>
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
    let checkRole = <?php echo '"'.$_SESSION["admin"].'"';?>;
    fetch('/api/statistics/staff')
    .then(res => {return res.json()})
    .then(restData => {
        data = restData;
        viewDataStaff(restData,'myTable','Remove Staff','2')
    })
    fetch('/api/user/all')
    .then(res => {return res.json()})
    .then(restData => {
        data = restData;
        viewDataStaff(restData,'all','Change Role','1')
    })
    const viewDataStaff = (data,id,text,newRole) =>{
        let viewProduct = data.map(e => `<tbody class="border-b-solid border-b-white border-b-[1px]">
            <tr class="bg-slate-800 ">
                <th class="w-[10%] px-6 py-4">${e.idUser}</th>
               
                <th class="hidden lg:table-cell w-[15%] min-w-[150px] px-6 py-4">
                    <img class="rounded-[10px] border-solid border-white border-[1px]" src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`../public/images/uploads/${e.img}`}  
                        alt="User-image"  style="width:100px;height:100px;object-fit:contain;"/>
                </th>
                <th class="px-6 py-4">${e.nameUser}</th>
                <th class="hidden md:table-cell px-6 py-4">${e.email}</th>
                <th class="hidden sm:table-cell px-6 py-4">
                ${
                    e.roleUser === "0" || e.roleUser === "1" ? e.roleUser === "0" ? "Admin":"Nhân viên" : "Người dùng"
                    
                }</th>
                <th class="w-[10%] justify-center items-center px-6 py-4">
                ${checkRole === 'admin' 
                    ? `<button onclick="changeRole('${e.idUser}',${newRole})" class="w-full min-w-[100px] h-[30px] rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white">${text}</button>` 
                    :""}
                    
                </th>

            </tr>
        </tbody>`).join('');
        document.getElementById(id).insertAdjacentHTML('beforeend', viewProduct);
    }
    const changeRole = (idUser,newRole) =>{
        let postData = {id:idUser,role:newRole}
        fetch('/api/staff/change',{
            method:'POST',
            body:JSON.stringify(postData)
        })
        .then(res => {if(res.status === 200){
            window.location.href = "/admin/staff"
        }})
    }
</script>