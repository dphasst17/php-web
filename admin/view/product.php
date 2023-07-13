<div class="btn btn-primary  float-left"  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="window.location.href='index.php?act=new'">Thêm sản phẩm</div>

<div class="new">
    <h1 class="text-light text-center mb-4">Sản phẩm mới</h1>
<table id="newProduct" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col">Mã loại</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col" class="col-1">Tên hàng hóa</th>
        <th scope="col" class="col-1">Đơn giá</th>
        <th scope="col" class="col-1">Ngày nhập</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Số lượt xem</th>
      </tr>
  </thead>
</table>
</div>
<h1 class="text-light text-center mt-5 mb-3">Danh sách sản phẩm</h1>
<table id="myTable" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="w-40">Mã hàng hóa</th>
        <th scope="col">Mã loại</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col" class="col-1">Tên hàng hóa</th>
        <th scope="col" class="col-1">Đơn giá</th>
        <th scope="col" class="col-1">Ngày nhập</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Số lượt xem</th>
      </tr>
  </thead>
</table>
<div class="pagination m-auto">
        <div class="prevPage d-flex align-items-center btn btn-outline-secondary text-center text-light" onclick="prevPage()" style="cursor:pointer">PREV</div>
        <div class="buttonPage" id="buttonPage">
        </div>
        <div class="nextPage d-flex align-items-center btn btn-outline-secondary text-center text-light" onclick="nextPage()"style="cursor:pointer">NEXT</div>
    </div> 
<script>
    let data = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = 0;

    /* FETCH DATA */
    fetch('../api/products/new')
    .then(res => res.json())
    .then(data => getNewProduct(data))

    fetch('../api/products')
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
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'btn btn-lg btn-primary active m-2' : 'btn btn-lg btn-secondary m-2'}' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
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
        let viewProduct = e.slice(start,end).map(e => `<tbody>
            <tr>
                <th scope="col">${e.idProduct}</th>
                <th scope="col">${e.idType}</th>
                <th scope="col"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.imgProduct}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
                <th scope="col">${e.nameProduct}</th>
                <th scope="col">${e.price}</th>
                <th scope="col">${e.dateAdded}</th>
                <th scope="col">${e.des.slice(0,290)+'...'}</th>
                <th scope="col">${e.view}</th>
                <th scope="col"><button class="btn btn-primary" onclick="window.location.href = './edit&id=${e.idProduct}'">Edit</button></th>
                <th scope="col"><button class="btn btn-danger" onclick="deleteItems(${e.idProduct})">Delete</button></th>
            </tr>
        </tbody>`).join('');
        document.getElementById("myTable").innerHTML = viewProduct;
        paginationPage();
    }
    const getNewProduct = (e) => {
        let viewNew = e.map(e => `<tbody>
        <tr>
            <th scope="col">${e.idType}</th>
            <th scope="col"><img src=${e.imgProduct.includes('https://') ? `${e.imgProduct}` : `../images/product/${e.hinh}`} alt="imageProduct" style="width:100px;height:100px;object-fit:contain;"/></th>
            <th scope="col">${e.nameProduct}</th>
            <th scope="col">${e.price}</th>
            <th scope="col">${e.dateAdded}</th>
            <th scope="col">${e.des.slice(0,290)+'...'}</th>
            <th scope="col">${e.view}</th>
            <th scope="col"><button class="btn btn-primary" onclick="window.location.href = './edit&id=${e.idProduct}'">Edit</button></th>
            <th scope="col"><button class="btn btn-danger" onclick="deleteItems(${e.idProduct})">Delete</button></th>
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