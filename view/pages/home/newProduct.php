
<h1 class="text-[35px] font-bold">NEW PRODUCT</h1>
<div id="productNew" class="w-full xl:w-4/5 min-h-[300px] h-auto flex flex-wrap justify-around my-[2%] mx-auto"></div>
<script>
    let us = JSON.parse(localStorage.getItem("uS") || "[]");
    let loading = document.getElementById('animationLoading');
    loading.style.display = "flex";
    fetch('/api/products/new')
    .then(res => {
        if (!res.ok) {
            throw new Error(`An error occurred: ${res.status}`);
        }
        return res.json();
    })
    .then(product => {
        loading.style.display = "none";
        layout(product,'productNew',false)
       
    })
    .catch(error => {
        console.log(error);
    });
</script>




