
    <script>
        const addCart = (id,u) => {
            const isLogin = JSON.parse(localStorage.getItem("isLogin") || "[]");
            if(isLogin === true ){
                
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