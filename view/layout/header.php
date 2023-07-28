<?php
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
    <header class=" hidden lg:flex">
      <div class="search bg-neutral-800">
        <input type="search" id="search" onkeydown="if (event.keyCode == 13) search()"/>
        <div class="iconSearch bg-slate-50" onclick="search()">
          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
          </svg>
        </div>
      </div>
      <script>
      function search() {
        var searchValuePC = document.getElementById("search").value;
        window.location.href = "/search/" + searchValuePC;
      }
    </script>
      <nav class="bg-neutral-800">
        <div class="navBars <?php if ($currentPage == 'home') echo 'active'; ?>" onclick="location.href='/'">
          HOME
        </div>
        <div class="navBars <?php if ($currentPage == 'product') echo 'active'; ?>" onclick="location.href='/product'">
          PRODUCT
        </div>
        <div class="navBars <?php if ($currentPage == 'contact') echo 'active'; ?>" onclick="location.href='/contact'">
          CONTACT
        </div>
      </nav>
      <div class="user">
        <script>
          let name=JSON.parse(localStorage.getItem("name")|| "[]");
          let id=JSON.parse(localStorage.getItem("uS")|| "[]");
          name.length !== 0 ? document.write(`
          <div class="dropMenu ">
          <label for="touch" onclick="clickDropMenu()">
            <span class="bg-neutral-800">
              Hello ${name.map(e => e)}
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                  <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                </svg>
              </span>
            </span>
          </label>               
          <input type="checkbox" id="touch"> 

          <ul class="slide">
            <li onclick="location.href='/user'">User</li> 
            <li onclick="location.href='/cart'">Cart</li>
            <li>Setting</li>
            <li onclick="log()">LogOut</li>
          </ul>
        </div>
          `) : document.write(`<button class="btnLogin" onclick="location.href='/login.php'">Login</button>`);

          const log = () => {
            localStorage.setItem("isLogin" , false)
            localStorage.setItem("name",JSON.stringify([]))
            localStorage.removeItem("uS")
            location.href="/login.php"
          }
          </script>
        
        <script>
          const touch = document.getElementById("touch");
          const spanAfter = document.querySelector(".dropMenu label span span svg ");
          const clickDropMenu = () => {
            if (touch.checked) {
              spanAfter.style.transform = "rotate(45deg)";
            } else {
              spanAfter.style.transform = "rotate(0deg)";
            }
          }
        </script>
      </div>
    </header>
    