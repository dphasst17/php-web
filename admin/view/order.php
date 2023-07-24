<?php 
  include '../model/transport.php';
  $getData = select_transport();

?>
<h1 class="text-center text-white text-[20px] font-bold">Đơn hàng chờ xác nhận</h1>
<div class="w-[150px] h-[40px] flex items-center justify-center text-[20px] text-white font-semibold rounded-[5px] bg-blue-700 hover:bg-blue-500"  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="changeStatusAll('Chuẩn bị đơn hàng','Chờ xác nhận')">
  Xác nhận tất cả
</div>
<table id="confirm" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-[2%]">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3" >Mã hàng hóa</th>
        <th scope="col" class="hidden smr:table-cell px-6 py-3" >Trạng thái</th>
        <th scope="col" class="px-6 py-3" >Số lượng</th>
        <th scope="col" class="px-6 py-3" >Tên người nhận</th>
        <th scope="col" class="hidden sm:table-cell px-6 py-3" >SDT</th>
        <th scope="col" class="hidden lg:table-cell w-2/5 px-6 py-3" >Địa chỉ</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phương thức thanh toán</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phí vận chuyển</th>
        <th scope="col" class="hidden md:table-cell w-1/5 px-6 py-3" ></th>
        <th  class="block md:hidden w-auto px-6 py-3">More</th>
      </tr>
  </thead>
</table>
<h1 class="text-center text-white text-[20px] font-bold">Đơn hàng đang chuẩn bị</h1>
<div class="w-[150px] h-[40px] flex items-center justify-center text-[20px] text-white font-semibold rounded-[5px] bg-blue-700 hover:bg-blue-500"  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="changeStatusAll('Đang vận chuyển','Chuẩn bị đơn hàng')">
  Vận chuyển tất cả
</div>
<table id="delivery" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-[4%]">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3" >Mã hàng hóa</th>
        <th scope="col" class="hidden smr:table-cell px-6 py-3" >Trạng thái</th>
        <th scope="col" class="px-6 py-3" >Số lượng</th>
        <th scope="col" class="px-6 py-3" >Tên người nhận</th>
        <th scope="col" class="hidden sm:table-cell px-6 py-3" >SDT</th>
        <th scope="col" class="hidden lg:table-cell w-2/5 px-6 py-3" >Địa chỉ</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phương thức thanh toán</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phí vận chuyển</th>
        <th scope="col" class="hidden md:table-cell w-[10%] px-6 py-3" >Vận chuyển</th>
        <th  class="block md:hidden w-auto px-6 py-3">More</th>
      </tr>
  </thead>
</table>

