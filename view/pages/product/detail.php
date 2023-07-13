<?php 
    include 'model/product.php';
    include 'model/comment.php';
    include 'model/user.php';
    $css = file_get_contents('view/pages/product/detail.css');
    echo "<style>" . $css . "</style>";
    $idType = $_GET['idType'];
    $id = $_GET['idProduct'];
    $listComment = comment_select_by_hang_hoa_user($id);
    $updateView = product_tang_so_luot_xem($id);
    $type = product_select_by_loai_different_id('=',$idType,$id);
    
?>

<div id="viewProduct" style="width:100%;height:500px">

</div>
<div class="writeComment" id="write"></div>
<div class="comment">
    <h1>Comments</h1>
    <div id="viewComment">

    </div>
</div>
<div class="viewType">
    <h1>SIMILAR PRODUCTS</h1>
    <div id="productType"></div>
</div>

<script>
    let idProduct = <?php echo $id;?>;
    fetch(`/api/products/detail/${idProduct}`)
    .then(res => res.json())
    .then(data => {
        let newData = [data];
        viewData(newData)
    })

    let isLogin = JSON.parse(localStorage.getItem("isLogin") || [])
    let idUser = JSON.parse(localStorage.getItem("uS") || [])
    let productType = <?php echo json_encode($type); ?>; 
    let comment = <?php echo json_encode($listComment); ?>;
    let postData = {idUser: idUser.toString()}
            fetch(`/tstore/api/user/${idUser}`)
            .then(response => {return response.json()})
            .then(data => {
                commentUser([data]);
            })

    const viewData = (e) => {
        let product = e[0];
        let viewProducts = `<div class="productDetail">
            <div class="detailImage"><img src=${product.imgProduct} alt="imgProduct-${product.nameProduct}"></div>
            <div class="detailContent">
                <div class="detailTitle">
                    <h1 class='text-blue-900 text-center text-[40px] font-bold overflow-hidden whitespace-normal text-ellipsis'>
                        ${product.nameProduct}
                    </h1>
                </div>
                <div class="detailPrice w-full min-h-[70px] my-[2%]"><h2 class='text-[30px] font-medium'>Price: <span class='text-blue-900 font-bold'>${product.price} USD</span></h2></div>
                <div class="detailButton">
                    <button 
                    class='w-[40%] h-[50px] text-[20px] font-semibold bg-blue-900 hover:bg-blue-700 text-white rounded-[10px] transition-all cursor-pointer outline-none'
                    >
                        ADD TO CART
                    </button>
                </div>
                <div class="detailDescribe">${product.des}</div>
            </div>
        </div>`;
        document.getElementById("viewProduct").innerHTML = viewProducts;
    }
    let viewProductType = productType.slice(0,5).map(e => `<div class="items">
        <div class="itemsImg"><img src=${e.imgProduct} alt="imgProduct"/></div>
        <div class="itemsTitle">${e.nameProduct}</div>
        <div class="itemsPrice">Price: <span>${e.price} USD</span> </div>
        <div class="button">
            <button>Add to cart</button>
            <button onclick="location.href='/tstore/detail/${e.idType}/${e.idProduct}/${e.nameProduct}'">Detail</button>
        </div>
    </div>`);

    const commentUser = (e) => {
        let viewWriteComment = e.map(e => `<div class="child">
            <div class="itemsImg"><img src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`/tstore/public/images/uploads/${e.img}`} alt="imgUserComment" id="valueImg"/></div>
            <div class="commentValues">
                <div class="commentUser" id="userName">${e.nameUser}</div>
                <div class="commentValue"><input type="text" value = "" id="getValue" /></div>
                <div class="pushComment"><button onclick="pushComment()">Submit</button></div>
            </div>
        </div>
    `);
        if(isLogin === true){
            document.getElementById("write").innerHTML = viewWriteComment.join('');
        }
    }
    
    let viewComment = comment.map(e => `<div class="items">
        <div class="itemsImg"><img src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`/tstore/public/images/uploads/${e.img}`} alt="imgUserComment"/></div>
        <div class="commentContent">
            <div class="commentUser">${e.nameUser}</div>
            <div class="commentDate">Comment time: ${e.dateComment}</div>
            <div class="commentValue"><h3>${e.commentValue}</h3></div>
        </div>
        
    </div>`);
    

    document.getElementById('productType').innerHTML = viewProductType.join('');
    document.getElementById('viewComment').innerHTML = viewComment.join('');
    


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
        fetch('/tstore/api/comment/insert',{
            method: 'POST',
            headers: {
                    'Content-Type': 'application/json'
            },
            body: JSON.stringify(postComment)
        })
        .then(res => res.json())
        /* var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        };
        xhttp.open("POST", "handle/comment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+ idUser +"&idP="+ <?php echo json_encode($id);?>+"&date="+ date + "&value=" + value); */
    }
</script>