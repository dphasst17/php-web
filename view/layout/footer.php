    <script>
        const isLogin = localStorage.getItem("isLogin") || false;
        const addCart = (id,u) => {
            if(isLogin === "true"){
                
                let postData = {fname:'add' , idProduct:id, idUser: u}
                fetch('./api/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(postData)
                    })
                    .then(response => response.text())

            }else{window.location.href="login.php"} 
        }
    </script>