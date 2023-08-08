<header class="w-1/5 h-[70px] z-50 <?php if (isset($_SESSION["admin"])){echo 'flex flex-col';}else{echo 'hidden';}?>">
  <?php
            if(isset($_SESSION["admin"]))
            {
              echo '
              <div class="w-[276px] h-[50px] fixed rounded-[5px] bg-neutral-800 cursor-pointer" id="tabAdmin">
                
              </div>
            ';
            }
  ?>
  <nav id="navBar" style="width:0px;height:0vh;transition:all .1s linear; overflow:hidden;" class="fixed flex justify-center top-[90px] pt-[2%] bg-neutral-800 rounded-[5px] transition-all" style="display:none;">
        <ul class="w-[90%] h-full flex flex-col">
        <li onclick="window.location.href = './cate'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'cate' ) echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./cate">Danh mục</a>
          </li>
          <li onclick="window.location.href = './product'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'product') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./product">Sản phẩm</a>
          </li>
          <li onclick="window.location.href = './staff'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'staff') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./staff">Quản lý nhân viên</a>
          </li>
          <li onclick="window.location.href = './comment'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'comment') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./comment">Quản lý bình luận</a>
          </li>
          <li onclick="window.location.href = './order'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'order') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./order">Quản lý đơn hàng</a>
          </li>
          <li onclick="window.location.href = './ware'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'ware') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./ware">Quản lý kho</a>
          </li>
          <li onclick="window.location.href = './statistical'" class="nav-item w-full h-[30px] flex items-center pl-[2%] <?php if ($currentPage == 'statistical') echo 'active h-[50px] flex justify-center items-center text-white text-[25px] font-bold rounded-[5px] bg-sky-500 transition-all'; ?>mb-[2%] text-white text-[15px] font-semibold mb-[5%] cursor-pointer hover:rounded-[5px] hover:bg-sky-500 hover:text-white transition-all">
            <a class="nav-link text-white" href="./statistical">Thống kê</a>
          </li>
          <?php
            if(isset($_SESSION["admin"]))
            {
              echo ' 
              <button class="w-[150px] h-[50px] bg-sky-900 hover:bg-sky-700 transition-all outline-none border-none rounded-[5px] text-white hover:text-blue-950" onclick="logout()"">Logout</button>
            ';
            }
          ?>
         <script>
          let dataLocal = JSON.parse(sessionStorage.getItem("idLog"));
          fetch(`/api/user/info/${dataLocal}`)
            .then(res => {return res.json()})
            .then(data => ViewTabAdmin([data]))
          const logout = () => {
            window.location.href = './logout'
            sessionStorage.removeItem("idLog");
          }
          const ViewTabAdmin = (e) => {
            let viewTab = e.map(e => `<div class="w-full h-full flex items-center">
              <div onclick="dropMenu()" id="btnDropMenu" class="dropMenu w-1/5 h-full flex justify-center items-center">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
              </div>
              
              <div class="avatar w-[20%] h-full flex items-center pl-[2%]"><img class="w-[40px] h-[40px] rounded-[50%] border-solid border-white border-[1px]" src=${(e.img !=="") ? (e.img?.includes('https://') ? e.img :`../public/images/uploads/${e.img}`) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png'} alt="Avatar"/></div>
              <div class="name w-1/2 h-full flex justify-center items-center text-white text-[20px] font-bold">${e.nameUser}</div>
            </div>`)
            document.getElementById('tabAdmin').innerHTML = viewTab.join('');
          }
          const nav = document.querySelector("nav");
          const dropMenu = () => {
            if(nav.style.width === "0px"){
              nav.style.width = "276px";
              nav.style.height = "60vh";
            }else{
              nav.style.width = "0px";
              nav.style.height = "0vh";
            }
          }
         </script>
      </ul>
  </nav>
</header>
