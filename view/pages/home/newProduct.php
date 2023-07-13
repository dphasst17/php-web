
<h1 class="text-[35px] font-bold">NEW PRODUCT</h1>
<div id="productNew"></div>
<script>
    fetch('./api/products/new')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(product => {
        newProducts(product)
    })
    .catch(error => {
        console.log(error);
    });
    let us = JSON.parse(localStorage.getItem("uS") || "[]");
    const newProducts = (e) => {
        let viewProductNew = e.map(e => `<div class="items" key=${e.idProduct}>
        <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
        <div class="itemsTitle"><span>${e.nameProduct}</span></div>
        <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
        <div class="button">
            <button onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
            <button onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
        </div>
    </div>`);
    document.getElementById('productNew').innerHTML = viewProductNew.join('');
    }

    
</script>




