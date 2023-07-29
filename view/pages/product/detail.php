<div id="viewProduct" class="w-full min-h-[500px] h-auto my-[2%]">

</div>
<div class="getComment w-4/5 min-h-[250px] flex flex-col mx-auto my-[0]">
    <div class="writeComment w-full lg:w-4/5 h-200px my-[0] " id="write"></div>
    <div class="comment w-full min-h-[150px] flex flex-col justify-center items-start mb-[2%]">
        <h1 class="mx-auto my-[0] text-center text-[30px] font-bold">Comments</h1>
        <div id="viewComment" class="w-full lg:w-4/5 min-h-[150px] flex flex-col flex-wrap justify-around">
    
        </div>
    </div>
</div>
<div class="viewType w-screen xl:w-full min-h-[150px] flex flex-col justify-center items-center mb-[2%]">
    <h1 class="text-center text-[30px] font-bold">SIMILAR PRODUCTS</h1>
    <div id="productType" class="w-[90%] min-h-[150px] flex flex-wrap justify-around"></div>
</div>

<script>
    let value = window.location.pathname.split( '/' );
    let idType = value[2]
    let idProduct = value[3]
    let idUser = JSON.parse(localStorage.getItem("uS") || "[]")
    let postData = {idProduct:idProduct};
            fetch(`/api/products/detail/${idProduct}`)
            .then(res => res.json())
            .then(data => {
                let newData = [data];
                viewData(newData)
            })
            fetch(`/api/user/${idUser}`)
            .then(response => {return response.json()})
            .then(data => {
                commentUser([data]);
            })
            fetch(`/api/comment/${idProduct}`)
            .then(response => {return response.json()})
            .then(data => {
                getCommentById(data);
            })
            fetch('/api/products/updateview', {
                method: 'POST',
                body:JSON.stringify(postData)
            })
            .then(response => {response.text()})
            fetch(`/api/products/detail/${idType}/${idProduct}`)
            .then(res => {return res.json()})
            .then(result => {
                viewProductDifferentId(result)
            })
    const viewData = (e) => {
        let product = e[0];
        let viewProducts = `<div class="productDetail w-full h-auto min-h-[500px] flex flex-col lg:flex-row justify-between">
            <div class="detailImage w-full lg:w-2/4 h-full flex justify-center"><img class="w-2/4 h-2/4 object-cover" src=${product.imgProduct} alt="imgProduct-${product.nameProduct}"></div>
            <div class="detailContent w-full lg:w-2/4 h-full flex flex-col justify-center">
                <div class="detailTitle w-[95%] h-auto min-h-[70px]">
                    <h1 class='text-[#9d2b2b] text-center text-[40px] font-bold overflow-hidden whitespace-normal text-ellipsis'>
                        ${product.nameProduct}
                    </h1>
                </div>
                <div class="detailPrice w-full min-h-[70px] my-[2%] pl-[2%]"><h2 class='text-[30px] font-medium'>Price: <span class='text-[#9d2b2b] font-bold'>${product.price} USD</span></h2></div>
                <div class="informationProduct min-h-[70px] mb-[2%] pl-[2%]">
                    <div class="text-[20px] font-semibold">TYPE PRODUCT: ${product.nameType.toUpperCase()}</div>
                    <div class="text-[20px] font-semibold">BRAND: ${product.brand.toUpperCase()}</div>
                    <div class="text-[20px] font-semibold">${product.detail1}</div>
                    <div class="text-[20px] font-semibold">${product.detail2}</div>
                    <div class="text-[20px] font-semibold">${product.detail3}</div>
                    <div class="text-[20px] font-semibold">${product.detail4}</div>
                    <div class="text-[20px] font-semibold">${product.detail5}</div>
                    <div class="text-[20px] font-semibold">${product.detail6}</div>
                </div>
                <div class="detailButton">
                    <button 
                    class='w-[40%] min-w-[150px] h-[50px] text-[20px] font-semibold bg-[#586582] hover:bg-[#4F71B1] text-white rounded-[10px] transition-all cursor-pointer outline-none'
                    >
                        ADD TO CART
                    </button>
                </div>
                <div class="detailDescribe w-full lg:w-4/5 min-w-[150px] min-h-[100px] h-auto flex items-center justify-center text-[20px] text-black font-semibold my-[5%]">${product.des !== null ? product.des :""}</div>
            </div>
        </div>`;
        document.getElementById("viewProduct").innerHTML = viewProducts;
    }
    const viewProductDifferentId = (data) => {
        let viewProductType = data.slice(0,5).map(e => `<div class="items w-[250px] min-w-[150px] h-[200px]">
            <div class="itemsImg w-full h-2/5 flex justify-center"><img class="w-2/4 h-full object-contain" src=${e.imgProduct} class="object-contain" alt="imgProduct"/></div>
            <div class="itemsTitle w-full  min-h-[50px] flex items-center text-center text-[18px] text-[#9d2b2b] font-semibold overflow-hidden whitespace-nowrap text-ellipsis"><span class="w-full mx-auto overflow-hidden whitespace-nowrap text-ellipsis">${e.nameProduct}</span></div>
            <div class="itemsPrice w-full h-[30px] text-[#9d2b2b] font-bold">Price: <span>${e.price} USD</span> </div>
            <div class="button w-full h-1/5 flex flex-row justify-start">
                <button class="w-[62%] lg:h-full text-[15px] text-white font-semibold rounded-[5px] bg-[#586582] hover:bg-[#4F71B1] transition-all border-none outline-none cursor-pointer">Add to cart</button>
                <button class="w-[30%] lg:h-full text-[15px] text-black font-semibold rounded-[5px] ml-[2%] hover:text-white hover:bg-[#4F71B1] transition-all border-none outline-none cursor-pointer" onclick="location.href='/detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
            </div>
        </div>`);
        document.getElementById('productType').innerHTML = viewProductType.join('');
    }
    const commentUser = (e) => {
        let viewWriteComment = e.map(e => `<div class="child w-full h-full flex justify-evenly">
            <div class="itemsImg w-1/5 h-full flex justify-center items-center"><img class="w-[150px] h-[150px] rounded-[10%] border-solid border-[1px] border-black object-cover" src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`/public/images/uploads/${e.img}`} alt="imgUserComment" id="valueImg"/></div>
            <div class="commentValues w-[75%] h-[200px] lg:h-[150px] flex flex-col justify-around">
                <div class="commentUser w-3/5 h-[20%] text-[18px] font-semibold " id="userName">${e.nameUser}</div>
                <div class="commentValue w-[99%] h-[45%] flex items-center border-solid border-[1px] border-black rounded-[5px]"><input class="w-full h-[95%] text-[20px] font-semibold pl-[2%] bg-transparent border-none outline-none" type="text" value = "" id="getValue" /></div>
                <div class="pushComment w-[150px] h-[30%]"><button class="w-full h-full text-white text-[20px] font-semibold bg-[#586582] hover:bg-[#4F71B1] cursor-pointer rounded-[10px] border-none" onclick="pushComment()">Submit</button></div>
            </div>
        </div>
    `);
        if(isLogin === "true"){
            document.getElementById("write").innerHTML = viewWriteComment.join('');
        }
    }
    const getCommentById = (data) => {

        let viewComment = data.map(e => `<div class="items w-full lg:w-3/5 min-h-[200px] h-auto flex items-center">
            <div class="itemsImg w-[70px] h-[70px] mx-[2%]"><img class="w-full h-full rounded-[50%] border-solid border-[1px] border-black" src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`/public/images/uploads/${e.img}`} alt="imgUserComment"/></div>
            <div class="commentContent w-[90%] min-h-[100px] h-[100px] flex flex-wrap">
                <div class="commentInfor w-full h-2/5 flex">
                    <div class="commentUser w-2/4 h-[30px] text-[18px] font-semibold">${e.nameUser}</div>
                    <div class="commentDate w-2/4 h-[30px] flex items-center">Comment time: ${e.dateComment}</div>
                </div>
                <div class="commentValue w-full h-3/5 rounded-[5px] px-[1%] border-solid border-[1px] border-black"><h3>${e.commentValue}</h3></div>
            </div>
            
        </div>`);
        
    
        document.getElementById('viewComment').innerHTML = viewComment.join('');
    }
    


    const pushComment = () => {
        const img = document.getElementById("valueImg").src;
        const name = document.getElementById("userName").innerText;
        const value = document.getElementById("getValue").value;
        const date = new Date().toISOString().split('T')[0];
        const listComment = document.getElementById("viewComment");
        
        const newComment = `
            <div class="items">
                <div class="itemsImg">
                    <img src=${img} alt="imgUserComment" />
                </div>
                <div class="commentContent">
                    <div class="commentUser">${name}</div>
                    <div class="commentDate">Comment time: ${date}</div>
                    <div class="commentValue"><h3>${value}</h3></div>
                </div>
            </div>
        `
        listComment.insertAdjacentHTML('afterbegin', newComment);
        document.getElementById("getValue").value = "";
        let postComment = {id:idUser.toString(),idProduct:idProduct,value:value,date:date}
        fetch('/api/comment/insert',{
            method: 'POST',
            headers: {
                    'Content-Type': 'application/json'
            },
            body: JSON.stringify(postComment)
        })
        .then(res => res.json())
    }
</script>