<?php 
    include 'model/product.php';
    $value = $_GET['value'];
    $detail = product_select_keyword($value);
?>
<div class="product w-screen xl:w-full h-auto min-h-[600px] flex my-[2%] px-[2%]" style="justify-content:center">
    <div class="filter w-1/5 h-[15%] hidden xl:flex flex-wrap justify-start items-start rounded-[10px] bg-[#f0efef]" id="getFilter"></div>
    <div class="viewProduct w-full xl:w-4/5 h-auto min-h-[200px] flex flex-col items-center my-[2%]" >
        <div id="getAll" class="w-full lg:w-[95%] h-auto min-h-[700px] flex flex-wrap justify-center  justify-around lg:justify-start items-start mb-[2%]"></div>
        <div class="pagination w-4/5 h-[50px] flex justify-center items-center" >
            <div class="prevPage w-[10%] h-2/4 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="prevPage()">PREV</div>
            <div class="buttonPage w-auto min-w-[60px] h-full flex justify-around items-center mx-[2%]" id="buttonPage">
            
            </div>
            <div class="nextPage w-[10%] h-2/4 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="nextPage()">NEXT</div>
        </div>
    </div>   
</div>
</div>

<script>
    let us = JSON.parse(localStorage.getItem("uS") || "[]");
    let product = <?php echo json_encode($detail); ?>;
    let data = product;
    let arrayFilter = Array.from(new Set(product.map((e) => e.nameType)));
    let arrayFilterBrand = Array.from(new Set(product.map((e) => e.brand)));
    let valueFilter = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = product.length % itemsInPage === 0 ? product.length / itemsInPage : (product.length / itemsInPage) + 1;
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

    /* function page number */
    const paginationPage = () => {
        let pagination = [];
        
        for(let i = 1; i <= totalPage; i++){
            pagination.push(i);
        }
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'activeBtn' : ""} w-[45px] min-w-[30px] h-[25px] text-[18px] font-medium rounded-[8px] border-none cursor-pointer' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        document.getElementById('buttonPage').innerHTML = viewPagination.join(''); 
    }
    /* function onclick pagination in button*/
    const setPagination = (e) => {
        start = (12 * e) - 12;
        end = 12*e;
        document.getElementById(`showButton-${activePage}`).classList.remove('active');
        activePage = e;
        document.getElementById(`showButton-${e}`).classList.add('active');
        viewProducts(data,start,end);
        
    }

    let viewFilter = arrayFilter.map((e,i) => `<div class="inputFilter w-[45%] h-[50px] flex flex-wrap items-center pl-[2%] cursor-pointer">
        <input class="accent-[#0a65c0] rounded-[50%] cursor-pointer checked:border-indigo-50 transition-all" type="checkbox" value=${i+1} id='filter${i+1}' name='filter' onclick="filterType(${i+1})"/>
        <label class="text-[#2f4466] text-[18px] font-semibold cursor-pointer" for='filter${i+1}'>${e.toUpperCase()}</label>
    </div>`);
    
    if(arrayFilter.length > 3){
        document.getElementById('getFilter').innerHTML = viewFilter.join('');
    }else{
        document.getElementById('getFilter').style.display="none";
    }

    /* function view product */
    const viewProducts = (p,start,end) => {
        let viewProduct = p.slice(start,end).map(e => `<div class="items w-[160px] lg:w-1/4 md:w-[230px] min-w-[160px] h-[400px] lg:h-[500px] mb-[2%] cursor-pointer" key=${e.idProduct}>
            <div class="itemsImg w-full h-2/5 flex justify-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle w-full h-[65px] flex justify-center items-center text-[20px] text-[#9d2b2b] font-semibold overflow-hidden whitespace-nowrap text-ellipsis">
                <span class='overflow-hidden whitespace-nowrap text-ellipsis'>${e.nameProduct}</span>
            </div>
            <div class='w-full min-h-[10%] h-auto overflow-hidden whitespace-nowrap text-ellipsis'>
                <p class='w-4/5 text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail1}</p>
                <p class='w-4/5 text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail2}</p>
                <p class='w-4/5 text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail3}</p>
            </div>
            <div class="itemsPrice w-full h-[50px] flex justify-start items-center text-[20px] text-black font-semibold py-[5px]">Price: <span class="text-[20px] text-[#9d2b2b] font-semibold my-[2px]">${e.price} USD</span> </div>
            <div class="button w-full h-[70px] xl:h-[70px] lg:h-[100px] flex flex-col xl:flex-row justify-evenly lg:items-center xl:justify-start ">
                <button class="w-full lg:w-3/5 xl:w-2/4 lg:h-2/5 xl:h-[70%] flex items-center justify-center rounded-[5px] outline-none cursor-pointer border-none text-[20px] text-white font-semibold bg-[#586582] hover:bg-blue-700 transition-all" onclick="addProduct(${e.idProduct},'${us}')" >Add to cart</button>
                <button class="w-full lg:w-3/5 xl:w-1/4 lg:h-1/5 xl:h-[70%] flex items-center justify-center rounded-[5px] outline-none cursor-pointer border-none font-medium lg:ml-[2%] hover:bg-blue-700 hover:text-white transition-all" onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
    document.getElementById('getAll').innerHTML = viewProduct.join('');
    paginationPage();
    }
    viewProducts(data,start,end);

    const filterType = (e) => {
        let oldData = product;
        
        if(valueFilter.length === 0){
            start = 0;
            end = 12;
            activePage = 1;
            valueFilter.push(e)
            data = product.filter(e => valueFilter.toString().includes(e.idType))
            
        }else{
            if (!valueFilter.includes(e)) {
                valueFilter.push(e);
                 data = product.filter(e => valueFilter.toString().includes(e.idType))
                 
                
            } else {
                start = 0;
                end = 12;
                activePage = 1;
                valueFilter = valueFilter.filter(i => i !== e);
                 data = product.filter(e => valueFilter.toString().includes(e.idType))    
                 
            }
            
        }
        
        if(valueFilter.length !== 0){
            totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
            viewProducts(data,start,end)
        }else{
            start = 0;
            end = 12;
            activePage = 1;
            data = oldData;
            totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
            viewProducts(data,start,end)
        }
        
    }

    const addProduct = (p,u) => {
        const isLogin = JSON.parse(localStorage.getItem("isLogin") || "[]");
        if(isLogin === true ){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                // Handle response here
                }
            };
            xhttp.open("POST", "handle/cart.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("function=addCart&idP=" + p + "&idU=" + u);
        }else{window.location.href="login.php"}
        

    }
</script>