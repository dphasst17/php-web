<div id="default-carousel" class="relative w-full mt-6">
    <!-- Carousel wrapper -->
    <div id="slideShowImages" class="relative w-full h-[200px] sm:h-auto max-h-[500px] overflow-hidden rounded-lg flex items-center">
        <div style="display:block" class="slideShow w-full h-[30vh] md:h-[90vh] duration-700 ease-in-out rounded-lg" >
            <img src="https://dlcdnwebimgs.asus.com/gain/21AE219C-6E24-4FD8-B83D-EFC9E131B315/fwebp" class="w-full h-full object-contain rounded-lg" alt="slideShow">
        </div>
        <div style="display:none" class="slideShow w-full h-[30vh] md:h-[90vh] duration-700 ease-in-out rounded-lg" >
            <img src="https://mspoweruser.com/wp-content/uploads/2019/07/8eecf3b4-f696-49c7-acca-b3d0b9df551e._CR001464600_PT0_SX1464__.jpg" class="w-full h-full object-contain rounded-lg" alt="slideShow">
        </div>
        <div style="display:none" class="slideShow w-full h-[30vh] md:h-[90vh] duration-700 ease-in-out rounded-lg" >
            <img src="https://cdn.shopify.com/s/files/1/0561/8345/5901/files/collabs-homepage-naruto.jpg" class="w-full h-full object-contain rounded-lg" alt="slideShow">
        </div>    
    </div>

    <!-- Slider controls -->
    <button onclick="prevSlide()" type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" >
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-500 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 dark:text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path class="text-white" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button onclick="nextSlide()" type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-500 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 dark:text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path class="text-white" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<script>
    let slides = document.querySelectorAll(".slideShow");
    let currentSlide = 0;
    let interval = setInterval(function() {
      nextSlide();
    }, 2000);

    const nextSlide = () => {
      slides[currentSlide].style.display = "none";
      currentSlide++;
      if (currentSlide >= slides.length) {
        currentSlide = 0;
      }
      slides[currentSlide].style.display = "block";
    }
    const prevSlide = () => {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        slides[currentSlide].style.display = "block";
    }
</script>
