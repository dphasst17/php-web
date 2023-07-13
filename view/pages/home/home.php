<?php 
    $css = file_get_contents('view/pages/home/home.css');
    echo "<style>" . $css . "</style>";
    
    include 'view/pages/home/slideshow.php';
    include 'view/pages/home/newProduct.php';
    include 'view/pages/home/product.php';
    include 'view/pages/home/typeLaptop.php';
    include 'view/pages/home/typeAccess.php';
?>