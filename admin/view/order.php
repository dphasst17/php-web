<h1 class="text-center text-white text-[20px] font-bold">Đơn hàng chờ xác nhận</h1>
<div class="w-[150px] h-[40px] flex items-center justify-center text-[20px] text-white font-semibold rounded-[5px] bg-blue-700 hover:bg-blue-500"  style="width:200px;cursor:pointer;margin: 0 0 2% 0;" onclick="changeStatusAll('Chuẩn bị đơn hàng','Chờ xác nhận')">
  Xác nhận tất cả
</div>
<table id="confirm" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-[2%]">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="w-[8%] px-2 py-3" >Mã hàng hóa</th>
        <th class="hidden smr:table-cell py-3" >Trạng thái</th>
        <th class="w-[5%] px-2 py-3" >Số lượng</th>
        <th class="w-[10%] py-3" >Tên người nhận</th>
        <th class="hidden md:table-cell py-3" >SDT</th>
        <th class="hidden lg:table-cell w-2/5 py-3" >Địa chỉ</th>
        <th class="hidden lg:table-cell py-3" >Phương thức thanh toán</th>
        <th class="hidden lg:table-cell py-3" >Phí vận chuyển</th>
        <th class="w-1/5 py-3" ></th>
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
        <th class="w-[8%] px-2 py-3" >Mã hàng hóa</th>
        <th class="hidden smr:table-cell py-3" >Trạng thái</th>
        <th class="w-[5%] px-2 py-3" >Số lượng</th>
        <th class="w-[10%] py-3" >Tên người nhận</th>
        <th class="hidden md:table-cell py-3" >SDT</th>
        <th class="hidden lg:table-cell w-2/5 py-3" >Địa chỉ</th>
        <th class="hidden lg:table-cell py-3" >Phương thức thanh toán</th>
        <th class="hidden lg:table-cell py-3" >Phí vận chuyển</th>
        <th class=" w-[10%] py-3 text-center" >Vận chuyển</th>
      </tr>
  </thead>
</table>

<h1 class="text-center text-white text-[20px] font-bold mb-[2%]">Đơn hàng đang vận chuyển</h1>
<table id="transport" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-[2%]">
  <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="w-[8%] px-2 py-3" >Mã hàng hóa</th>
        <th class="hidden smr:table-cell py-3" >Trạng thái</th>
        <th class="w-[5%] px-2 py-3" >Số lượng</th>
        <th class="w-[10%] py-3" >Tên người nhận</th>
        <th class="hidden md:table-cell py-3" >SDT</th>
        <th class="hidden lg:table-cell w-2/5 py-3" >Địa chỉ</th>
        <th class="hidden lg:table-cell py-3" >Phương thức thanh toán</th>
        <th class="hidden lg:table-cell py-3" >Phí vận chuyển</th>
        <th class="w-1/4 py-3" ></th>
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
          <tr id="${e.idTrans}" class="bg-slate-800 ">
              <th class="py-3 text-center">${e.idProduct}</th>
              <th class="hidden smr:table-cell py-3 ">${e.status}</th>
              <th class="w-[5%] py-3 text-center">${e.countProduct}</th>
              <th class="py-3 ">${e.fullName}</th>
              <th class="hidden md:table-cell py-3 ">${e.phone}</th>
              <th class="hidden lg:table-cell lg:w-3/5 p-3 ">${e.address}</th>
              <th class="hidden lg:table-cell py-3 ">${e.method}</th>
              <th class="hidden lg:table-cell py-3 ">${e.costs}</th>
              <th class="flex w-full flex items-center justify-around py-3 ">
                <button class="w-2/5 h-[40px] rounded-[5px] bg-[#14a44d] text-white" onclick="changeStatusId(${e.idTrans},'Chuẩn bị đơn hàng')">Xác nhận</button>
                <button class="w-2/5 h-[40px] rounded-[5px] bg-[#d42a46] text-white" onclick="deleteItems(${e.idTrans})">Xóa</button>
              </th>
          </tr>
      </tbody>`).join('')
    document.getElementById("confirm").insertAdjacentHTML('beforeend', viewConfirm);
  }
  const viewAllDelivery = (data) => {
    let viewDelivery = data.map(e => `<tbody>
          <tr class="bg-slate-800 ">
              <th class="py-3 text-center">${e.idProduct}</th>
              <th class="hidden smr:table-cell py-3 ">${e.status}</th>
              <th class="w-[5%] py-3 text-center">${e.countProduct}</th>
              <th class="py-3 ">${e.fullName}</th>
              <th class="hidden md:table-cell py-3 ">${e.phone}</th>
              <th class="hidden lg:table-cell w-2/5 p-3 ">${e.address}</th>
              <th class="hidden lg:table-cell py-3 ">${e.method}</th>
              <th class="hidden lg:table-cell py-3 ">${e.costs}</th>
              <th class=" w-[10%] p-3 ">
                <button class="w-full h-[40px] bg-[#3568bb] text-white rounded-[5px]" onclick="changeStatusId(${e.idTrans},'Đang vận chuyển')">
                  Vận chuyển
                </button>
              </th>
              
          </tr>
      </tbody>`).join('')
    document.getElementById("delivery").insertAdjacentHTML('beforeend', viewDelivery);
  } 
  const viewAllTransport = (data) => {
    let viewTransport = data.map(e => `<tbody>
          <tr class="bg-slate-800 ">
              <th class="py-3 text-center">${e.idProduct}</th>
              <th class="hidden smr:table-cell py-3 ">${e.status}</th>
              <th class="w-[5%] py-3 text-center">${e.countProduct}</th>
              <th class="py-3 ">${e.fullName}</th>
              <th class="hidden md:table-cell py-3 ">${e.phone}</th>
              <th class="hidden lg:table-cell w-2/5 p-3 ">${e.address}</th>
              <th class="hidden lg:table-cell py-3 ">${e.method}</th>
              <th class="hidden lg:table-cell py-3 ">${e.costs}</th>
              <th class="flex w-full  items-center justify-around py-3 ">
                <button class="w-2/5 h-[40px] flex justify-center items-center bg-[#14a44d] text-white rounded-[5px]" onclick="changeStatusId(${e.idTrans},'Thành công')">Thành công</button>
                <button class="w-2/5 h-[40px] flex justify-center items-center bg-[#d42a46] text-white rounded-[5px]">Thất bại</button>
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
      .then(res => {if(res.status === 200){
        let element = document.getElementById(`${idProduct}`);
            element.parentNode.removeChild(element);
      }})
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