<h1 class="text-center text-white text-[20px] font-bold mb-[2%]">Đơn hàng đang vận chuyển</h1>
<table id="transport" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-[2%]">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3" >Mã hàng hóa</th>
        <th scope="col" class="hidden smr:table-cell px-6 py-3" >Trạng thái</th>
        <th scope="col" class="px-6 py-3" >Số lượng</th>
        <th scope="col" class="px-6 py-3" >Tên người nhận</th>
        <th scope="col" class="hidden sm:table-cell px-6 py-3" >SDT</th>
        <th scope="col" class="hidden lg:table-cell w-2/5 px-6 py-3" >Địa chỉ</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phương thức thanh toán</th>
        <th scope="col" class="hidden lg:table-cell px-6 py-3" >Phí vận chuyển</th>
        <th scope="col" class="hidden md:table-cell w-1/4 px-6 py-3" ></th>
        <th  class="block md:hidden w-auto px-6 py-3">More</th>
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
          <tr class="bg-slate-800 ">
              <th scope="col" class="px-6 py-3">${e.idProduct}</th>
              <th scope="col" class="hidden smr:table-cell px-6 py-3">${e.status}</th>
              <th scope="col" class="px-6 py-3">${e.countProduct}</th>
              <th scope="col" class="px-6 py-3">${e.fullName}</th>
              <th scope="col" class="hidden sm:table-cell px-6 py-3">${e.phone}</th>
              <th scope="col" class="hidden lg:table-cell lg:w-3/5 px-6 py-3">${e.address}</th>
              <th scope="col" class="hidden lg:table-cell px-6 py-3">${e.method}</th>
              <th scope="col" class="hidden md:table-cell px-6 py-3">${e.costs}</th>
              <th scope="col" class="hidden md:flex w-full flex items-center justify-around px-6 py-3">
                <button class="w-2/5 h-[40px] rounded-[5px] bg-[#14a44d] text-white" onclick="changeStatusId(${e.idTrans},'Chuẩn bị đơn hàng')">Xác nhận</button>
                <button class="w-2/5 h-[40px] rounded-[5px] bg-[#d42a46] text-white" onclick="deleteItems(${e.idTrans})">Xóa</button>
              </th>
              <th class="block md:hidden m-auto flex justify-center items-center px-6 py-4">
                  <svg class="w-5 h-5 text-white hover:text-blue-500 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                      <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                  </svg>
              </th>
             
          </tr>
      </tbody>`).join('')
    document.getElementById("confirm").insertAdjacentHTML('beforeend', viewConfirm);
  }
  const viewAllDelivery = (data) => {
    let viewDelivery = data.map(e => `<tbody>
          <tr class="bg-slate-800 ">
              <th scope="col" class="px-6 py-3">${e.idProduct}</th>
              <th scope="col" class="hidden smr:table-cell px-6 py-3">${e.status}</th>
              <th scope="col" class="px-6 py-3">${e.countProduct}</th>
              <th scope="col" class="px-6 py-3">${e.fullName}</th>
              <th scope="col" class="hidden sm:table-cell px-6 py-3">${e.phone}</th>
              <th scope="col" class="hidden lg:table-cell w-2/5 px-6 py-3">${e.address}</th>
              <th scope="col" class="hidden lg:table-cell px-6 py-3">${e.method}</th>
              <th scope="col" class="hidden md:table-cell px-6 py-3">${e.costs}</th>
              <th scope="col" class="hidden md:table-cell w-[10%] px-6 py-3">
                <button class="w-full h-[40px] bg-[#3568bb] text-white rounded-[5px]" onclick="changeStatusId(${e.idTrans},'Đang vận chuyển')">
                  Vận chuyển
                </button>
              </th>
              <th class="block md:hidden m-auto flex justify-center items-center px-6 py-4">
                  <svg class="w-5 h-5 text-white hover:text-blue-500 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                      <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                  </svg>
              </th>
          </tr>
      </tbody>`).join('')
    document.getElementById("delivery").insertAdjacentHTML('beforeend', viewDelivery);
  } 
  const viewAllTransport = (data) => {
    let viewTransport = data.map(e => `<tbody>
          <tr class="bg-slate-800 ">
              <th scope="col" class="px-6 py-3">${e.idProduct}</th>
              <th scope="col" class="hidden smr:table-cell px-6 py-3">${e.status}</th>
              <th scope="col" class="px-6 py-3">${e.countProduct}</th>
              <th scope="col" class="px-6 py-3">${e.fullName}</th>
              <th scope="col" class="hidden sm:table-cell px-6 py-3">${e.phone}</th>
              <th scope="col" class="hidden lg:table-cell w-2/5 lg:w-3/5 px-6 py-3">${e.address}</th>
              <th scope="col" class="hidden lg:table-cell px-6 py-3">${e.method}</th>
              <th scope="col" class="hidden lg:table-cell px-6 py-3">${e.costs}</th>
              <th scope="col" class="hidden md:flex w-full  items-center justify-around px-6 py-3">
                <button class="w-2/5 h-[40px] flex justify-center items-center bg-[#14a44d] text-white rounded-[5px]" onclick="changeStatusId(${e.idTrans},'Thành công')">Thành công</button>
                <button class="w-2/5 h-[40px] flex justify-center items-center bg-[#d42a46] text-white rounded-[5px]">Thất bại</button>
              </th>
              <th class="block md:hidden m-auto flex justify-center items-center px-6 py-4">
                  <svg class="w-5 h-5 text-white hover:text-blue-500 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                      <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                  </svg>
              </th>
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