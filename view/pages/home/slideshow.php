<?php 
    /* $css = file_get_contents('view/content/home/home.css');
    echo "<style>" . $css . "</style>"; */
?>

<div class="slideshow-container">
    <div class="buttonSlide">
        <div class="prev" onclick="changeSlide(-1)">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </div>
    </div>
    <div class="slideShowImages" id="slideShowImages"></div>
    <div class="buttonSlide">
        <div class="next" onclick="changeSlide(1)">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
            </svg>
        </div>
    </div>
</div>

<script>
    
    let images = [
        "https://cdn.tgdd.vn/Files/2021/12/20/1405435/laptopgamingdohoah22_1280x720-800-resize.jpg",
        "https://vitinhdongquan.com/vnt_upload/weblink/slide1.jpg",
        "https://topbinhduong.com/wp-content/uploads/2022/06/laptop-binh-duong-1-min.png"
        ];
    let currentSlide = 0;

    // Hàm hiển thị slide hiện tại
    function showSlide() {
        let slideShowImages = document.getElementById("slideShowImages");
        slideShowImages.innerHTML = "<img class='slide-image' src='" + images[currentSlide] + "'alt='slideShow'>";
    }

    // Hàm thay đổi slide
    function changeSlide(n) {
        currentSlide += n;
        if (currentSlide < 0) currentSlide = images.length - 1;
        if (currentSlide >= images.length) currentSlide = 0;
        showSlide();
    }
    function autoSlide(){
        changeSlide(1)
    }
    // Hiển thị slide đầu tiên khi trang được tải
    showSlide();

    setInterval(autoSlide, 4000);
</script>
