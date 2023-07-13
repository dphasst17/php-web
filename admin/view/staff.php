<?php 
    include '../model/user.php';
    $data = user_select_by_role('1');
?>
<table id="myTable" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="col-1">Mã nhân viên</th>
        <th scope="col" class="col-2">Ảnh đại diện</th>
        <th scope="col" class="col-3">Họ và tên</th>
        <th scope="col" class="col-3">Email</th>
        <th scope="col" class="col-1">Vai trò</th>
        <th scope="col" class="col-1">Chỉnh sửa</th>
        <th scope="col" class="col-1">Xóa</th>
      </tr>
  </thead>
</table>

<script>
    let data = <?php echo json_encode($data)?>;
    let viewProduct = data.map(e => `<tbody>
        <tr>
            <th scope="col" class="col-1">${e.idUser}</th>
           
            <th scope="col" class="col-2">
                <img src=${e.img.length === 0 ? "https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1200px-User-avatar.svg.png" :`../public/images/uploads/${e.img}`}  
                    alt="User-image"  style="width:100px;height:100px;object-fit:contain;"/>
            </th>
            <th scope="col" class="col-3">${e.nameUser}</th>
            <th scope="col" class="col-3">${e.email}</th>
            <th scope="col" class="col-1">Nhân viên</th>
            <th scope="col"><button class="btn btn-primary">Edit</button></th>
            <th scope="col"><button class="btn btn-danger">Delete</button></th>
        </tr>
    </tbody>`).join('');
    document.getElementById("myTable").insertAdjacentHTML('beforeend', viewProduct);
</script>