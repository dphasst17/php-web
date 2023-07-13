<?php 
    $css = file_get_contents('view/pages/product/product.css');
    echo "<style>" . $css . "</style>";

?>
<div class="product">
    <div class="filter" id="getFilter">
        
    </div>
    <div class="viewProduct" style="width:80%;">
        <div id="getAll" class="h-auto"></div>
        <div class="pagination">
            <div class="prevPage" onclick="prevPage()">PREV</div>
            <div class="buttonPage" id="buttonPage">
            
            </div>
            <div class="nextPage" onclick="nextPage()">NEXT</div>
        </div>
    </div> 
</div>



<script>
    let data = []
    let us = JSON.parse(localStorage.getItem("uS") || "[]");
    let valueFilter = [];
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = 0;
    
    //Get data Product------------------------------------------------------
    fetch('./api/products')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(pro => {
        data = pro;
        viewProducts(data,start,end);
        totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
        paginationPage();
    })
    .catch(error => {
        console.log(error);
    });

    //Get data filter---------------------------------------------------------
    fetch('./api/products/type')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(filters => {
        viewFilter(filters)
    })
    .catch(error => {
        console.log(error);
    });

    /* Function view Filter and Product */
    const viewProducts = (p,start,end) => {
        let viewProduct = p.slice(start,end).map(e => `<div class="items" key=${e.idProduct}>
            <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle"><span class='overflow-hidden whitespace-nowrap text-ellipsis'>${e.nameProduct}</span></div>
            <div class='w-full min-h-[10%] h-auto'>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail1}</p>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail2}</p>
                <p class='text-blue-950 font-bold text-[17px] overflow-hidden whitespace-nowrap text-ellipsis'>${e.detail3}</p>
            </div>
            <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
            <div class="button">
                <button onclick="addProduct(${e.idProduct},'${us}')" >Add to cart</button>
                <button onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('getAll').innerHTML = viewProduct.join('');
        paginationPage();
    }

    const viewFilter = (f) => {
        let viewFIlter = f.map(e => `<div class="inputFilter">
            <input type="checkbox" value=${e.idType} id='filter${e.idType}' name='filter' onclick="addFilter(${e.idType})"/>
            <label for='filter${e.idType}'>${e.nameType.toUpperCase()}</label>
        </div>`);
        document.getElementById('getFilter').innerHTML = viewFIlter.join('');
    }

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
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'active' : ""}' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
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
    const addFilter = (e) => {
        let filterData = [];
        if(valueFilter.length === 0){
            start = 0;
            end = 12;
            activePage = 1;
            valueFilter.push(e);
            filterData = data.filter(e => valueFilter.toString().includes(e.idType))
             
        }else{
            if (!valueFilter.includes(e)) {
                valueFilter.push(e);
                filterData = data.filter(e => valueFilter.toString().includes(e.idType)) 
            } else {
                start = 0;
                end = 12;
                activePage = 1;
                valueFilter = valueFilter.filter(i => i !== e);
                filterData = data.filter(e => valueFilter.toString().includes(e.idType))
            }
            
        }
        
        if(valueFilter.length !== 0){
            totalPage = filterData.length % itemsInPage === 0 ? filterData.length / itemsInPage : (filterData.length / itemsInPage) + 1;
            viewProducts(filterData,start,end)
        }else{
            start = 0;
            end = 12;
            activePage = 1;
            filterData = data
            totalPage = filterData.length % itemsInPage === 0 ? filterData.length / itemsInPage : (filterData.length / itemsInPage) + 1;
            viewProducts(filterData,start,end)
        }
        
    }
</script>