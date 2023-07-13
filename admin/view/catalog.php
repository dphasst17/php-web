<?php 
    include '../model/type.php';
    include '../model/product.php';
    $result = select_min_max_in_loai();

?>
<div class="btn btn-primary  float-left"  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="window.location.href='index.php?act=new'">Thêm danh mục</div>
<table id="myTable" class="table table-dark border border-light">
  <thead>
      <tr>
        <th scope="col">Mã loại</th>
        <th scope="col">Tên loại</th>
        <th scope="col">Giá thấp nhất</th>
        <th scope="col">Giá trung bình</th>
        <th scope="col">Giá cao nhất</th>
        <th scope="col" class="col-1">Chỉnh sửa</th>
        <th scope="col" class="col-1">Xóa</th>
      </tr>
  </thead>
</table>
<script>
    let data = <?php echo json_encode($result);?>;
    let table = document.getElementById("myTable");
    let viewData = data.map(e => `<tbody>
        <tr style="cursor:pointer;">
            <td scope="row">${e.idType}</td>
            <td>${e.nameType}</td>
            <td>${e.min}</td>
            <td>${e.medium}</td>
            <td>${e.max}</td>
            <th scope="col"><button class="btn btn-primary">Edit</button></th>
            <th scope="col"><button class="btn btn-danger">Delete</button></th>
        </tr>
    </tbody>`).join('');
    document.getElementById("myTable").insertAdjacentHTML('beforeend', viewData);
</script>