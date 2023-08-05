    <script>
        const isLogin = localStorage.getItem("isLogin") || false;
        checkExpCookie(checkRf,url)
        
        const addCart = async (id) => {
            let token = await checkExpCookie(checkRf)
            if(isLogin === "true"){
                let postData = {fname:'add' , idProduct:id}
                fetch('/api/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': "Bearer " + token,
                    },
                    body: JSON.stringify(postData)
                    })
                    .then(response => response.text())

            }else{window.location.href="login.php"} 
        }
    </script>