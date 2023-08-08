
 <div class="w-50 m-auto p-5 d-flex flex-column " >
      <label class="text-white" for="file">Tải hình ảnh lên từ tệp</label>
      <input class="w-full p-[2%] rounded-[5px] text-white"style="border:none;outline:none;cursor:pointer;" type="file" id="imageFile" name="imageFile"><br>
    
      <label class="text-white" for="url">Tải hình ảnh từ internet</label>
      <input class="w-full p-[2%] rounded-[5px]"style="border:none;outline:none;cursor:pointer;" type="text" id="imageUrl" name="imageUrl"><br>
    
      <label class="text-white" for="name">Tên:</label>
      <input class="w-full p-[2%] rounded-[5px]"style="border:none;outline:none;cursor:pointer;" type="text" id="name" name="name"><br>
      
      <label class="text-white" for="price">Đơn giá (USD):</label>
      <input class="w-full p-[2%] rounded-[5px]"style="border:none;outline:none;cursor:pointer;" type="number" id="price" name="price"><br>

      <label class="text-white" for="des">Mô tả:</label>
      <textarea class="w-full p-[4%] "style="border:none;outline:none;cursor:pointer;resize: none;" id="des" name="des" rows="5" cols="30" required></textarea><br><br>
      
      <label class="text-white" for="date">Ngày nhập:</label>
      <input class="w-full p-[2%] rounded-[5px]"style="border:none;outline:none;cursor:pointer;" type="date" id="date" name="date"><br>
    
      <label class="text-white" for="category">Mã loại:</label>
      <select class="w-full p-[2%] rounded-[5px]"style="border:none;outline:none;cursor:pointer;" id="category" name="category">
    
        <option value="">--Chọn loại--</option>
        <option value="1">LAPTOP</option>
        <option value="2">BÀN PHÍM</option>
        <option value="3">MÀN HÌNH</option>
        <option value="4">RAM</option>
        <option value="5">Ổ CỨNG</option>
        <option value="6">VGA</option>
        <option value="7">CHUỘT</option>
      </select><br><br>
      <button type="button" class="w-2/5 lg:w-1/4 h-[30px] mx-auto bg-blue-500 rounded-[5px] text-white" onclick="add()">Submit</button>
    
 </div>
<script>
    const add = () => {
        let file = document.getElementById("imageFile").files[0];
        let input = document.querySelector('input[type="file"]');
        let url = document.getElementById("imageUrl");
        let getName = document.getElementById("name");
        let getPrice = document.getElementById("price");
        let getDes = document.getElementById("des");
        let getDate = document.querySelector('input[type="date"]');
        let getCategory = document.getElementById("category");
        let isValid = true;

        if(input.files.length === 0 && url.value.length === 0){alert("Vui lòng nhập hình ảnh");isValid = false;}
        if(getName.value.length === 0)
            {
                getName.style.border = "2px solid red";
                getName.insertAdjacentHTML('beforebegin',"<p class='text-danger'>Tên không được để trống</p>");
                isValid = false;
            }
        if(getPrice.value.length === 0)
            {
                getPrice.style.border = "2px solid red";
                getPrice.insertAdjacentHTML('beforebegin',"<p class='text-danger'>Đơn giá không được để trống</p>");
                isValid = false;
            }
        if(getDes.value.length === 0)
            {
                getDes.style.border = "2px solid red";
                getDes.insertAdjacentHTML('beforebegin',"<p class='text-danger'>Mô tả không được để trống</p>");
                isValid = false;
            }
        if(getDate.value.length === 0)
            {
                getDate.style.border = "2px solid red";
                getDate.insertAdjacentHTML('beforebegin',"<p class='text-danger'>Thời gian không được để trống</p>");
                isValid = false;
            }
        if(getCategory.value.length === 0)
            {
                getCategory.style.border = "2px solid red";
                getCategory.insertAdjacentHTML('beforebegin',"<p class='text-danger'>Mã loại không được để trống</p>");
                isValid = false;
            }
        if(getPrice.value < 0)
            {
                getPrice.insertAdjacentHTML("beforebegin","<p class='text-danger'>Đơn giá phải lớn hơn 0</p>");
                isValid = false;
            }
        setTimeout(() => {
            let elements = document.querySelectorAll('p.text-danger');
            elements.forEach(element => {
                element.remove();
            });
        }, 3000);
  
        if(isValid){
            var formData = new FormData();
            formData.append('name', getName.value);
            formData.append('price', getPrice.value);
            formData.append('des', getDes.value);
            formData.append('date', getDate.value);
            formData.append('cate', getCategory.value);
            input.files.length > 0 ? formData.append('imgFile', file) : formData.append('imgUrl', url.value)
            fetch('/api/products/add',{
                method: 'POST',
                body:formData
            }).then(res => {if(res.status === 200 || res.status === 201){
                setTimeout(() => {
                window.location.href="/admin/product";
            }, 0);
            }})
        }

    }
</script>
