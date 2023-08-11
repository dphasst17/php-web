const layout = (data,id,detail) => {
    let cardProduct = data.map(e => `<div class="items w-[22%] min-w-[150px] smr:min-w-[180px] md:min-w-[200px] h-2/4 flex flex-col flex-wrap items-center p-[1%] cursor-pointer hover:rounded-[5px] hover:bg-slate-300 transition-all" key=${e.idProduct}>
    <div class="firstItems w-full h-[90%] flex flex-col" onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">
        <div class="imgProduct w-full h-[150px] flex justify-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="imgProduct"/></div>
        <div class="nameProduct w-full h-[50px] text-[18px] text-center text-[#9d2b2b] font-semibold overflow-hidden whitespace-nowrap text-ellipsis"><span>${e.nameProduct}</span></div>
        <div class="tagProduct w-full h-[15%] flex flex-row justify-start mb-3">
            <div class="brand w-auto h-full rounded-[5px] bg-blue-500 px-2 mx-2 text-white text-[15px] font-semibold">${e.brand.toUpperCase()}</div>
            <div class="type w-auto h-full rounded-[5px] bg-blue-500 px-2 mx-2 text-white text-[15px] font-semibold">${e.nameType.toUpperCase()}</div>
        </div>
        ${(detail === true)? `<div class="detailProduct">
            <p>${e.detail1}</p>
            <p>${e.detail2}</p>
            <p>${e.detail3}</p>
            <p>${e.detail4}</p>
        </div>`: ""
        }
        <div class="priceProduct w-full h-[30px] text-[18px]">Price: <span class="text-[#9d2b2b] text-[19px] font-semibold">${e.price} USD</span></div>
    </div>
    <div class="secondItems w-full h-[10%]">
        <div class="button w-full h-[40px] flex flex-col sm:flex-row items-center">
            <button class="w-full sm:w-3/4 h-[70%] text-white hover:text-white text-[20px] flex items-center justify-center font-semibold mr-[2%] bg-blue-900 hover:bg-primary transition-all border-none rounded-[5px] outline-none cursor-pointer " onclick="addCart(${e.idProduct},'${us}')" >Add to cart</button>
            <button class="w-full sm:w-1/5 h-[70%] text-black hover:text-white text-[15px] font-semibold mr-[2%] bg-transparent hover:bg-primary transition-all border-none rounded-[5px] outline-none cursor-pointer " onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
        </div>
    </div>
</div>`)
    document.getElementById(`${id}`).innerHTML  = cardProduct.join('');

}