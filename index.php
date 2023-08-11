<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TStore</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/public/js/config.Tailwind.js"></script>
    <script src="/public/js/tk.js"></script>
    <script src="/public/js/layoutCardProduct.js"></script>
    <script>let url = <?php echo json_encode(getenv('URL_RF'));?>;</script>
</head>
<body>
    <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'home';
        }
        if($page !== 'contact'){
            include_once 'view/layout/header.php';
        }
        if($page !== 'contact'){
            include_once 'view/layout/headerMobile.php';
        }  
        echo "<div class='container w-screen max-w-full flex flex-col items-center mt-[10%] lg:mt-0 mx-auto'>";
        include_once 'view/layout/loading.php';
        switch ($page) {
            case 'home':
                include_once 'view/pages/home/home.php';
                break;
            case 'product':
                include_once 'view/pages/product/product.php';
                break;
            case 'detail':
                include_once 'view/pages/product/detail.php';
                break;
            case 'search':
                include_once 'view/pages/product/searchResult.php';
                break;
            case 'contact':
                include_once 'view/pages/contact/contact.php';
                break;
            case 'user':
                include_once 'view/pages/user/user.php';
                break;
            case 'cart':
                include_once 'view/pages/user/cart.php';
                break;
            case 'purchase':
                include_once 'view/pages/user/purchase.php';
               break;
            default:
                include_once 'view/pages/error/error.php';
        }
        echo "</div>";
        if($page !== 'contact'){
            include_once 'view/layout/footer.php';
        }
    ?>
</body>
</html>
