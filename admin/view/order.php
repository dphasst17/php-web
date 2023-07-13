<?php 
  include '../model/transport.php';
  $getData = select_transport();

?>
<h1 class="text-center text-light">Đơn hàng chờ xác nhận</h1>
<div class="btn btn-primary "  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="changeStatusAll('Chuẩn bị đơn hàng','Chờ xác nhận')">
  Xác nhận tất cả
</div>
<table id="confirm" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="col-0">Mã vận chuyển</th>
        <th scope="col" class="col-0">Mã khách hàng</th>
        <th scope="col" class="col-0">Mã hàng hóa</th>
        <th scope="col" class="col-1">Trạng thái</th>
        <th scope="col" class="col-0">Số lượng</th>
        <th scope="col" class="col-1">Tên người nhận</th>
        <th scope="col" class="col-1 text-center">SDT</th>
        <th scope="col" class="col-3 text-center">Địa chỉ</th>
        <th scope="col" class="col-2">Phương thức thanh toán</th>
        <th scope="col" class="col-0">Phí vận chuyển</th>
        <th scope="col" class="col-1">Xác nhận</th>
        <th scope="col" class="col-1">Xóa</th>
      </tr>
  </thead>
</table>
<h1 class="text-center text-light">Đơn hàng đang chuẩn bị</h1>
<div class="btn btn-primary "  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="changeStatusAll('Đang vận chuyển','Chuẩn bị đơn hàng')">
  Vận chuyển tất cả
</div>
<table id="delivery" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="col-0">Mã vận chuyển</th>
        <th scope="col" class="col-0">Mã khách hàng</th>
        <th scope="col" class="col-0">Mã hàng hóa</th>
        <th scope="col" class="col-1">Trạng thái</th>
        <th scope="col" class="col-0">Số lượng</th>
        <th scope="col" class="col-1">Tên người nhận</th>
        <th scope="col" class="col-1 text-center">SDT</th>
        <th scope="col" class="col-3 text-center">Địa chỉ</th>
        <th scope="col" class="col-2">Phương thức thanh toán</th>
        <th scope="col" class="col-0">Phí vận chuyển</th>
        <th scope="col" class="col-2">Vận chuyển</th>
      </tr>
  </thead>
</table>

<h1 class="text-center text-light">Đơn hàng đang vận chuyển</h1>
<table id="transport" class="table table-dark border border-light flex-sm-column">
  <thead>
      <tr>
        <th scope="col" class="col-0">Mã vận chuyển</th>
        <th scope="col" class="col-0">Mã khách hàng</th>
        <th scope="col" class="col-0">Mã hàng hóa</th>
        <th scope="col" class="col-1">Trạng thái</th>
        <th scope="col" class="col-0">Số lượng</th>
        <th scope="col" class="col-1">Tên người nhận</th>
        <th scope="col" class="col-1 text-center">SDT</th>
        <th scope="col" class="col-3 text-center">Địa chỉ</th>
        <th scope="col" class="col-2">Phương thức thanh toán</th>
        <th scope="col" class="col-0">Phí vận chuyển</th>
        <th scope="col" class="col-2"></th>
      </tr>
  </thead>
