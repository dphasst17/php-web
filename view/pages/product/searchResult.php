<?php 
    include 'model/product.php';
    $css = file_get_contents('view/pages/product/product.css');
    echo "<style>" . $css . "</style>";
    $value = $_GET['value'];
    $detail = product_select_keyword($value);
?>
<div class="product" style="justify-content:center">
    <div class="filter" id="getFilter"></div>
    <div class="viewProduct" style="width:80%;">
        <div id="getAll"></div>
        <div class="pagination">
            <div class="prevPage" id="prev" onclick="prevPage()">PREV</div>
            <div class="buttonPage" id="buttonPage">
            
            </div>
            <div class="nextPage" id="next" onclick="nextPage()">NEXT</div>
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
    console.log(arrayFilterBrand)
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
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'active' : ""}' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        if(pagination.length > 1){
            document.getElementById('prev').style.display = "block";
            document.getElementById('next').style.display = "block";
            document.getElementById('buttonPage').innerHTML = viewPagination.join('');
        }else{
            document.getElementById('prev').style.display = "none";
            document.getElementById('next').style.display = "none";
            document.getElementById('buttonPage').innerHTML = "";
        }
        
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


    let viewFilter = arrayFilter.map((e,i) => `<div class="inputFilter">
        <input type="checkbox" value=${i+1} id='filter${i+1}' name='filter' onclick="filterType(${i+1})"/>
        <label for='filter${i+1}'>${e.toUpperCase()}</label>
    </div>`);
    
    if(arrayFilter.length > 3){
        document.getElementById('getFilter').innerHTML = viewFilter.join('');
    }else{
        document.getElementById('getFilter').style.display="none";
    }

    /* function view product */
    const viewProducts = (p,start,end) => {
        let viewProduct = p.slice(start,end).map(e => `<div class="items" key=${e.idProduct}>
        <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
        <div class="itemsTitle"><span>${e.nameProduct}</span></div>
        <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
        <div class="button">
            <button onclick="addProduct(${e.idProduct},'${us}')" >Add to cart</button>
            <button onclick="location.href='index.php?page=detail&id=${e.idProduct}&idU=${us}'">Detail</button>
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