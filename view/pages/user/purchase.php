<div class="purchase w-full h-auto min-h-[86.3vh] flex flex-col lg:flex-row justify-around items-center lg:items-start">
    <div id="viewPurchase" class="w-screen lg:w-[66%] min-h-[60vh] h-auto flex flex-wrap justify-evenly lg:justify-start"></div>
    <div class="viewUser w-full sm:w-3/4 lg:w-[30%] flex flex-col">
        <div id="user" class="w-full h-[200px]"></div>
        <select class="w-full h-[50px] outline-none rounded-[5px] bg-[#dad8d8] text-[#03207e] text-[20px] font-semibold my-[3%] cursor-pointer" id="city" required>
            <option value="">City</option>
        </select>
        <select class="w-full h-[50px] outline-none rounded-[5px] bg-[#dad8d8] text-[#03207e] text-[20px] font-semibold my-[3%] cursor-pointer" id="district" required>
            <option value="">District</option>
        </select>
        <div class="addressDetail w-full h-[50px]">
            <input class="w-full h-full outline-none rounded-[5px] border-black border-solid border-[1px] pl-[1%]" type="text" placeholder="Enter your address detail" required id="address">
        </div>
        <div class="payment w-full min-h-[50px] flex flex-col justify-center">
            <h2 class="text-[20px] font-bold">Payment methods</h2>
            <div class="methods w-full h-[35px] flex justify-evenly items-center text-[20px] text-black font-bold">
                <input type="radio" name="methods" id="pay1" value="Payment on delivery">
                <label class="cursor-pointer" for="pay1">Payment on delivery</label>
                <input type="radio" name="methods" id="pay2" value="Pay by credit card/visa" />
                <label class="cursor-pointer" for="pay2">Pay by credit card/visa</label>
            </div>
        </div>
        <div class="ship w-full min-h-[50px] flex items-center text-[22px]">
            <span class="text-[22px] font-semibold">Transportation costs:&nbsp;</span>
            <div id="costs" class="text-[25px] font-bold text-[#2f2a87]">0</div><span> &nbsp;USD</span>
        </div>
        <div class="total w-full min-h-[50px] flex items-center text-[22px]">
            <span>Total:&nbsp;</span><div id="getTotal" class="text-[25px] font-bold text-[#2f2a87]">0</div><span>&nbsp;USD</span>
        </div>
        <input class="w-[285px] h-[40px] rounded-[5px] border-none outline-none mx-auto bg-[#5580d4] text-white text-[20px] font-semibold cursor-pointer" type="submit" class="buy" value="BUY NOW" onclick="submit()"/>
    </div>
    
</div>
<script>
    let product = [];
    let user = [];
    let postData = {fname:'view'};
    const getDataProduct = async() => {
        let token = await checkExpCookie(checkRf,url);
        fetch('/api/user',{
            headers: {
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + token
            }
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
            product = data;
            viewProduct(data)});
    }
    getDataProduct()
    /* -------------GET CART ---------------*/
    const viewProduct = (data) => {
        let viewCart = data.map(e => `<div class="items w-[200px] lg:w-[300px] h-[300px] flex flex-col justify-end border-none cursor-pointer bg-[#ededed] rounded-[5px] m-[1%]">
            <div class="itemsImg w-full h-2/4 flex justify-center items-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent w-full h-2/4 flex flex-col px-[2%]">
                <div class="itemsTitle w-full min-h-[30px] h-auto text-[20px] text-center text-[#2f2a87] font-semibold overflow-hidden whitespace-nowrap text-ellipsis">${e.nameProduct}</div>
                <div class="itemsPrice w-full min-h-[30px] h-auto text-[20px] text-[#2f2a87] font-semibold">Price: ${e.price} USD</div>
                <div id='viewCount${e.idCart}' class="itemsPrice w-full min-h-[30px] h-auto text-[20px] text-[#2f2a87] font-semibold">Count: ${e.countProduct}</div>
                <div class="itemsPrice w-full min-h-[30px] h-auto text-[20px] text-[#2f2a87] font-semibold">Total:&nbsp;<span id="totalItems">${e.price*e.countProduct}</span>&nbsp;USD</div>
            </div>
        </div>`).join('');
        document.getElementById('viewPurchase').innerHTML = viewCart;
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
        let viewUser = e.map(e => `<div class="getUser w-full h-full flex flex-col justify-evenly items-stretch">
            <input class="w-full h-[50px] pl-[1%] rounded-[5px] border-solid border-[1px] border-black outline-none" type="text" value='${e.nameUser}' id="name" />
            <input class="w-full h-[50px] pl-[1%] rounded-[5px] border-solid border-[1px] border-black outline-none" type="text" value='${e.email}' />
            <input class="w-full h-[50px] pl-[1%] rounded-[5px] border-solid border-[1px] border-black outline-none" type="text" value="" placeholder="Enter your phone" required id="phone"/>
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
            let postData = {name:name.value,phone:phone.value,city:addressDetail.value+", "+district+", "+city,methods:value,costs:costs}
            const fetchData = async() => {
                let token = await checkExpCookie(checkRf,url)
                fetch('/api/transport/insert', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': "Bearer " + token,
                    },
                    body: JSON.stringify(postData)
                })
                .then(res => {if(res.status === 200){
                    window.location.href="/"
                }})
            }
            fetchData();
        
        }
    }
</script>