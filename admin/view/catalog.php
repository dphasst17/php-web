
<div class="w-[200px] h-[40px] flex items-center justify-center mb-[1%] text-white text-[20px] font-bold rounded-[5px] bg-blue-950 hover:bg-blue-700 cursor-pointer"  onclick="window.location.href='index.php?act=new'">Thêm danh mục</div>
<table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="px-6 py-3">Mã loại</th>
        <th class="px-6 py-3">Tên loại</th>
        <th class="hidden smr:table-cell px-6 py-3">Giá thấp nhất</th>
        <th class="hidden smr:table-cell px-6 py-3">Giá trung bình</th>
        <th class="hidden smr:table-cell px-6 py-3">Giá cao nhất</th>
        <th class="hidden lg:table-cell px-6 py-3">Chỉnh sửa</th>
        <th class="hidden lg:table-cell px-6 py-3">Xóa</th>
        <th class="block md:hidden w-auto px-6 py-3">More</th>
      </tr>
  </thead>
</table>
<script>
    let data = [];
    fetch('/api/statistics/type')
    .then(res => {return res.json()})
    .then(restData => {
        data=restData;
        viewDataType(restData)
    })
    let table = document.getElementById("myTable");
    const viewDataType = (data) => {
        let viewData = data.map(e => `<tbody class="h-[60px]">
            <tr class="bg-slate-800" style="cursor:pointer;">
                <td class=" text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">${e.idType}</td>
                <td class=" text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">${e.nameType}</td>
                <td class="hidden smr:table-cell text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">${e.min} USD</td>
                <td class="hidden smr:table-cell text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">${e.medium} USD</td>
                <td class="hidden smr:table-cell text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">${e.max} USD</td>
                <td class="hidden lg:table-cell w-[10%] text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">
                    <button class="w-full flex items-center justify-center h-[30px] rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white">Edit</button>
                </td>
                <td class="hidden lg:table-cell w-[10%] text-white text-[15px] border-b-solid border-b-[1px] border-b-white px-6 py-3">
                    <button class="w-full flex items-center justify-center h-[30px] rounded-[5px] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white">Delete</button>
                </td>
                <th class="block md:hidden m-auto flex justify-center items-center px-6 py-4">
                    <svg class="w-5 h-5 text-white hover:text-blue-500 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </th>
            </tr>
        </tbody>`).join('');
        document.getElementById("myTable").insertAdjacentHTML('beforeend', viewData);
    }
</script>