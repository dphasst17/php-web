<h1 class="text-[35px] font-bold">ABOUT ACCESSORY</h1>
<div class="w-full xl:w-4/5 min-h-[300px] h-auto my-[2%] flex items-center justify-center mx-auto">
    <div id="productType2" class="w-[90%] min-h-[300px] h-auto grid grid-cols-1 ssm:grid-cols-2 sm:grid-cols-4 gap-6 px-2"></div>
</div>
<script>
    fetch('/api/products/access')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(product => {
        layout(product,'productType2',false)
    })
    .catch(error => {
        console.log(error);
    });
    const access = (e)=>{
        let viewProductType2 = e.slice(0,8).map(e => `<div class="items w-[22%] min-w-[150px] smr:min-w-[180px] md:min-w-[200px] h-2/4 flex flex-col flex-wrap items-center p-[1%] cursor-pointer hover:rounded-[5px] hover:bg-slate-300 transition-all" key=${e.idProduct}>
            <div class="itemsImg w-full h-[150px] flex justify-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="imgProduct"/></div>
            <div class="itemsTitle w-full h-[50px] text-[18px] overflow-hidden whitespace-nowrap text-ellipsis"><span class="w-full text-center text-[#9d2b2b] text-[19px] font-semibold">${e.nameProduct}</span></div>
            <div class="itemsPrice w-full h-[30px] text-[18px]">Price: <span class="text-[#9d2b2b] text-[19px] font-semibold">${e.price} USD</span> </div>
            <div class="button w-full h-[40px] flex flex-col sm:flex-row items-center">
                <button class="w-full sm:w-3/4 h-[70%] text-white hover:text-white text-[20px] flex items-center justify-center font-semibold mr-[2%] bg-[#586582] hover:bg-blue-700 border-none rounded-[5px] outline-none cursor-pointer " onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
                <button class="w-full sm:w-1/5 h-[70%] text-black hover:text-white text-[15px] font-semibold mr-[2%] bg-transparent hover:bg-blue-700 border-none rounded-[5px] outline-none cursor-pointer " onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('productType2').innerHTML = viewProductType2.join('');
    }
</script>