</table>
<script>
  let data = [];
  let confirm = [];
  let delivery = [];
  let transport = [];
  fetch('../api/transport')
  .then(res => {return res.json()})
  .then(getData => {
    data = getData
    confirm = getData.filter(e => e.status === "Chờ xác nhận")
    delivery = getData.filter(e => e.status === "Chuẩn bị đơn hàng")
    transport = getData.filter(e => e.status === "Đang vận chuyển")
    viewAllConfirm(confirm)
    viewAllDelivery(delivery)
    viewAllTransport(transport)
  });
  const viewAllConfirm = (data) => {
    let viewConfirm = data.map(e => `<tbody>
          <tr>
              <th scope="col" class="col-0">${e.idTrans}</th>
              <th scope="col" class="col-0">${e.idUser}</th>
              <th scope="col" class="col-0">${e.idProduct}</th>
              <th scope="col" class="col-1">${e.status}</th>
              <th scope="col" class="col-0">${e.countProduct}</th>
              <th scope="col" class="col-1">${e.fullName}</th>
              <th scope="col" class="col-1">${e.phone}</th>
              <th scope="col" class="col-3">${e.address}</th>
              <th scope="col" class="col-2">${e.method}</th>
              <th scope="col" class="col-0">${e.costs}</th>
              <th scope="col" class="col-1"><button class="btn btn-primary" onclick="changeStatusId(${e.idTrans},'Chuẩn bị đơn hàng')">Xác nhận</button></th>
              <th scope="col" class="col-1"><button class="btn btn-danger" onclick="deleteItems(${e.idTrans})">Xóa</button></th>
          </tr>
      </tbody>`).join('')
    document.getElementById("confirm").insertAdjacentHTML('beforeend', viewConfirm);
  }
  const viewAllDelivery = (data) => {
    let viewDelivery = data.map(e => `<tbody>
          <tr>
              <th scope="col" class="col-0">${e.idTrans}</th>
              <th scope="col" class="col-0">${e.idUser}</th>
              <th scope="col" class="col-0">${e.idProduct}</th>
              <th scope="col" class="col-1">${e.status}</th>
              <th scope="col" class="col-0">${e.countProduct}</th>
              <th scope="col" class="col-1">${e.fullName}</th>
              <th scope="col" class="col-1">${e.phone}</th>
              <th scope="col" class="col-3">${e.address}</th>
              <th scope="col" class="col-2">${e.method}</th>
              <th scope="col" class="col-0">${e.costs}</th>
              <th scope="col" class="col-2"><button class="btn btn-primary" onclick="changeStatusId(${e.idTrans},'Đang vận chuyển')">Vận chuyển</button></th>
          </tr>
      </tbody>`).join('')
    document.getElementById("delivery").insertAdjacentHTML('beforeend', viewDelivery);
  } 
  const viewAllTransport = (data) => {
    let viewTransport = data.map(e => `<tbody>
          <tr>
              <th scope="col" class="col-0">${e.idTrans}</th>
              <th scope="col" class="col-0">${e.idUser}</th>
              <th scope="col" class="col-0">${e.idProduct}</th>
              <th scope="col" class="col-1">${e.status}</th>
              <th scope="col" class="col-0">${e.countProduct}</th>
              <th scope="col" class="col-1">${e.fullName}</th>
              <th scope="col" class="col-1">${e.phone}</th>
              <th scope="col" class="col-3">${e.address}</th>
              <th scope="col" class="col-2">${e.method}</th>
              <th scope="col" class="col-0">${e.costs}</th>
              <th scope="col" class="col-1"><button class="btn btn-success" onclick="changeStatusId(${e.idTrans},'Thành công')">Thành công</button></th>
              <th scope="col" class="col-1"><button class="btn btn-danger">Thất bại</button></th>
          </tr>
      </tbody>`).join('')
    document.getElementById("transport").insertAdjacentHTML('beforeend', viewTransport);
  }

    const changeStatusId = (idProduct,statusProduct) => {
      let postData={fname:'id',id:idProduct,status:statusProduct}
      fetch('../api/transport/update',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
      })
      .then(res => res.text())
      location.reload()
      
            
    }
    const deleteItems = (idProduct) => {
      let postData={fname:'delete',id:idProduct}
      fetch('../api/transport/delete',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
      })
      .then(res => res.text())
      location.reload()
    }
    const changeStatusAll = (newStatus,oldStatus) => {
      let postData={fname:'all',newStatus:newStatus,oldStatus:oldStatus}
      fetch('../api/transport/update',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
      })
      .then(res => res.text())
      location.reload()
    }
</script>