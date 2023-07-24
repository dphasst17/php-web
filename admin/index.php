<?php 
    session_start();
    $currentPage = isset($_GET['page']) ? $_GET['page']: 'cate'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="/public/css/admin.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        ssm: '390px',
                        smr: '550px',
                    },
                }
            }
        }
    </script>
</head>
<body>
<?php
    include_once 'model/config.php';
    include_once './model/user.php';
    echo "<div class='container w-full min-w-full flex flex-col p-[1%] m-auto overflow-x-hidden' >";
            include 'view/header.php';
            $page="cate";
            if(isset($_GET['page']))
                $page=$_GET['page'];
            if(!isset($_SESSION['admin']))
            {
                $page="login";
            }
            echo "<div class='viewAdmin w-full mx-auto overflow-x-hidden'>";
                switch($page)
                {

                    case "login":
                        if(isset($_POST['btn_submit']))
                        {
                            $email=$_POST['username'];
                            $pass=$_POST['password'];
                            if(CheckLogin($email,$pass)==true)
                            {
                                $_SESSION['admin']=$email;
                                echo "<script>localStorage.setItem('idLog',JSON.stringify('".$_SESSION["admin"]."'))</script>";
                                echo "<script>location.href = './cate'</script>";
                                
                            }
                            else
                            {
                                echo "<script>location.href = './login'</script>";
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
