<footer class="gradient-bg text-white pt-16 pb-8">
    <div class="footer-container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div>
          <div class="flex items-center mb-6">
            <i class='bx bx-laptop text-3xl text-blue-400 mr-2'></i>
            <span class="text-2xl font-bold">Tech<span class="text-blue-400">Stores</span></span>
          </div>
          <p class="text-gray-300 mb-6">Your trusted source for premium laptops and tech accessories. We provide the best products with exceptional service.</p>
          <div class="flex space-x-4">
            <a href="#" class="bg-slate-800 hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
              <i class='bx bxl-facebook text-xl'></i>
            </a>
            <a href="#" class="bg-slate-800 hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
              <i class='bx bxl-twitter text-xl'></i>
            </a>
            <a href="#" class="bg-slate-800 hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
              <i class='bx bxl-instagram text-xl'></i>
            </a>
            <a href="#" class="bg-slate-800 hover:bg-blue-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
              <i class='bx bxl-youtube text-xl'></i>
            </a>
          </div>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-6">Shop</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-300 hover:text-white transition">All Laptops</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Gaming Laptops</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Business Laptops</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Student Laptops</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">2-in-1 Laptops</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Accessories</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-6">Customer Service</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-300 hover:text-white transition">Contact Us</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">FAQs</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Shipping Policy</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Returns & Refunds</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Warranty Information</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white transition">Order Tracking</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="text-lg font-semibold mb-6">Contact</h4>
          <ul class="space-y-3">
            <li class="flex items-start">
              <i class='bx bx-map text-xl mr-3 text-blue-400 mt-1'></i>
              <span class="text-gray-300">Da Nang, Vietnam</span>
            </li>
            <li class="flex items-center">
              <i class='bx bx-phone text-xl mr-3 text-blue-400'></i>
              <span class="text-gray-300">(123) 456-7890</span>
            </li>
            <li class="flex items-center">
              <i class='bx bx-envelope text-xl mr-3 text-blue-400'></i>
              <span class="text-gray-300">support@techstores.com</span>
            </li>
            <li class="flex items-center">
              <i class='bx bx-time text-xl mr-3 text-blue-400'></i>
              <span class="text-gray-300">Mon-Fri: 9AM-6PM</span>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-gray-700 pt-8 mt-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-400 mb-4 md:mb-0">&copy; 2025 TechStores. All rights reserved.</p>
          <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
            <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
            <a href="#" class="text-gray-400 hover:text-white transition">Sitemap</a>
            <a href="#" class="text-gray-400 hover:text-white transition">Accessibility</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
<!-- Back to Top Button -->
  <a onclick="backToTop()" class="fixed bottom-6 right-6 bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700 transition-colors">
    <i class='bx bx-up-arrow-alt text-2xl'></i>
  </a>

    <script>
        const isLogin = localStorage.getItem("isLogin") || false;
        checkExpCookie(checkRf,url)
        const backToTop = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
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

            }else{window.location.href="/auth"} 
        }
    </script>