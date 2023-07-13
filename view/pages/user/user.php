<?php 
    $css = file_get_contents('view/pages/user/styleUser.css');
    echo "<style>" . $css . "</style>";
?>
<div class="userPage">
    <div id="getUser">
        <div id="information"></div>
        <div class="viewPurchase" style="width:100%;min-height:200px;height:auto;margin-top:5%;">
            <table id="confirm" style="width:90%;height:auto;display:flex;flex-direction:column;margin:0 auto;">
                <thead style="width:100%;min-height:30px;">
                    <tr style="width:100%;display:flex;justify-content:space-between;">
                        <th style="width:20%;text-align:center">Tên sản phẩm</th>
                        <th style="width:20%;text-align:center">Đơn giá</th>
                        <th style="width:20%;text-align:center">Trạng thái</th>
                        <th style="width:20%;text-align:center">Số lượng</th>
                        <th style="width:20%;text-align:center">Hủy</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="items">
        <h1 style="cursor:pointer" class="text-[40px] font-bold">Đơn hàng đã mua</h1>
        <div id="bought"></div>
        <div class="pagination">
            <div class="prevPage" onclick="prevPage()">PREV</div>
            <div class="buttonPage" id="buttonPage">
            
            </div>
            <div class="nextPage" onclick="nextPage()">NEXT</div>
        </div>
    </div>
