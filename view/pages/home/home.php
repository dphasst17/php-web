<?php 
    $css = file_get_contents('view/pages/home/home.css');
    echo "<style>" . $css . "</style>";
    
    include_once 'view/pages/home/slideshow.php';
    include_once 'view/pages/home/newProduct.php';
    include_once 'view/pages/home/product.php';
    include_once 'view/pages/home/typeLaptop.php';
    include_once 'view/pages/home/typeAccess.php';
    include_once 'view/pages/home/blog.php';
?>