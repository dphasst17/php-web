<h1 class="text-[35px] font-bold">MOST VIEW</h1>
<div id="productList"></div>
<script>
    fetch('./api/products/view')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(product => {
        view(product)
    })
    .catch(error => {
        console.log(error);
    });
    const view = (e) => {
        let viewProduct = e.map(e => `<div class="items" key=${e.idProduct}>
            <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle"><span>${e.nameProduct}</span></div>
            <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
            <div class="button">
            <button onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
                <button onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('productList').innerHTML = viewProduct.join('');
    }

</script>




