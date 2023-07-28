<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-[2%] lg:min-h-[300px]">
  <thead class="h-[50px] text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="hidden lg:table-cell w-[10%] text-white text-center px-6 py-3">Mã bình luận</th>
        <th class="hidden smr:table-cell w-[10%] text-white text-center px-6 py-3">Mã hàng hóa</th>
        <th class="w-[5%]smr:w-[10%] text-white text-center px-6 py-3">Mã khách hàng</th>
        <th class="w-[5%] smr:w-[10%] text-white text-center px-6 py-3">Nội dung</th>
        <th class="hidden lg:table-cell w-[15%] text-white text-center px-6 py-3">Ngày bình luận</th>
        <th class="w-[20%] smr:w-[15%] md:w-[10%] text-white text-center px-6 py-3"></th>
      </tr>
  </thead>
  <tbody id="myTable"></tbody>
</table>
<div class="pagination w-full flex items-center justify-center my-[2%] mx-auto">
        <div class="buttonPage w-2/5 min-w-[250px] h-full flex justify-evenly overflow-hidden" id="buttonPage">
        </div>
</div>
<script>
    let data = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage =0;
    let totalPage2 =0;
    fetch('/api/comment')
    .then(res => {return res.json()})
    .then(restData => {
        data = restData
        totalPage2 = restData.length % itemsInPage === 0 ? restData.length / itemsInPage : (restData.length / itemsInPage) + 1;
        viewComment(restData,start,end);
        paginationPage("btnComment","viewComment",);
    })
    const viewComment = (e,start,end) => {
        let viewProduct = e.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th class="hidden lg:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idComment}</th>
                <th class="hidden smr:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idProduct}</th>
                <th class="w-[10%] text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idUser}</th>
                <th class="text-white text-[15px] font-semibold border-solid -border-white border-[.2px] overflow-hidden whitespace-nowrap text-ellipsis px-6 py-3">${e.commentValue}</th>
                <th class="hidden lg:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.dateComment}</th>
                <th class="table-cell px-6 py-3">
                    <button class="w-[100px] sm:w-full min-w-[100px] h-[30px] rounded-[5px] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white">Delete</button>
                </th>
                
            </tr>
        `).join('');
        document.getElementById("myTable").innerHTML = viewProduct;
        paginationPage("btnComment","viewComment");
    }
</script>
<script src="/public/js/adminHandle.js"></script>