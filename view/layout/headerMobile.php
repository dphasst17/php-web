<?php
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<header class="w-screen flex lg:hidden fixed flex justify-around bg-white top-0 m-0 z-50">
    <div class="navIcons min-w-[100px] h-[30px] flex flex-row justify-evenly items-center bg-neutral-800 text-white rounded-[5px]" onclick="dropMenuMob()">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </div>
    <div class="search w-2/5 min-w-[200px] bg-neutral-800">
        <input class="bg-slate-50 pl-[2%]" type="search" id="searchMob" onkeydown="if (event.keyCode == 13) searchMob()"/>
        <div class="iconSearch bg-slate-50" onclick="searchMob()">
          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
          </svg>
        </div>
      </div>
      <script>
      function searchMob() {
        var searchValue = document.querySelector("#searchMob").value;
        window.location.href = "/search/" + searchValue;
      }
    </script>
    <div id="navMobile h-[0px] fixed top-[25px]">
      <nav id="navMob" class="fixed  flex-col justify-around p-0 top-[50px] smr:top-[60px] sm:top-[70px] left-[13px] bg-neutral-800 overflow-hidden py-[2%] z-50" 
      style="display:none;width:0px;height:0px;transition:all .2s linear" >
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-start pl-[2%] z-50 <?php if ($currentPage == 'home') echo 'active font-bold'; ?>" onclick="location.href='/'" style="display:none">
          HOME
        </div>
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-start pl-[2%] z-50 <?php if ($currentPage == 'product') echo 'active font-bold'; ?>" onclick="location.href='/product'" style="display:none">
          PRODUCT
        </div>
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-start pl-[2%] z-50 <?php if ($currentPage == 'user') echo 'active font-bold'; ?>" onclick="location.href='/user'" style="display:none">
          USER
        </div>
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-start pl-[2%] z-50 <?php if ($currentPage == 'cart') echo 'active font-bold'; ?>" onclick="location.href='/cart'" style="display:none">
          CART
        </div>
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-start pl-[2%] z-50 <?php if ($currentPage == 'contact') echo 'active font-bold'; ?>" onclick="location.href='/contact'" style="display:none">
          CONTACT
        </div>
        <div id="navBarsMobile" class="navBars w-4/5 h-[30px] text-[20px] justify-center bg-slate-50 text-black text-[20px] font-bold rounded-[5px] pl-[2%] my-[5%] z-50 cursor-pointer" onclick="logOut()" style="display:none">
          Logout
        </div>
        
      </nav>
      <button id="login" 
      class="fixed w-[100px] justify-center items-center p-0 top-[60px] sm:top-[70px] left-[20px] sm:left-[62px] bg-neutral-800 text-white text-[20px] rounded-[5px] z-50" 
      style="display:none;height:0px; overflow:hidden; transition:height .1s linear"
      onclick="window.location.href= '/login'"
      >Login<button>
    </button>
</header>
<script>
  const checkLogin = localStorage.getItem("isLogin") || false
  const nav = document.querySelector("#navMob");
  const navBars = document.querySelectorAll("#navBarsMobile");
  const btnLogin = document.querySelector("#login");
  if(checkLogin === "true"){
    nav.style.display = "flex";
    btnLogin.style.display = "none";
    navBars.forEach((div) => {
          div.style.display = "none";
        });
  }else{
    nav.style.display = "none";
    btnLogin.style.display = "flex";
  }
  const dropMenuMob = () => {
    if(isLogin === "true"){
      if(nav.style.height === "0px"){
        nav.style.height = "300px"
        nav.style.width = "250px"
        navBars.forEach((div) => {
          if(div.style.display === "none"){
            div.style.display = "flex";
          }
        });
      }else{
        nav.style.height = "0px"
        nav.style.width = "0px"
        navBars.forEach((div) => {
          if(div.style.display === "flex"){
            div.style.display = "none";
          }
        });
      }
    }else{
      if(btnLogin.style.height === "0px"){
        btnLogin.style.height = "40px"
      }else{
        btnLogin.style.height = "0px"
      }
    }
  }
  const logOut = () => {
    localStorage.removeItem("isLogin")
    localStorage.removeItem("name")
    location.href="/login";
    logOutCookie('access')
    logOutCookie('refresh')
  }
</script>
