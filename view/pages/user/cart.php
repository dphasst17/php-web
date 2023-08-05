

<div id="viewCart" class="w-4/5 min-h-[60vh] h-auto mx-auto"></div>
<div class="btn w-full h-[50px] flex">
    <div id="clearAll" class="w-2/4 min-h-[50px] h-auto mx-auto flex items-center justify-evenly"></div>
    <div id="purchase" class="w-2/4 min-h-[50px] h-auto mx-auto flex items-center justify-evenly"></div> 
</div>
<script>
    let product = []
    let postData = {fname:'view'}
    const getCart = async() => {
        let token = await checkExpCookie(checkRf,url);
        fetch('./api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': "Bearer " + token
                },
                body: JSON.stringify(postData)
                })
        .then(res => 
            {
                if (!res.ok) {
                    throw new Error(`An error occurred: ${res.status}`);
                }
                return res.json();
            }
        )
        .then(data => {
            product = data
            viewCarts(data)
            return product;
        });
    }
    getCart();

    let viewCartEmpty = `<h1 class="text-[40px] font-bold text-center mt-[2%]">YOUR CART IS EMPTY</h1>`;
    let button = `<button class="w-[150px] h-[30px] rounded-[5px] text-white text-[20px] font-semibold bg-[#567090] border-none outline-none" onclick="window.location.href= './purchase'">PURCHASE</button>`;
    let btnClearAll = `<button class="w-[150px] h-[30px] rounded-[5px] text-white text-[20px] font-semibold bg-[#567090] border-none outline-none" onclick="deleteAllItems()">Clear All Items</button>`;
    const viewCarts = (e) => {
        let viewCart = e.map(e => `<div id='items-${e.idCart}' class="items w-full min-h-[100px] h-auto flex flex-col sm:flex-row justify-center items-center p-[5px] border-b-solid border-b-[1px] border-b-black">
            <div class="itemsImg w-full sm:w-2/5 md:w-1/4 h-2/5 sm:h-full flex items-center justify-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent w-full sm:w-3/5 md:w-3/4 h-2/5 sm:h-full flex flex-col">
                <div class="itemsTitle w-full min-h-[30px] text-[20px] text-[#2f2a87] font-semibold flex items-center overflow-hidden whitespace-nowrap text-ellipsis ">${e.nameProduct}</div>
                <div class="itemsPrice w-full min-h-[30px] text-[20px] text-[#2f2a87] font-semibold flex items-center overflow-hidden whitespace-nowrap text-ellipsis ">Price: ${e.price} USD</div>
                <div class="itemsPrice w-full min-h-[30px] text-[20px] text-[#2f2a87] font-semibold flex items-center overflow-hidden whitespace-nowrap text-ellipsis ">Total: <span id='itemsPrice${e.idCart}'>${e.price*e.countProduct}</span> USD</div>
            </div>
            <div class="button w-3/5 sm:w-2/5 md:w-1/5 h-full flex justify-around items-center">
                <button class="decre w-[50px] h-[30px]flex items-center justify-center text-[20px] font-bold cursor-pointer" onclick="decrement(${e.idCart},${e.price})">-</button>
                <div id='viewCount${e.idCart}' class="viewCount w-auto min-w-[30px] h-[30px] flex justify-center items-center text-[20px] font-semibold">${e.countProduct}</div>
                <button class="incre w-[50px] h-[30px]flex items-center justify-center text-[20px] font-bold cursor-pointer" onclick="increment(${e.idCart},${e.price})">+</button>
            </div>
            <div class="delete w-[100px] h-[30px] rounded-[5px] flex items-center justify-center bg-[#ebe8e8] text-[20px] font-semibold cursor-pointer" 
                onclick="deleteItems(${e.idCart})">
            DELETE
            </div>
            
        </div>`);
        
        if(e.length !== 0){
            document.getElementById('viewCart').innerHTML = viewCart.join('');
            document.getElementById('purchase').innerHTML = button
            document.getElementById('clearAll').innerHTML = btnClearAll
        }else{
            document.getElementById('viewCart').innerHTML = viewCartEmpty;
        }
    }

    /* increment count item */
    const increment = (e,p) => {
        var total;
        var viewCount = parseInt(document.getElementById(`viewCount${e}`).innerHTML);
        viewCount = isNaN(viewCount) ? 0 : viewCount;
        viewCount++;
        total = viewCount * p;
        document.getElementById(`viewCount${e}`).innerHTML = viewCount;
        document.getElementById(`itemsPrice${e}`).innerHTML = total;
        updateCart(viewCount,`${e}`)
    }

    /* decrement count item */
    const decrement = (e,p) => {
        var total;
        var viewCount = parseInt(document.getElementById(`viewCount${e}`).innerHTML);
        viewCount = isNaN(viewCount) ? 0 : viewCount;
        if (viewCount > 1) {
            viewCount--;
            total = viewCount * p;
            document.getElementById(`viewCount${e}`).innerHTML = viewCount;
            document.getElementById(`itemsPrice${e}`).innerHTML = total;
        }
        updateCart(viewCount,`${e}`)
    }

    /* delete item */
    const deleteItems = (id) =>{
        let element = document.getElementById(`items-${id}`);
        element.parentNode.removeChild(element);
        let lengthCart = document.getElementById('viewCart').childElementCount
        if(lengthCart === 0 ){
            document.getElementById('viewCart').innerHTML = viewCartEmpty;
            document.getElementById('purchase').style.display = "none";
            document.getElementById('clearAll').style.display = "none";
        }
        deleteCart(id)
    }

    const deleteAllItems = () => {
        document.getElementById('viewCart').innerHTML = viewCartEmpty;
        document.getElementById('purchase').innerHTML = "";
        document.getElementById('clearAll').innerHTML = "";
        deleteAll();
    }




    const updateCart = (count,id) => {
        let postData = {fname:'update' , count:count, idCart: id}
        fetch('./api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
                })
                .then(response => response.text())
                .then(data => console.log(data));
    }
    
    const deleteCart = (id) => {
        let postData = {fname:'delete' , idCart: id}
        fetch('/api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
                })
                .then(response => response.text())
    }
    const deleteAll = async() => {
        let token = await checkExpCookie(checkRf,url);
        let postData = {fname:'deleteAll' }
        fetch('./api/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + token
            },
            body: JSON.stringify(postData)
        })
        .then(response => response.text())
    }

</script>