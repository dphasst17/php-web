<?php 
    include '../model/comment.php';
    $data = comment_select_all_2();
    
?>
<table id="myTable" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="w-40">Mã bình luận</th>
        <th scope="col">Mã hàng hóa</th>
        <th scope="col">Mã khách hàng</th>
        <th scope="col" class="col-3">Nội dung</th>
        <th scope="col" class="col-1">Ngày bình luận</th>
      </tr>
  </thead>
</table>
<div class="pagination m-auto">
        <div class="prevPage d-flex align-items-center btn btn-outline-secondary text-center text-light" onclick="prevPage()" style="cursor:pointer">PREV</div>
        <div class="buttonPage" id="buttonPage">
        </div>
        <div class="nextPage d-flex align-items-center btn btn-outline-secondary text-center text-light" onclick="nextPage()"style="cursor:pointer">NEXT</div>
</div> 
<script>
    let data = <?php echo json_encode($data)?>;
    let start = 0;
    let end = 12;
    let itemsInPage = 12;
    let activePage = 1
    let totalPage = data.length % itemsInPage === 0 ? data.length / itemsInPage : (data.length / itemsInPage) + 1;
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
    const paginationPage = () => {
        let pagination = [];
        
        for(let i = 1; i <= totalPage; i++){
            pagination.push(i);
        }
        let viewPagination = pagination.map(e => `<button class='${e === activePage ? 'btn btn-lg btn-primary active m-2' : 'btn btn-lg btn-secondary m-2'}' onclick='setPagination(${e})' id="showButton-${e}">${e}</button>`);
        document.getElementById('buttonPage').innerHTML = viewPagination.join('')
    }
    const setPagination = (e) => {
        start = (12 * e) - 12;
        end = 12*e;
        document.getElementById(`showButton-${activePage}`).classList.remove('active');
        activePage = e;
        document.getElementById(`showButton-${e}`).classList.add('active');
        viewProducts(data,start,end);
    }
    const viewProducts = (e,start,end) => {
        let viewProduct = e.slice(start,end).map(e => `<tbody>
            <tr>
                <th scope="col">${e.idComment}</th>
                <th scope="col">${e.idProduct}</th>
                <th scope="col">${e.idUser}</th>
                <th scope="col">${e.commentValue}</th>
                <th scope="col">${e.dateComment}</th>
                <th scope="col"><button class="btn btn-danger">Delete</button></th>
            </tr>
        </tbody>`).join('');
        document.getElementById("myTable").innerHTML = viewProduct;
        paginationPage();
    }
    viewProducts(data,start,end);
</script>