</div>
<script>
    let idUser = JSON.parse(localStorage.getItem("uS") || []).toString()
    let data = [];
    let purchase = [];
    let bought = [];
    let totalPage=0;
    let getDataUser={idUser:idUser}
    fetch(`./api/user/${idUser}`)
    .then(res => 
        {
            if (!res.ok) {
                throw new Error(`An error occurred: ${res.status}`);
            }
            return res.json();
        }
    )
    .then(dataUser => 
        {
            data = [dataUser]
            viewUser([dataUser])
        }
    );

    fetch(`./api/user/transport/${idUser}`)
    .then(res => 
        {
            if (!res.ok) {
                throw new Error(`An error occurred: ${res.status}`);
            }
            return res.json();
        }
    )
    .then(transportData => 
        {
            viewTransport(transportData)
        }
    );
    fetch(`./api/user/bought/${idUser}`)
    .then(res => 
        {
            if (!res.ok) {
                throw new Error(`An error occurred: ${res.status}`);
            }
            return res.json();
        }
    )
    .then(boughtData => 
        {
            if(boughtData.length === 0){
                let isEmpty = `<h1>No orders yet</h1>`
                document.getElementById('bought').innerHTML = isEmpty;
            }else{
                bought = boughtData
                totalPage = bought.length % itemsInPage === 0 ? bought.length / itemsInPage : (bought.length / itemsInPage) + 1;
                viewBought(boughtData,start,end)
            }
        }
    );
    let start = 0;
    let end = 5;
    let itemsInPage = 5;
    let activePage = 1;
    
    const nextPage = () => {
        if(activePage < totalPage){
            activePage = activePage + 1;
            setPagination(activePage)
        }
    }
    const prevPage = () => {
        if(activePage > 1){
            activePage = activePage - 1;
            setPagination(activePage)
        }
    }
    const paginationPage = (e) => {
        let pagination = [];

        for(let i = 1; i <= totalPage; i++){
            pagination.push(i);
        }
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'active' : ""}' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        document.getElementById('buttonPage').innerHTML = viewPagination.join('')
        
    }
    const setPagination = (e) => {
        start = (5 * e) - 5;
        end = 5*e;
        document.getElementById(`showButton-${activePage}`).classList.remove('active');
        activePage = e;
        document.getElementById(`showButton-${e}`).classList.add('active');
        viewBought(bought,start,end)
        
    }
    const viewBought = (p,start,end) => {
        let viewBought = p.slice(start,end).map(e => `<div class="items">
            <div class="itemsImg"><img src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent">
                <div class="itemsTitle">${e.nameProduct}</div>
                <div id='viewCount' class="itemsPrice">Count: ${e.countProduct}</div>
                <div class="itemsPrice">Price: ${e.price} USD</div>
                <div class="itemsPrice">Total: <span id='itemsPrice'>${e.price*e.countProduct}</span> USD</div>
            </div>
        
        </div>`);
        document.getElementById('bought').innerHTML = viewBought.join('');
        paginationPage()
    }
    const viewUser = (e) => {
        let viewInfor = e.map(e => `<div class="userDetail">
            <div class="userImg">
                <img class='w-[70px] h-full rounded-[50%] border-solid border-2 border-black cursor-pointer object-cover' src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`./public/images/uploads/${e.img}`}  alt="User-image" />
                <div class="changeAvt absolute w-[12%] h-[50px] my-[2%] mx-[0] ml-[2%] flex flex-wrap justify-end items-end pr-[3%]" >
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" onclick="changeAvt()" class="w-[25px] h-[30px] rounded-[50%] border-2 border-solid border-black hover:border-blue-900 p-[2%] cursor-pointer transition-all fill-black hover:fill-blue-900">
                        <path  d="M220.6 121.2L271.1 96 448 96v96H333.2c-21.9-15.1-48.5-24-77.2-24s-55.2 8.9-77.2 24H64V128H192c9.9 0 19.7-2.3 28.6-6.8zM0 128V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H271.1c-9.9 0-19.7 2.3-28.6 6.8L192 64H160V48c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16l0 16C28.7 64 0 92.7 0 128zM168 304a88 88 0 1 1 176 0 88 88 0 1 1 -176 0z"/>
                    </svg>
                </div>
            </div>
            <div class="userName">Tên: <span>${e.nameUser}</span></div>
            <div class="email">Email: <span>${e.email}</span></div>
            <div class="change">
                <button onclick="changeUser()">Change user information</button>
            </div>
        </div>`)
        document.getElementById('information').innerHTML = viewInfor.join('');
    }

    const viewTransport = (e) => {
        let viewPurchase = e.map(e => `<tbody style='width:100%;'>
                <tr style='width:100%;min-height:40px;display:flex;justify-content:space-between;align-items:center'>
                    <th style='width:20%;text-align:center'>${e.nameProduct}</th>
                    <th style='width:20%;text-align:center'>${e.price}</th>
                    <th style='width:20%;text-align:center'>${e.status}</th>
                    <th style='width:20%;text-align:center'>${e.countProduct}</th>
                    ${e.status === "Chờ xác nhận" ? `<th style='width:20%;text-align:center'>
                        <button style='width:120px;height:30px;background-color:#dc3545;border-radius:5px;outline:none;border:none;cursor:pointer;color:#fff;font-weight:550;'>
                            Hủy đơn hàng
                        </button>
                    </th>`:`<th style='width:20%;text-align:center'></th>`}
                </tr>
            </tbody>`).join('')
        document.getElementById("confirm").insertAdjacentHTML('beforeend', viewPurchase);
    }
   

    const changeAvt = () => {
        let changeAvt = `<input type="hidden" name="size" value="1000000"> 
            <input type="file" name="image" id="newImage"> 
            <button class="btn btn-lg btn-primary" onclick="save()" 
            style='width:100px;height:30px;border-radius:10px;background-color: rgb(88, 101, 130);color:#fff;font-size:15px;
            font-weight:500;border:none;outline:none;cursor:pointer'
            >
                Save
            </button>`
        document.querySelector(".userImg").innerHTML = changeAvt
    }
    const save = () => {
        let id = idUser;
        let file = document.getElementById("newImage").files[0];
        let reader = new FileReader();
        reader.onload = function() {
            let imageUrl = reader.result;
            let newImage = `<img class='w-[70px] h-full rounded-[50%] border-solid border-2 border-black cursor-pointer object-cover' src="${imageUrl}" alt="User-image" />
            <div class="changeAvt absolute w-[12%] h-[50px] my-[2%] mx-[0] ml-[2%] flex flex-wrap justify-end items-end pr-[3%]" >
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" onclick="changeAvt()" class="w-[25px] h-[30px] rounded-[50%] border-2 border-solid border-black hover:border-blue-900 p-[2%] cursor-pointer transition-all fill-black hover:fill-blue-900">
                    <path  d="M220.6 121.2L271.1 96 448 96v96H333.2c-21.9-15.1-48.5-24-77.2-24s-55.2 8.9-77.2 24H64V128H192c9.9 0 19.7-2.3 28.6-6.8zM0 128V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H271.1c-9.9 0-19.7 2.3-28.6 6.8L192 64H160V48c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16l0 16C28.7 64 0 92.7 0 128zM168 304a88 88 0 1 1 176 0 88 88 0 1 1 -176 0z"/>
                </svg>
            </div>
            `;
            document.querySelector(".userImg").innerHTML = newImage; 
        };
        reader.readAsDataURL(file);
        var formData = new FormData();
        formData.append('file', file);
        formData.append('id', id);
        fetch('./api/user/image', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            if (response == 1) {
                console.log("Upload successfully.");
            } else {
                console.log("File not uploaded.");
            }
        })
        .catch(error => console.error('Error:', error));

       
    }


    const changeUser = () => {
        let changeUserName= data.map(e => `<input type="text" value=${e.nameUser} id="newName"/>`);
        let changeEmail= data.map(e => `<input type="text" value=${e.email} id="newEmail"/>`);
        let save = `<button onclick="saveData()">
                        Save
                    </button>`
        document.querySelector(".userName").innerHTML = changeUserName.join('')
        document.querySelector(".email").innerHTML = changeEmail.join('');
        document.querySelector(".change").innerHTML = save;
    }
    const saveData = () => {
        let id = idUser;
        let name = document.getElementById("newName");
        let email = document.getElementById("newEmail");
        let newName = `Full Name: <span>${name.value}</span>`;
        let newEmail = `Email: <span>${email.value}</span>`;
        let save = `<button onclick="changeUser()">Change user information</button>`
        document.querySelector(".userName").innerHTML = newName;
        document.querySelector(".email").innerHTML = newEmail;
        document.querySelector(".change").innerHTML = save;
        let postData={id:id,name:name.value,email:email.value}
        fetch('./api/user/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:JSON.stringify(postData)
        })
        .then(response => response.text())
        .then(response => console.log(response))
        .catch(error => console.error('Error:', error));

        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "handle/user.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + id +"&name="+name.value + "&email="+email.value); 
    }



</script>