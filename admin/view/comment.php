<?php 
    include '../model/comment.php';
    $data = comment_select_all();
    
?>
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-[2%] lg:min-h-[300px]">
  <thead class="h-[50px] text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="hidden lg:table-cell w-[10%] text-white text-center px-6 py-3">Mã bình luận</th>
        <th class="hidden smr:table-cell w-[10%] text-white text-center px-6 py-3">Mã hàng hóa</th>
        <th class="w-[10%] text-white text-center px-6 py-3">Mã khách hàng</th>
        <th class="text-white text-center px-6 py-3">Nội dung</th>
        <th class="hidden lg:table-cell w-[15%] text-white text-center px-6 py-3">Ngày bình luận</th>
        <th class="hidden smr:table-cell w-[15%] text-white text-center px-6 py-3"></th>
        <th class="block smr:hidden m-auto text-center text-white px-6 py-6">More</th>
      </tr>
  </thead>
  <tbody id="myTable"></tbody>
</table>
<div class="pagination w-full flex items-center justify-center my-[2%] mx-auto">
<div class="prevPage w-[50px] lg:w-[70px] h-[50px] flex items-center justify-center text-white hover:text-blue-500 border-[1px] border-white hover:border-blue-500 border-solid rounded-[5px] transition-all" onclick="prevPage()" style="cursor:pointer">PREV</div>
        <div class="buttonPage w-2/5 min-w-[250px] h-full flex justify-evenly overflow-hidden" id="buttonPage">
        </div>
        <div class="nextPage w-[50px] lg:w-[70px] h-[50px] flex items-center justify-center text-white hover:text-blue-500 border-[1px] border-white hover:border-blue-500 border-solid rounded-[5px] transition-all" onclick="nextPage()"style="cursor:pointer">NEXT</div>
</div> 
<script>
    let data = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
    fetch('/api/comment')
    .then(res => {return res.json()})
    .then(restData => {
        data = restData
        totalPage = restData.length % itemsInPage === 0 ? restData.length / itemsInPage : (restData.length / itemsInPage) + 1;
        viewProducts(restData,start,end);
        paginationPage();
    })
    const nextPage = () => {
        if(activePage < totalPage){
            activePage = activePage + 1;
            setPagination(activePage)
        }
    }
    const prevPage = () => {
        if(activePage > 1){
            activePage = activePage - 1;
            setPagination(activePage)
        }
    }
    const paginationPage = () => {
        let pagination = [];
        
        for(let i = 1; i <= totalPage; i++){
            pagination.push(i);
        }
        let viewPagination = pagination.map(e => `<button class='w-[50px] h-[50px] text-white text-[15px] mx-[1%] ${e === activePage ? 'text-[20px] bg-blue-600 font-bold' : ''}hover:bg-blue-600 hover:font-bold rounded-[5px] transition-all' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        document.getElementById('buttonPage').innerHTML = viewPagination.join('')
    }
    const setPagination = (e) => {
        start = (12 * e) - 12;
        end = 12*e;
        document.getElementById(`showButton-${activePage}`).classList.remove('active');
        activePage = e;
        document.getElementById(`showButton-${e}`).classList.add('active');
        viewProducts(data,start,end);
    }
    const viewProducts = (e,start,end) => {
        let viewProduct = e.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th class="hidden lg:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idComment}</th>
                <th class="hidden smr:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idProduct}</th>
                <th class="text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.idUser}</th>
                <th class="text-white text-[15px] font-semibold border-solid -border-white border-[.2px] overflow-hidden whitespace-nowrap text-ellipsis px-6 py-3">${e.commentValue}</th>
                <th class="hidden lg:table-cell text-white text-[15px] font-semibold border-solid -border-white border-[.2px] px-6 py-3">${e.dateComment}</th>
                <th class="hidden smr:table-cell px-6 py-3"><button class="w-full min-w-[100px] h-[30px] rounded-[5px] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white">Delete</button></th>
                <th class="block smr:hidden m-auto flex justify-center items-center  px-6 py-4">
                    <svg class="w-5 h-5 text-white hover:text-blue-500 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </th>
            </tr>
        `).join('');
        document.getElementById("myTable").innerHTML = viewProduct;
        paginationPage();
    }
</script>