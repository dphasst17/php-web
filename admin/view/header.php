<nav class="navbar navbar-expand-sm navbar-dark bg-dark border border-light">
      <ul class="navbar-nav">
        <li class="nav-item <?php if ($currentPage == 'cate') echo 'active'; ?>">
          <a class="nav-link" href="./cate">Danh mục</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'product') echo 'active'; ?>">
          <a class="nav-link" href="./product">Sản phẩm</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'staff') echo 'active'; ?>">
          <a class="nav-link" href="./staff">Quản lý nhân viên</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'comment') echo 'active'; ?>">
          <a class="nav-link" href="./comment">Quản lý bình luận</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'order') echo 'active'; ?>">
          <a class="nav-link" href="./order">Quản lý đơn hàng</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'ware') echo 'active'; ?>">
          <a class="nav-link" href="./ware">Quản lý kho</a>
        </li>
        <li class="nav-item <?php if ($currentPage == 'statistical') echo 'active'; ?>">
          <a class="nav-link" href="./statistical">Thống kê</a>
        </li>
        <?php
          if(isset($_SESSION["admin"]))
          {
            echo ' <li class="nav-item">
            <a class="nav-link" href="./logout">Logout:'.$_SESSION["admin"].'</a>
          </li>';
          }
           
        ?>
       
    </ul>
</nav>
