<?php 
    session_start();
    $currentPage = isset($_GET['act']) ? $_GET['act'] : 'cate';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/admin.css">
</head>
<body>
    
    <?php
    include_once 'model/config.php';
    include_once 'model/user.php';
    echo "<div class='container' style='width:100%;max-width:100%;padding: 0; margin:0'>";
        include 'view/header.php';
            $action="cate";
            if(isset($_GET['act']))
                $action=$_GET['act'];
            if(!isset($_SESSION['admin']))
            {
                $action="login";
            }
            echo "<div class='viewAdmin'>";
                switch($action)
                {

                    case "login":
                        if(isset($_POST['btn_submit']))
                        {
                            $email=$_POST['username'];
                            $pass=$_POST['password'];
                            if(CheckLogin($email,$pass)==true)
                            {
                                $_SESSION['admin']=$email;
                                echo "<script>location.href = './cate'</script>";
                            }
                            else
                            {
                                include './view/login.php';
                            }
                        }
                        else
                        {
                            include './view/login.php';
                        }
                        break;
                    case "logout":
                        unset($_SESSION['admin']);
                        echo "<script>location.href = './login'</script>";
                        break;
                    case "cate":
                        include './view/catalog.php';
                        break;
                    case "product":
                        include './view/product.php';
                        break;
                    case "new":
                        include './view/addnew.php';
                        break;
                    case "edit":
                        include './view/edit.php';
                        break;
                    case "staff":
                        include './view/staff.php';
                        break;
                    case "comment":
                        include './view/comment.php';
                        break;
                    case "statistical":
                        include './view/statistical.php';
                        break;
                    case "order":
                        include './view/order.php';
                        break;
                    case "ware":
                        include './view/ware.php';
                        break;
                }
            echo "</div>";
    echo "</div>";
    ?>
</body>
</html>
