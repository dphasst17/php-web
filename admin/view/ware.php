<div style="display:none" id="addNewItems" class="addNew w-screen h-screen m-auto fixed z-50 top-0 left-0  justify-center items-center">
    <div onclick="handleShowHideItems('none')" class="overlay w-full h-full fixed backdrop-brightness-50 z-0"></div>
    <div class="content w-4/5 h-3/5 bg-slate-50 rounded-[5px] z-50 py-1 px-2 flex flex-col justify-around">
        <select id="idProduct" class="w-4/5 lg:w-full h-[50px] rounded-[5px] border border-solid border-[1px] border-black outline-none pl-2">
            
        </select>
        <!-- <input id="idProduct" class="w-4/5 lg:w-full h-[50px] rounded-[5px] border border-solid border-[1px] border-black outline-none pl-2" type="text" placeholder="Nhập mã sản phẩm"/> -->
        <input id="count" class="w-4/5 lg:w-full h-[50px] rounded-[5px] border border-solid border-[1px] border-black outline-none pl-2" type="number" placeholder="Nhập số lượng"/>
        <div class="subItems w-full h-auto flex flex-col sm:flex-row justify-between">
            <select class="w-2/5 h-[50px] rounded-[5px] border border-solid border-[1px] border-black outline-none pl-2" id="select">
                <option value="import">Nhập sản phẩm</option>
                <option value="export">Xuất sản phẩm</option>
            </select>
            <input id="date" class="w-2/5 h-[50px] rounded-[5px] border border-solid border-[1px] border-black outline-none pl-2" type="date" />
        </div>
        <button onclick="handleSubmit()" type="button" class=" w-[150px] h-[30px] rounded-[5px] bg-slate-500 text-white text-center text-[20px] font-semibold mx-auto">Submit</button>
    </div>
</div>
<button onclick="handleShowHideItems('flex')" class="w-[200px] h-[40px] text-[20px] text-center font-semibold rounded-[5px] bg-[#007bff] hover:bg-blue-800 text-white">Nhập/Xuất sản phẩm</button>
<div class="total">
    <h1 class="text-white text-center text-[30px] font-bold mb-[3%]">Số lượng sản phẩm</h1>
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th  class="hidden smr:table-cell w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="hidden sm:table-cell w-[15%] px-6 py-3">Hình ảnh</th>
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
        <th  class="hidden sm:table-cell w-[10%] px-6 py-3">Mã hàng hóa</th>
        <th  class="w-[15%] px-6 py-3">Tên hàng hóa</th>
        <th  class="hidden smr:table-cell w-[15%] px-6 py-3">Người nhập/xuất</th>
        <th  class="hidden smr:table-cell w-[15%] px-6 py-3">Ngày nhập/xuất</th>
        <th  class="w-[5%] px-6 py-3">Số lượng</th>
        <th  class="w-[15%] px-6 py-3">Trạng thái</th>
    </tr>
  </thead>
  <tbody id="wareContent">
    
  </tbody>
</table>
<div class="pagination w-full flex items-center justify-center my-[2%] mx-auto">  
    <div class="buttonPage w-2/5 min-w-[250px] h-full flex justify-evenly overflow-hidden" id="buttonPage2">
    </div>
</div>

<script>
    let data = []
    let dataAll =[]
    let start = 0;
    let end = 12;
    let start2 = 0;
    let end2 = 12;
    let itemsInPage = 12;
    let activePage = 1
    let activePage2 = 1
    let totalPage = 0;
    let totalPage2 =0;
    fetch('/api/ware/total')
    .then(res => {return res.json()})
    .then(getTotal => {
        data = getTotal
        totalPage = getTotal.length % itemsInPage === 0 ? getTotal.length / itemsInPage : (getTotal.length / itemsInPage) + 1;
        getTotalProduct(getTotal,start,end)
        paginationPage("buttonPage","btnPageTotal","getTotalProduct",'data',totalPage,start,end);
    })
    fetch('/api/ware')
    .then(res => {return res.json()})
    .then(all => {
        dataAll = all
        totalPage2 = all.length % itemsInPage === 0 ? all.length / itemsInPage : (all.length / itemsInPage) + 1;
        getAll(all,start2,end2)
        paginationPage("buttonPage2","btnPageAll","getAll",'dataAll',totalPage2,start2,end2);
    })
    fetch('/api/products')
    .then(res => {return res.json()})
    .then(result => {
        getAlProduct(result)
    })
    const getTotalProduct = (data,start,end) => {
        let viewProduct = data.slice(start,end).map(e => `
            <tr class="bg-slate-800 ">
                <th  class="hidden smr:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th  class="hidden sm:table-cell w-[10%] border-solid border-white border-[1px] px-6 py-4"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.imgProduct}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.price}</th>
                <th  class="w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.totalProduct}</th>
            </tr>
        `).join('');
        document.getElementById("totalContent").innerHTML =  viewProduct;
    paginationPage("buttonPage","btnPageTotal","getTotalProduct",'data',totalPage,start,end);
    }
    const getAll = (data,start2,end2) => {
        let viewAll = data.slice(start2,end2).map(e => `
            <tr class="bg-slate-800 ">
                <th  class="hidden sm:table-cell w-[5%] border-solid border-white border-[1px] px-6 py-4">${e.idProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.nameProduct}</th>
                <th  class="hidden smr:table-cell w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.idpersonIOX}</th>
                <th  class="hidden smr:table-cell w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.dateIOX}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.countProduct}</th>
                <th  class="w-[15%] border-solid border-white border-[1px] px-6 py-4">${e.statusWare}</th>
            </tr>
        `).join('');
        document.getElementById("wareContent").innerHTML =  viewAll;
    paginationPage("buttonPage2","btnPageAll","getAll",'dataAll',totalPage2,start2,end2);
    }
    const getAlProduct = (data) => {
        let result = data.map(e => `<option value='${e.idProduct}'>${e.nameProduct}</option>`);
        document.getElementById('idProduct').innerHTML = result.join('');
    }
    const handleShowHideItems = (display) => {
        document.getElementById('addNewItems').style.display = display
    }
    const handleSubmit = () => {
        let idProduct = document.getElementById('idProduct').value;
        idProduct = Number(idProduct)
        let count = document.getElementById('count').value;
        count = Number(count)
        let date = document.getElementById('date').value;
        let valueSelect = document.getElementById('select').value;
        let idPerson = JSON.parse(sessionStorage.getItem("idLog"));
        let isValid = true;
        if(idProduct === 0 ){
            document.getElementById('idProduct').style.borderColor = "red"
            isValid = false;
        }
        if(count === 0 ){
            document.getElementById('count').style.borderColor = "red"
            isValid = false;
        }
        if(date === '' ){
            document.getElementById('date').style.borderColor = "red"
            isValid = false;
        }
        if(isValid === true){
            let postData = {idProduct:idProduct,idUser:idPerson,date:date,count:count,status:valueSelect}
            fetch('/api/ware/insert',{
                method:'POST',
                body:JSON.stringify(postData)
            })
            .then(res => {if(res.status === 200){
                window.location.href= '/admin/ware'
            }})
        }
    }
</script>
<script src="/public/js/adminHandle.js"></script>