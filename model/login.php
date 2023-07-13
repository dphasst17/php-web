<?php
    include 'user.php';
    $email = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);
    $result = user_login($email,$password);
?>
<script>
    let checkLogin = <?php echo json_encode($result);?>;
    if(checkLogin.length !== 0) {
        localStorage.setItem("isLogin", true)
        localStorage.setItem("uS",JSON.stringify(checkLogin.flatMap(e => e.idUser)))
        localStorage.setItem("name",JSON.stringify(checkLogin.flatMap(e => e.nameUser)))
        window.location.pathname = "./"
    }
    else{
        window.location.pathname = "./login.php"
    }
    
</script>