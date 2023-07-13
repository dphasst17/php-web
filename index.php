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
</head>
<body>
    <?php
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'home';
        }
        if($page !== 'contact'){
            include 'view/layout/header.php';
        }   
        echo "<div class='container'>";
        switch ($page) {
            case 'home':
                include 'view/pages/home/home.php';
                break;
            case 'product':
                include 'view/pages/product/product.php';
                break;
            case 'detail':
                include 'view/pages/product/detail.php';
                break;
            case 'search':
                include 'view/pages/product/searchResult.php';
                break;
            case 'contact':
                include 'view/pages/contact/contact.php';
                break;
            case 'user':
                include 'view/pages/user/user.php';
                break;
            case 'cart':
                include 'view/pages/user/cart.php';
                break;
            case 'purchase':
                include 'view/pages/user/purchase.php';
               break;
            default:
                include 'view/pages/error/error.php';
        }
        echo "</div>";
        if($page !== 'contact'){
            include 'view/layout/footer.php';
        }
    ?>
</body>
</html>
