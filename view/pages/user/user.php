
<div class="userPage w-[98%] md:w-[90%] min-h-[400px] h-auto flex flex-col md:flex-row justify-center my-[2%] mx-auto mt-[12%] smr:mt-[5%] md:mt-0 pt-[2%]">
    <div id="getUser" class="w-full md:w-2/4 h-full flex flex-col justify-center">
        <div id="information" class="w-full h-2/4 flex justify-center mb-[5%]"></div>
        <div class="viewPurchase w-full min-h-[200px] h-auto mt-[5%]">
            <table id="confirm" class="w-full md:w-[90%] h-auto flex flex-col my-[0] mx-auto" >
                <caption class="text-center text-[20px] text-[#03207e] font-bold mb-[5%]">Đơn hàng đang mua</caption>
                <thead class="w-full min-h-[30px] border-b-[2px] border-b-black border-b-solid" >
                    <tr class="w-full flex justify-between" >
                        <th class="w-1/5 text-center">Tên sản phẩm</th>
                        <th class="w-1/5 text-center">Đơn giá</th>
                        <th class="w-1/5 text-center">Trạng thái</th>
                        <th class="w-1/5 text-center">Số lượng</th>
                        <th class="w-1/5 text-center">Hủy</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="items" class="w-full md:w-2/4 h-full flex flex-col justify-center mt-[2%] md:mt-0">
        <h1 id="boughtTitle" style="display:block;cursor:pointer" class="text-[20px] md:text-[40px] font-bold text-[#03207e] text-center cursor-pointer">Đơn hàng đã mua</h1>
        <div id="bought" class="w-full min-h-[575px] h-auto"></div>
        <div id="pagination" style="display:flex" class="pagination w-4/5 h-[50px] justify-evenly items-center m-auto">
            <div class="prevPage w-[10%] h-2/4 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="prevPage()">PREV</div>
            <div class="buttonPage w-4/5 min-w-[60px] h-full flex justify-evenly items-center mx-[2%]" id="buttonPage">
            
            </div>
            <div class="nextPage w-[10%] h-2/4 bg-slate-300 flex items-center justify-center text-[18px] text-black font-medium rounded-[8px] cursor-pointer transition-all hover:bg-[#586582] hover:text-white" onclick="nextPage()">NEXT</div>
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
                let isEmpty = `<h1 class="text-center text-[20px] font-semibold">No orders yet</h1>`
                document.getElementById('bought').innerHTML = isEmpty;
                document.getElementById('pagination').style.display = "none"
                document.getElementById('boughtTitle').style.display = "none"
            }else{
                document.getElementById('pagination').style.display = "flex"
                document.getElementById('boughtTitle').style.display = "none"
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
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'activeBtn' : ""} w-[45px] min-w-[30px] h-[25px] text-[18px] font-medium rounded-[8px] border-none cursor-pointer hover:bg-[#586582] hover:text-white transition-all' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
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
        let viewBought = p.slice(start,end).map(e => `<div class="items w-full min-h-[100px] h-auto flex justify-center items-center p-[5px] border-solid border-b-[2px] border-black">
            <div class="itemsImg w-[30%] h-full"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} alt="image"/></div>
            <div class="itemsContent w-[70%] h-full flex flex-wrap">
                <div class="itemsTitle w-2/4 min-h-[30px] text-[20px] font-medium text-[#2f2a87] overflow-hidden text-ellipsis whitespace-nowrap">${e.nameProduct}</div>
                <div id='viewCount' class="itemsPrice w-2/4 min-h-[30px] text-[20px] font-medium text-[#2f2a87] overflow-hidden text-ellipsis whitespace-nowrap">Count: ${e.countProduct}</div>
                <div class="itemsPrice w-2/4 min-h-[30px] text-[20px] font-medium text-[#2f2a87] overflow-hidden text-ellipsis whitespace-nowrap">Price: ${e.price} USD</div>
                <div class="itemsPrice w-2/4 min-h-[30px] text-[20px] font-medium text-[#2f2a87] overflow-hidden text-ellipsis whitespace-nowrap">Total: <span id='itemsPrice'>${e.price*e.countProduct}</span> USD</div>
            </div>
        
        </div>`);
        document.getElementById('bought').innerHTML = viewBought.join('');
        paginationPage()
    }
    const viewUser = (e) => {
        let viewInfor = e.map(e => `<div class="userDetail w-full md:w-[90%] h-[90%] flex flex-col items-center">
            <div class="userImg w-full h-[70px] flex justify-center mb-[5%]">
                <img class='w-[70px] h-full rounded-[50%] border-solid border-2 border-black cursor-pointer object-cover' src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`/public/images/uploads/${e.img}`}  alt="User-image" />
                <div class="changeAvt w-[12%] lg:w-[7%] h-full flex flex-wrap justify-end items-end pr-[3%]" >
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" onclick="changeAvt()" class="w-[25px] h-[30px] rounded-[50%] border-2 border-solid border-black hover:border-blue-900 p-[2%] cursor-pointer transition-all fill-black hover:fill-blue-900">
                        <path  d="M220.6 121.2L271.1 96 448 96v96H333.2c-21.9-15.1-48.5-24-77.2-24s-55.2 8.9-77.2 24H64V128H192c9.9 0 19.7-2.3 28.6-6.8zM0 128V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H271.1c-9.9 0-19.7 2.3-28.6 6.8L192 64H160V48c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16l0 16C28.7 64 0 92.7 0 128zM168 304a88 88 0 1 1 176 0 88 88 0 1 1 -176 0z"/>
                    </svg>
                </div>
            </div>
            <div class="userName w-full md:w-[70%] h-[50px] my-[2%] flex items-center text-[20px] text-[18px] font-medium pl-[2%] border-solid border-2 border-black rounded-[5px]">Tên: <span class="font-bold text-[#2f2a87] text-[20px] mx-[2%]">${e.nameUser}</span></div>
            <div class="email w-full md:w-[70%] h-[50px] my-[2%] flex items-center text-[20px] text-[18px] font-medium pl-[2%] border-solid border-2 border-black rounded-[5px]">Email: <span class="font-bold text-[#2f2a87] text-[20px] mx-[2%]">${e.email}</span></div>
            <div class="change">
                <button class="w-[250px] h-[40px] outline-none border-none rounded-[10px] text-[16px] text-white font-semibold bg-[#586582] hover:bg-blue-700 cursor-pointer transition-all" onclick="changeUser()">Change user information</button>
            </div>
        </div>`)
        document.getElementById('information').innerHTML = viewInfor.join('');
    }

    const viewTransport = (e) => {
        let viewPurchase = e.map(e => `<tbody class="w-full border-b-[2px] border-b-black border-b-solid">
                <tr class="w-full min-h-[40px] flex justify-between items-center">
                    <th class="w-1/5 text-center">${e.nameProduct}</th>
                    <th class="w-1/5 text-center">${e.price}</th>
                    <th class="w-1/5 text-center">${e.status}</th>
                    <th class="w-1/5 text-center">${e.countProduct}</th>
                    ${e.status === "Chờ xác nhận" ? `<th class="w-1/5 text-center">
                        <button style='width:120px;height:30px;background-color:#dc3545;border-radius:5px;outline:none;border:none;cursor:pointer;color:#fff;font-weight:550;'>
                            Hủy đơn hàng
                        </button>
                    </th>`:`<th class="w-1/5 text-center"></th>`}
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
        fetch('/api/user/image', {
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
        let changeUserName= data.map(e => `<input class="w-[95%] h-full bg-transparent border-none outline-none font-medium text-[18px]" type="text" value=${e.nameUser} id="newName"/>`);
        let changeEmail= data.map(e => `<input class="w-[95%] h-full bg-transparent border-none outline-none font-medium text-[18px]" type="text" value=${e.email} id="newEmail"/>`);
        let save = `<button class="w-[250px] h-[40px] outline-none border-none rounded-[10px] text-[16px] text-white font-semibold bg-[#586582] hover:bg-blue-700 cursor-pointer transition-all" onclick="saveData()">
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
        let newName = `Tên: <span class="font-bold text-[#2f2a87] text-[20px] mx-[2%]">${name.value}</span>`;
        let newEmail = `Email: <span class="font-bold text-[#2f2a87] text-[20px] mx-[2%]">${email.value}</span>`;
        let save = `<button class="w-[250px] h-[40px] outline-none border-none rounded-[10px] text-[16px] text-white font-semibold bg-[#586582] hover:bg-blue-700 cursor-pointer transition-all" onclick="changeUser()">Change user information</button>`
        document.querySelector(".userName").innerHTML = newName;
        document.querySelector(".email").innerHTML = newEmail;
        document.querySelector(".change").innerHTML = save;
        let postData={id:id,name:name.value,email:email.value}
        fetch('/api/user/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:JSON.stringify(postData)
        })
        .then(response => response.text())
        .then(response => console.log(response))
        .catch(error => console.error('Error:', error));

    }



</script>