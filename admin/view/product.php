<div class="w-[200px] h-[40px] flex items-center justify-center  rounded-[5px] bg-blue-950 hover:bg-blue-700 mt-[2%] ml-[2%] rounded-[5px] text-white text-[20px] font-semibold bg-primary cursor-pointer transition-all"  
    onclick="window.location.href='./new'">Thêm sản phẩm</div>

<div class="new">
    <h1 class="text-white text-center text-[30px] font-bold mb-[3%]">Sản phẩm mới</h1>
<table id="newProduct" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
<thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th  class="hidden smr:table-cell w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="hidden smr:table-cell px-6 py-3">Mã loại</th>
        <th  class="hidden md:table-cell min-w-[156px] px-6 py-3">Hình ảnh</th>
        <th  class="w-[15%] px-6 py-3">Tên hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Đơn giá</th>
        <th  class="hidden lg:table-cell px-6 py-3">Ngày nhập</th>
        <th  class="hidden lg:table-cell w-[20%] px-6 py-3">Mô tả</th>
        <th  class="hidden lg:table-cell px-6 py-3">Số lượt xem</th>
        <th  class="block px-6 py-3">Action</th>
      </tr>
  </thead>
</table>
</div>
<h1 class="text-white text-center text-[30px] font-bold my-[3%]">Danh sách sản phẩm</h1>
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th  class="hidden smr:table-cell w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="hidden smr:table-cell px-6 py-3">Tên loại</th>
        <th  class="hidden md:table-cell min-w-[156px] px-6 py-3">Hình ảnh</th>
        <th  class="w-[15%] px-6 py-3">Tên hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Đơn giá</th>
        <th  class="hidden lg:table-cell px-6 py-3">Ngày nhập</th>
        <th  class="hidden lg:table-cell md:w-[10%] min-w-[300px] px-6 py-3">Mô tả</th>
        <th  class="hidden lg:table-cell px-6 py-3">Số lượt xem</th>
        <th  class="block px-6 py-3">Action</th>
      </tr>
  </thead>
  <tbody id="myTable">
    
  </tbody>
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
    let totalPage = 0;

    /* FETCH DATA */
    fetch('/api/products/new')
    .then(res => res.json())
    .then(data => {getNewProduct(data)})

    fetch('/api/products')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(restData => {
        data = restData;
        viewProducts(restData,start,end)
        totalPage = restData.length % itemsInPage === 0 ? restData.length / itemsInPage : (restData.length / itemsInPage) + 1;
        paginationPage("buttonPage","btnPage","viewProducts",'data',totalPage,start,end);
    })

    const viewProducts = (e,start,end) => {
        let viewProduct = e.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th class="hidden smr:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th class="hidden smr:table-cell w-[10%] border-solid border-white border-[1px] px-6 py-4">${e.nameType.toUpperCase()}</th>
                <th class="hidden md:table-cell w-[10%] border-solid border-white border-[1px] px-6 py-4"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.imgProduct}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
                <th class="w-2/5 md:w-1/5 lg:w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.price}</th>
                <th class="hidden lg:table-cell w-[10%] border-solid border-white border-[1px] px-6 py-4">${e.dateAdded}</th>
                <th class="hidden lg:table-cell border-solid border-white border-[1px] px-6 py-3">${(e.des !== null && e.des?.length !== 0) ? e.des?.slice(0,180)+"..." : ""}</th>
                <th class="hidden lg:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.view}</th>
                <th class="block w-[10%] px-6 py-4">
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white" 
                        onclick="window.location.href = './edit&id=${e.idProduct}'">Edit
                    </button>
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white" 
                        onclick="deleteItems(${e.idProduct})">Delete
                    </button>
                </th>
            </tr>
        `).join('');
        document.getElementById("myTable").innerHTML =  viewProduct;
        paginationPage("buttonPage","btnPage","viewProducts",'data',totalPage,start,end);
    }
    const getNewProduct = (e) => {
        let viewNew = e.map(e => `<tbody>
        <tr class="bg-slate-800">
                <th class="hidden smr:table-cell border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th class="hidden smr:table-cell border-solid border-white border-[1px] px-6 py-4">${e.idType}</th>
                <th class="hidden md:table-cell border-solid border-white border-[1px] px-6 py-4"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.imgProduct}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
                <th class="w-2/5 md:w-1/5 lg:w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.price}</th>
                <th class="hidden lg:table-cell border-solid border-white border-[1px] px-6 py-4">${e.dateAdded}</th>
                <th class="hidden lg:table-cell w-[20%] border-solid border-white border-[1px] px-6 py-4">${e.des !== null ? e.des : ""}</th>
                <th class="hidden lg:table-cell border-solid border-white border-[1px] px-6 py-4">${e.view}</th>
                <th class="block w-[10%] px-6 py-4">
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white" onclick="window.location.href = './edit&id=${e.idProduct}'">Edit</button>
                    <button class="w-full min-w-[100px] h-[30px] rounded-[5px] mt-[5%] bg-[#d9534f] hover:bg-red-600 text-white" onclick="deleteItems(${e.idProduct})">Delete</button>
                </th>
            </tr>
    </tbody>`).join('');
    document.getElementById("newProduct").insertAdjacentHTML('beforeend', viewNew);
    }
    
    
    const changeData = (e,id) => {
        var formData = new FormData();
            formData.append('function', e);
            formData.append('id', id);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if(response == 1){
                            console.log("Upload successfully.");
                    }else{
                            console.log("File not uploaded.");
                    }
                }
            };
            xhttp.open("POST", "../handle/add.php", true);
            xhttp.send(formData);
    }
    const deleteItems = (p) => {
        var formData = new FormData();
            formData.append('id', p);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if(response == 1){
                            console.log("Upload successfully.");
                    }else{
                            console.log("File not uploaded.");
                    }
                }
            };
            xhttp.open("POST", "../handle/deletep.php", true);
            xhttp.send(formData);
            setTimeout(() => {
            window.location.href="../admin/index.php?act=product";
        }, 0);
    }
</script>
<script src="/public/js/adminHandle.js"></script>