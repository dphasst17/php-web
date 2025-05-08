
<h1 class="text-[35px] font-bold">NEW PRODUCT</h1>
<div class="w-full xl:w-4/5 min-h-[300px] h-auto my-[2%] flex items-center justify-center mx-auto">
    <div id="productNew" class="w-[90%] min-h-[300px] h-auto grid grid-cols-1 ssm:grid-cols-2 sm:grid-cols-4 gap-6 px-2"></div>
</div>
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




