const layout = (data,id,detail) => {
    let cardProduct = data.map(e => productElement(e));
    document.getElementById(`${id}`).innerHTML  = cardProduct.join('');

}
const productElement = (e) => {
    return `<div class="product-item bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden" key=${e.idProduct}>
    <div class="relative">
      <button class="absolute top-2 right-2 z-10 bg-white p-1.5 rounded-full shadow-md hover:bg-red-500 hover:text-white transition-colors">
        <i class='bx bx-heart text-lg'></i>
      </button>
    
      <div onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'" class="product-image overflow-hidden">
        <img src="${e.imgProduct}" alt="Image Product" class="w-full h-48 object-contain" />
      </div>
      
      <div class="absolute bottom-0 left-0 right-0 p-4">
        <div class="product-actions flex justify-center space-x-2">
          <button onclick="addCart(${e.idProduct},'${us}')"  class="bg-white text-gray-800 p-2 rounded-full hover:bg-blue-600 hover:text-white transition shadow-md">
            <i class='bx bx-cart-add text-lg'></i>
          </button>
          <button onclick="location.href='detail/${e.idType}/${e.idProduct}/${e.nameProduct}'" class="bg-white text-gray-800 p-2 rounded-full hover:bg-blue-600 hover:text-white transition shadow-md">
            <i class='bx bx-search text-lg'></i>
          </button>
          <button class="bg-white text-gray-800 p-2 rounded-full hover:bg-blue-600 hover:text-white transition shadow-md">
            <i class='bx bx-shuffle text-lg'></i>
          </button>
        </div>
      </div>
    </div>
    
    <div class="p-4">
      <div class="grid grid-cols-6 gap-2 mb-2">
        <span class="col-span-2 text-xs text-center truncate font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">${e.nameType.toUpperCase()}</span>
        <span class="col-span-2 text-xs text-center truncate font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded">${e.brand.toUpperCase()}</span>
      </div>
      
      <h3 class="font-semibold text-gray-800 hover:text-blue-600 transition mb-1">${e.nameProduct}</h3>
          
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <span class="text-gray-400 text-sm mr-2">$${e.price}</span>
        </div>
        <button onclick="addCart(${e.idProduct},'${us}')"  class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
          Add to Cart
        </button>
      </div>
    </div>
  </div>`
}