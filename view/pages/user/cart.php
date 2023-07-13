<?php
    $css = file_get_contents('view/pages/user/user.css');
    echo "<style>" . $css . "</style>";
?>

<div id="viewCart"></div>
<div class="btn">
    <div id="clearAll"></div>
    <div id="purchase"></div> 
</div>
<script>
    let idUser = JSON.parse(localStorage.getItem("uS") || [])
    let postData = {fname:'view' , idUser:JSON.parse(localStorage.getItem("uS") || []).toString()}
    fetch('./api/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
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
    .then(data => viewCarts(data));
    let viewCartEmpty = `<h1 class="text-[40px] font-bold">YOUR CART IS EMPTY</h1>`;
    let button = `<button onclick="window.location.href= './purchase&id=${idUser}'">PURCHASE</button>`;
    let btnClearAll = `<button onclick="deleteAllItems()">Clear All Items</button>`;
    const viewCarts = (e) => {
        let viewCart = e.map(e => `<div class="items">
            <div class="itemsImg"><img src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent">
                <div class="itemsTitle">${e.nameProduct}</div>
                <div class="itemsPrice">Price: ${e.price} USD</div>
                <div class="itemsPrice">Total: <span id='itemsPrice${e.idCart}'>${e.price*e.countProduct}</span> USD</div>
            </div>
            <div class="button">
                <button class="decre flex items-center justify-center text-[20px] font-bold" onclick="decrement(${e.idCart},${e.price})">-</button>
                <div id='viewCount${e.idCart}' class="viewCount">${e.countProduct}</div>
                <button class="incre flex items-center justify-center text-[20px] font-bold" onclick="increment(${e.idCart},${e.price})">+</button>
            </div>
            <div class="delete" onclick="deleteItems(${e.idCart})">DELETE</div>
            
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
        let button = `<button>PURCHASE</button>`;
        product = product.filter(e => e.idCart !== id);
        viewCart = product.map(e => `<div class="items">
        <div class="itemsImg"><img src=${e.imgProduct} alt="image"/></div>
        <div class="itemsContent">
            <div class="itemsTitle">${e.nameProduct}</div>
            <div class="itemsPrice">Price: ${e.price} USD</div>
            <div class="itemsPrice">Total: <span id='itemsPrice${e.idCart}'>${e.price*e.countProduct}</span> USD</div>
        </div>
        <div class="button">
            <button class="decre" onclick="decrement(${e.idCart},${e.price})">-</button>
            <div id='viewCount${e.idCart}' class="viewCount">${e.countProduct}</div>
            <button class="incre" onclick="increment(${e.idCart},${e.price})">+</button>
        </div>
        <div class="delete" onclick="deleteItems(${e.idCart})">DELETE</div>
        
    </div>`);
        
    
        if(product.length !== 0){
            document.getElementById('viewCart').innerHTML = viewCart.join('');
            document.getElementById('purchase').innerHTML = button;
            document.getElementById('clearAll').innerHTML = btnClearAll
        }else{
            document.getElementById('viewCart').innerHTML = viewCartEmpty;
            document.getElementById('purchase').innerHTML = "";
            document.getElementById('clearAll').innerHTML = ""
        }
      
      deleteCart(id)
    }

    const deleteAllItems = () => {
        document.getElementById('viewCart').innerHTML = viewCartEmpty;
        document.getElementById('purchase').innerHTML = "";
        document.getElementById('clearAll').innerHTML = "";
        deleteAll(idUser);
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
    const deleteAll = (id) => {
        let postData = {fname:'deleteAll' , idUser: id}
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

</script>