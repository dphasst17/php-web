<?php 
    $css = file_get_contents('view/pages/user/user.css');
    echo "<style>" . $css . "</style>";
?>
<div class="purchase">
    <div id="viewPurchase"></div>
    <div class="viewUser">
        <div id="user"></div>
        <select id="city" required>
            <option value="">City</option>
        </select>
        <select id="district" required>
            <option value="">District</option>
        </select>
        <div class="addressDetail"><input type="text" placeholder="Enter your address detail" required id="address"></div>
        <div class="payment">
            <h2 class="text-[20px] font-bold">Payment methods</h2>
            <div class="methods">
                <input type="radio" name="methods" id="pay1" value="Payment on delivery">
                <label for="pay1">Payment on delivery</label>
                <input type="radio" name="methods" id="pay2" value="Pay by credit card/visa" />
                <label for="pay2">Pay by credit card/visa</label>
            </div>
        </div>
        <div class="ship">
            <span>Transportation costs:&nbsp;</span>
            <div id="costs">0</div><span> &nbsp;USD</span>
        </div>
        <div class="total">
            <span>Total:&nbsp;</span><div id="getTotal">0</div><span>&nbsp;USD</span>
        </div>
        <input type="submit" class="buy" value="BUY NOW" onclick="submit()"/>
    </div>
    
</div>
<script>
    let idUser = JSON.parse(localStorage.getItem("uS") || []).toString()
    let product = [];
    let user = [];
    let dataUser = {idUser:idUser}
    fetch('./api/user', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dataUser)
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
        user = [data]
        viewDataUser([data])

    });
    let postData = {fname:'view' , idUser:idUser.toString()}
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
    .then(data => {
        product = data;
        viewProduct(data)});
    /* -------------GET CART ---------------*/
    const viewProduct = (e) => {
        let viewCart = e.map(e => `<div class="items">
            <div class="itemsImg"><img src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent">
                <div class="itemsTitle">${e.nameProduct}</div>
                <div class="itemsPrice">Price: ${e.price} USD</div>
                <div id='viewCount${e.idCart}' class="itemsPrice">Count: ${e.countProduct}</div>
                <div class="itemsPrice">Total:&nbsp;<span id="totalItems">${e.price*e.countProduct}</span>&nbsp;USD</div>
            </div>
        </div>`);
        document.getElementById('viewPurchase').innerHTML = viewCart.join('');
        let total = document.querySelectorAll('#totalItems');
        let costsValue = document.querySelectorAll('#costs');
            costsValue = Array.from(costsValue).map(e => e.textContent)
        let arrTotal = Array.from(total).map(el => el.textContent);
        let sum = arrTotal.reduce((a, b) => Number(a) + Number(b));
            sum = sum + Number(costsValue)    
            document.getElementById('getTotal').innerHTML = sum;
    }
    

    /* ---------------- GET data user =----------------- */
    const viewDataUser = (e) => {
        let viewUser = e.map(e => `<div class="getUser">
            <input type="text" value='${e.nameUser}' id="name" />
            <input type="text" value='${e.email}' />
            <input type="text" value="" placeholder="Enter your phone" required id="phone"/>
        </div>`)
        document.getElementById('user').innerHTML = viewUser.join('');
    }
    
/* -----------GET ADDRESS----------------- */
    fetch('https://provinces.open-api.vn/api/?depth=2')
    .then(response => response.json())
    .then(data => {
        var items = [];
        items.push('<option value="">City</option>');
        data.forEach(item => {
            items.push('<option value="' + item.code + '">' + item.name + '</option>');
        });
        document.getElementById('city').innerHTML = items.join('');
    });

document.getElementById('city').addEventListener('change', function () {
    var code = Number(this.value);
    fetch('https://provinces.open-api.vn/api/?depth=2')
        .then(response => response.json())
        .then(data => {
            var items = [];
            items.push('<option value="">District</option>');
            let filter = data.filter(e => e.code === code);
            filter = filter.flatMap(e => e.districts)     
            items.push(filter.map(e => `<option value=${e.code}>${e.name}</option>`))
            document.getElementById('district').innerHTML = items.join('');
            
        });

    const costs = code === 48 ? "0" : "0.85";
    document.getElementById('costs').innerHTML = costs;
    let total = document.querySelectorAll('#totalItems');
    let costsValue = document.querySelectorAll('#costs');
        costsValue = Array.from(costsValue).map(e => e.textContent)
    let arrTotal = Array.from(total).map(el => el.textContent);
    let sum = arrTotal.reduce((a, b) => Number(a) + Number(b));
        sum = sum + Number(costsValue)
    
        document.getElementById('getTotal').innerHTML = sum;
});

    /* ----------------- POST --------------------------- */
    const submit= () => {
        let name = document.getElementById("name");
        let phone = document.getElementById("phone");
        let pay1 = document.getElementById("pay1");
        let pay2 = document.getElementById("pay2");
        let city = document.getElementById('city').options[document.getElementById('city').selectedIndex].text;
        let district = document.getElementById('district').options[document.getElementById('district').selectedIndex].text;
        let addressDetail = document.getElementById("address");
        let methods = document.getElementsByName("methods");
        let costs = document.getElementById("costs").innerText;
        let isValid = true;
        if(phone.value === ""){phone.style.border = "2px solid red";isValid = false}
        if(city === "City"){document.getElementById('city').style.border = "2px solid red";isValid = false}
        if(district === "District"){document.getElementById('district').style.border = "2px solid red";isValid = false}
        if(addressDetail.value ===""){addressDetail.style.border = "2px solid red";isValid = false}
        if(pay1.checked === false && pay2.checked === false){
            alert('Please choose a payment method!');
            isValid = false
        }
        if(isValid){
            const checkedMethod = Array.from(methods).find(method => method.checked);
            const value = checkedMethod ? checkedMethod.value : null;
            let postData = {idUser:idUser,name:name.value,phone:phone.value,city:addressDetail.value+", "+district+", "+city,methods:value,costs:costs}
            fetch('./api/transport/insert', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
            })
            .then(response => response.text())
            .then(data => console.log(data));
            window.location.href="index.php"
        
        }
    }
</script>