<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://accounts.google.com/gsi/client" async></script>
    <!-- <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script> -->
    <title>LOGIN</title>
    <link
      href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css"
      rel="stylesheet"
    />
  </head>
  <body
    class="h-screen overflow-hidden flex items-center justify-center"
    style="background: #edf2f7"
  >
    <div class="bg-blue-400 h-screen w-screen">
      <div
        class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0"
      >
        <div
          class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0"
          style="height: 600px"
        >
          <div class="flex flex-col w-full md:w-1/2 p-4">
            <div class="flex flex-col flex-1 justify-center mb-8">
              <h1 class="text-4xl text-center font-thin">Welcome Back</h1>
              <div class="w-full flex flex-col justify-around" style="height:85%">
                
                  <div class="flex flex-col">
                    <label
                      id="labelUsername"
                      for="username"
                      class="text-sm font-medium leading-none text-gray-80đ mb-[1%]"
                    >
                      Username
                    </label>
                    <input
                      id="username"
                      type="text"
                      type="username"
                      placeholder="Enter your username"
                      class="w-full bg-gray-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3"
                    />
                  </div>
                  <div class="flex flex-col">
                    <label
                      id="labelPassword"
                      for="password"
                      class="text-sm font-medium leading-none text-gray-800"
                    >
                      Password
                    </label>
                    <div class="relative flex items-center justify-center">
                      <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        onkeydown="if (event.keyCode == 13) { validateForm(); }"
                        class="bg-gray-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                      />
                      <div
                        class="absolute right-0 mt-2 mr-3 cursor-pointer"
                        onclick="handleShowHidePass()"
                      >
                      <svg id="showIcon" style="display:block" class="h-6 text-gray-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 576 512">
                      <path fill="currentColor"
                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                      </path>
                    </svg>

                    <svg id="hideIcon" style="display:none" class="h-6 text-gray-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 640 512">
                      <path fill="currentColor"
                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                      </path>
                    </svg>
                      </div>
                    </div>
                  </div>
                  <div class="flex items-center">
                    <input
                      type="checkbox"
                      name="remember"
                      id="remember"
                      class="mr-2"
                    />
                    <label for="remember" class="text-sm text-grey-dark"
                      >Remember Me</label
                    >
                  </div>
                  <div class="flex flex-col">
                    <button
                      type="submit"
                      class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded"
                      onclick="validateForm()"
                    >
                      Login
                    </button>
                  </div>
                
                <div class="text-center">
                  <a
                    class="no-underline hover:underline text-blue-dark text-xs hover:font-semibold transition-all"
                    href="{{ route('password.request') }}"
                  >
                    Forgot Your Password?
                  </a>
                </div>
                
                <div class="w-full flex flex-col items-center justify-center">
                  <div onclick="loginGoogle()" style="background-image: linear-gradient(to left,#DB4437,#F4B400,#0F9D58,#4285F4);" data-onsuccess="onSignIn"
                    class="w-64 google-blue text-gray-100 hover:text-white shadow font-bold text-sm py-1 px-3 rounded flex justify-start items-center cursor-pointer">
                      <svg viewBox="0 0 24 24" class="fill-current mr-3 w-6 h-5" xmlns="http://www.w3.org/2000/svg"><path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"/></svg>
                      <span class="border-l border-blue-500 h-6 w-1 block"></span>
                      <span class="pl-3">Sign up with Google</span>
                  </div>
                  
                  <div class="w-64 bg-gray-900 text-gray-100 hover:text-white shadow font-bold text-sm py-1 px-3 rounded flex justify-start items-center cursor-pointer mt-2">
                      <svg viewBox="0 0 24 24" class="fill-current mr-3 w-6 h-6" xmlns="http://www.w3.org/2000/svg"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                      <span class="border-l border-gray-800 h-6 w-1 block mr-1"></span>
                      <span class="pl-3">Sign up with Github</span>
                  </div>
                  
                  <div onclick="HandleFacebookLogin()" class="w-64 bg-indigo-600 text-gray-100 hover:text-white shadow text-sm font-bold py-1 px-3 rounded flex justify-start items-center cursor-pointer mt-2">
                      <svg viewBox="0 0 24 24" class="fill-current mr-3 w-6 h-6" xmlns="http://www.w3.org/2000/svg"><path d="M23.998 12c0-6.628-5.372-12-11.999-12C5.372 0 0 5.372 0 12c0 5.988 4.388 10.952 10.124 11.852v-8.384H7.078v-3.469h3.046V9.356c0-3.008 1.792-4.669 4.532-4.669 1.313 0 2.686.234 2.686.234v2.953H15.83c-1.49 0-1.955.925-1.955 1.874V12h3.328l-.532 3.469h-2.796v8.384c5.736-.9 10.124-5.864 10.124-11.853z"/></svg>
                      <span class="border-l border-indigo-500 h-6 w-1 block mr-1"></span>
                      <span class="pl-3">Sign up with Facebook</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="hidden md:block md:w-1/2 rounded-r-lg"
            style="
              background: url('https://images.unsplash.com/photo-1515965885361-f1e0095517ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3300&q=80');
              background-size: cover;
              background-position: center center;
            "
          ></div>
        </div>
      </div>
    </div>

  <script>
    let idFB = <?php echo json_encode(getenv('ID_FB'));?>;
    let idGoogle = <?php echo json_encode(getenv('GOOGLE_ID'));?>;
    let postData ={};
    const handleCallBack = (res) => {
      if(res.credential){
        let jwt = res.credential
        let userData = JSON.parse(atob(jwt.split(".")[1]))
        const name = decodeURIComponent(escape(userData.name))
        postData = {name:decodeURIComponent(escape(userData.name)),email:userData.email}
        fetch('/api/login',{method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:JSON.stringify(postData)
        })
        .then(res => {
              if(res.status === 200 || res.status === 201){
                return res.json();
              }else{
                alert("Login false!")
              }
            })
        .then(data => {
            handelSaveData(data.idUser,data.nameUser)
        });
      }
    }
    const loginGoogle = () => {
      google.accounts.id.initialize({
          client_id : idGoogle+'-gig4g2ahetogi4sr2071v1i3d4j1eifu.apps.googleusercontent.com',
          auto_select: true,
          callback:handleCallBack
        })
        google.accounts.id.prompt()
    }

    window.fbAsyncInit = () => {
      FB.init({
        appId: idFB,
        cookie: true,
        xfbml: true,
        version: "v17.0",
      });
    };
    (function (d, s, id) {
      let js,
        fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    })(document, "script", "facebook-jssdk");

    const HandleFacebookLogin = () => {
      FB.login((response) => {
        if (response.authResponse) {
          FB.api("/me", { fields: "name,email" }, (result) => {
            postData = {name:result.name,email:result.email}
            fetch('/api/login',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body:JSON.stringify(postData)
            })
            .then(res => {
              if(res.status === 200 || res.status === 201){
                return res.json();
              }else{
                alert("Login false!")
              }
            })
            .then(data => {
              handelSaveData(data.idUser,data.nameUser)
            });
          });
        } else {
          console.log("error")
        }
      });
      FB.logout()
    };

    const handelSaveData = (id,name) => {
        localStorage.setItem("isLogin", true)
        localStorage.setItem("uS",JSON.stringify([id]))
        localStorage.setItem("name",JSON.stringify(name))
        window.location.href = "/"
    }

    const validateForm = () => {
      let username = document.getElementById("username")?.value;
      let password = document.getElementById("password")?.value;
      let validate = true;
      if (username === "") {
        document.getElementById("username").style.border = "solid 1px red";
        document.getElementById("username").placeholder =
          "Please enter your username";
        validate = false;
      }

      if (password === "") {
        document.getElementById("password").style.border = "solid 1px red";
        document.getElementById("password").placeholder =
          "Please enter your password";
        validate = false;
      }
      if(validate === true ){
        const postData = {username:username,password:password}
        fetch('/api/login',{
          method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:JSON.stringify(postData)
        })
      }
    };
    const handleShowHidePass = () => {
        let idPass = document.getElementById("password");
        if(idPass.type === "password"){
            idPass.type = "text";
            document.getElementById("showIcon").style.display = "none";
            document.getElementById("hideIcon").style.display = "block";
        }else{
            idPass.type = "password";
            document.getElementById("showIcon").style.display = "block";
            document.getElementById("hideIcon").style.display = "none";
        }
    };
  </script>

  </body>
</html>
