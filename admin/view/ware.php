<div class="total">
    <h1 class="text-white text-center text-[30px] font-bold mb-[3%]">Số lượng sản phẩm</h1>
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th  class="w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Hình ảnh</th>
        <th  class="w-[15%] px-6 py-3">Tên hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Đơn giá</th>
        <th  class="w-[5%] px-6 py-3">Số lượng</th>
      </tr>
  </thead>
  <tbody id="totalContent">
    
  </tbody>
</table>
<div class="pagination w-full flex items-center justify-center my-[2%] mx-auto">  
        <div class="buttonPage w-2/5 min-w-[250px] h-full flex justify-evenly overflow-hidden" id="buttonPage">
        </div>
</div>
<div class="total">
    <h1 class="text-white text-center text-[30px] font-bold mb-[3%]">Kho</h1>
<table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th  class="w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Tên hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Người nhập/xuất</th>
        <th  class="w-[15%] px-6 py-3">Ngày nhập/xuất</th>
        <th  class="w-[5%] px-6 py-3">Số lượng</th>
        <th  class="w-[15%] px-6 py-3">Trạng thái</th>
    </tr>
  </thead>
  <tbody id="wareContent">
    
  </tbody>
</table>
<script>
    let data = []
    let all =[]
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = 0;
    let totalPage2 =0;
    fetch('/api/ware/total')
    .then(res => {return res.json()})
    .then(getTotal => {
        data = getTotal
        totalPage = getTotal.length % itemsInPage === 0 ? getTotal.length / itemsInPage : (getTotal.length / itemsInPage) + 1;
        getTotalProduct(getTotal,start,end)
        paginationPage("btnPageAll","getTotalProduct");
    })
    fetch('/api/ware')
    .then(res => {return res.json()})
    .then(all => {
        all = all
        totalPage2 = all.length % itemsInPage === 0 ? all.length / itemsInPage : (all.length / itemsInPage) + 1;
        getAll(all,start,end)
        paginationPage("btnPageAll","getTotalProduct",totalPage2);
    })
    const getTotalProduct = (data,start,end) => {
        let viewProduct = data.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th  class="hidden smr:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th  class="hidden sm:table-cell w-[10%] border-solid border-white border-[1px] px-6 py-4"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.imgProduct}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.price}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.totalProduct}</th>
            </tr>
        `).join('');
        document.getElementById("totalContent").innerHTML =  viewProduct;
    paginationPage("btnPageAll","getTotalProduct");
    }
    const getAll = (data,start,end) => {
        let viewAll = data.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th  class="hidden smr:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.idpersonIOX}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.dateIOX}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.countProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.statusWare}</th>
            </tr>
        `).join('');
        document.getElementById("wareContent").innerHTML =  viewAll;
    paginationPage("btnPageAll","getTotalProduct");
    }
    
</script>
<script src="/public/js/adminHandle.js"></script>