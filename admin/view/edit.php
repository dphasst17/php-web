<?php
    include_once '../model/product.php';
    $id = $_GET['id'];
    $getProduct = product_select_by_id($id);
?>

<div class="w-50 m-auto p-5 d-flex flex-column " >
      <label class="text-light" for="file">Tải hình ảnh lên từ tệp</label>
      <input class="w-100 p-2 rounded text-light"style="border:none;outline:none;cursor:pointer;" type="file" id="imageFile" name="imageFile"><br>
    
      <label class="text-light" for="url">Tải hình ảnh từ internet</label>
      <input value='<?php echo $getProduct['imgProduct']; ?>' class="w-100 p-2 rounded"style="border:none;outline:none;cursor:pointer;" type="text" id="imageUrl" name="imageUrl"><br>
    
      <label class="text-light" for="name">Tên:</label>
      <input value='<?php echo $getProduct['nameProduct']; ?>' class="w-100 p-2 rounded"style="border:none;outline:none;cursor:pointer;" type="text" id="name" name="name"><br>
      
      <label class="text-light" for="price">Đơn giá (USD):</label>
      <input value='<?php echo $getProduct['price']; ?>' class="w-100 p-2 rounded"style="border:none;outline:none;cursor:pointer;" type="number" id="price" name="price"><br>

      <label class="text-light" for="des">Mô tả:</label>
      <textarea  class="w-100 p-4 "style="border:none;outline:none;cursor:pointer;resize: none;" id="des" name="des" rows="5" cols="30" required><?php echo $getProduct['des']; ?></textarea><br><br>
      
      <label class="text-light" for="date">Ngày nhập:</label>
      <input value='<?php echo $getProduct['dateAdded']; ?>' class="w-100 p-2 rounded"style="border:none;outline:none;cursor:pointer;" type="date" id="date" name="date"><br>
    
      <label class="text-light" for="category">Mã loại:</label>
      <select class="w-100 p-2 rounded"style="border:none;outline:none;cursor:pointer;" id="category" name="category">
    
        <option value="">--Chọn loại--</option>
        <option value="1">LAPTOP</option>
        <option value="2">BÀN PHÍM</option>
        <option value="3">MÀN HÌNH</option>
        <option value="4">RAM</option>
        <option value="5">Ổ CỨNG</option>
        <option value="6">VGA</option>
        <option value="7">CHUỘT</option>
      </select><br><br>
      <button type="button" class="w-25 m-auto btn btn-primary" onclick="add()">Submit</button>
    
 </div>
 <script>
    let id = <?php echo $id;?>;
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
                formData.append('fname','update')
                formData.append('name', getName.value);
                formData.append('price', getPrice.value);
                formData.append('des', getDes.value);
                formData.append('date', getDate.value);
                formData.append('cate', getCategory.value);
                formData.append('id', id);
                input.files.length > 0 ? formData.append('imgFile', file) : formData.append('imgUrl', url.value);
                fetch('/api/products/image', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(response => {
                    if (response == 1) {
                        console.log("Upload successfully.");
                    } else {
                        console.log("File not uploaded.");
                    }
                })
                .catch(error => console.error('Error:', error));
                setTimeout(() => {
                    window.location.href="/admin/product";
                }, 300);
            }

        
        
    }
</script>
