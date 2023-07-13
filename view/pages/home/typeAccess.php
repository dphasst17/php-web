<h1 class="text-[35px] font-bold">ABOUT ACCESSORY</h1>
<div id="productType2"></div>
<script>
    fetch('./api/products/access')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(product => {
        access(product)
    })
    .catch(error => {
        console.log(error);
    });
    const access = (e)=>{
        let viewProductType2 = e.slice(0,8).map(e => `<div class="items" >
            <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle"><span>${e.nameProduct}</span></div>
            <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
            <div class="button">
            <button onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
            <button onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('productType2').innerHTML = viewProductType2.join('');
    }
</script>




