
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <div class="mainLogin">
        <div class="loopWrapper">
              <div class="mountain"></div>
              <div class="hill"></div>
              <div class="tree"></div>
              <div class="tree"></div>
              <div class="tree"></div>
              <div class="rock"></div>
              <div class="truck"></div>
              <div class="wheels"></div>
        </div>
        
        <form action="./model/login.php" method="POST" onsubmit="return validateForm()">
            <h1>LOGIN</h1>
            <input type="text" name="username" placeholder="enter your username" />
            <input type="password" name="password" placeholder="enter your password" onkeydown="if (event.keyCode == 13) { validateForm(); }" />
            <a href="./forgotpass.php">Forgot password</a>
            <input type="submit" name="dangnhap" value="Đăng nhập" onclick="validateForm()" />
        </form>
        <script>
        function validateForm() {
            var username = document.forms[0]["username"].value;
            var password = document.forms[0]["password"].value;

            if (username == "") {
                alert("Vui lòng nhập tên đăng nhập");
                return false;
            }

            if (password == "") {
                alert("Vui lòng nhập mật khẩu");
                return false;
            }

            return true;
        }
        </script>
    </div>
</body>
</html>