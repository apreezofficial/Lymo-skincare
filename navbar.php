<!DOCTYPE html>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="/tailwind.js"></script>
<script>
            tailwind.config = {
                darkMode: 'class',
            };
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
          html {
  scroll-behavior: smooth;
}
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scaleIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}
#preloader {
  transition: opacity 0.5s ease;
}

.animate-fade-in-up.delay-200 {
  animation-delay: 0.2s;
}

.animate-fade-in-up.delay-300 {
  animation-delay: 0.3s;
}

.animate-fade-in-up.delay-500 {
  animation-delay: 0.5s;
}

.animate-scale-in {
  animation: scaleIn 0.8s ease-out forwards;
}
        </style>
<?php
// db.php - your database connection
//replace with yours abeg
$host = '0.0.0.0';
$username = 'root';
$password ='root';
$db ='baby';
$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT products.*, categories.name AS category_name 
          FROM products 
          LEFT JOIN categories ON products.category_id = categories.id LIMIT 6";
$result = mysqli_query($conn, $query);
?>
<meta name="theme-color" content="pink">
    <!-- Bootstrap Icons CDN -->
    <link href="bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="./font-awesome/css/all.css">
    <div id="preloader" class="fixed inset-0 z-50 bg-white dark:bg-gray-950 flex items-center justify-center transition-colors duration-500">
  <div class="animate-spin rounded-full h-20 w-20 border-t-4 border-pink-500 border-opacity-50"></div>
</div>
<script>
  window.addEventListener('load', function () {
    const loader = document.getElementById('preloader');
    loader.classList.add('opacity-0');
    setTimeout(() => loader.style.display = 'none', 500);
  });
</script>
<body class="bg-[#FDFCFB] dark:bg-[#0F0F0F] transition-colors duration-500">
  <nav 
    id="navbar"
    class="fixed top-[30px] left-1/2 transform -translate-x-1/2 w-[90vw] max-w-6xl
           dotted-bg 
           bg-white/30 dark:bg-gray-900/40 
           backdrop-blur-md
           border border-gray-300/50 dark:border-gray-700/50
           shadow-lg
           flex items-center justify-between px-6 py-3
           z-50
           transition-colors duration-500
           rounded-xl"
  >
    <!-- Logo -->
    <a href="index.php" class="text-2xl font-extrabold text-[#3A3A3A] dark:text-white flex items-center gap-2">
      <i class="bi bi-droplet-half"></i> LYMOcare.
    </a>

    <!-- Desktop Nav Links -->
    <ul class="hidden md:flex gap-8 text-[#4A4A4A] dark:text-gray-300 font-semibold absolute left-1/2 transform -translate-x-1/2">
      <li><a href="index.php" class="hover:text-pink-500 dark:hover:text-pink-400 transition">Home</a></li>
      <li><a href="product.php" class="hover:text-pink-500 dark:hover:text-pink-400 transition">Collections</a></li>
      <li><a href="about.php" class="hover:text-pink-500 dark:hover:text-pink-400 transition">About</a></li>
      <li><a href="blog.php" class="hover:text-pink-500 dark:hover:text-pink-400 transition">Blog</a></li>
<li>
  <a href="cart.php" 
     class="hover:text-pink-500 dark:hover:text-pink-400 transition <?= basename($_SERVER['PHP_SELF']) === 'cart.php' ? 'text-pink-500 dark:text-pink-400 font-semibold' : '' ?>">
    Cart
  </a>
</li>
    </ul>

    <!-- Theme Toggle -->
    <div class="relative w-full h-12">
      <button id="themeToggle" aria-label="Toggle Dark Mode" class="absolute right-4 top-2 text-[#4A4A4A] dark:text-gray-200 hover:text-pink-500 dark:hover:text-pink-400 transition text-xl">
        <i id="themeIcon" class="bi bi-moon-fill"></i>
      </button>
    </div>

    <!-- Mobile Hamburger -->

  </nav>

  <!-- Mobile Nav - Horizontal Icons -->
  <div id="mobileMenu" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-[90vw] max-w-md
              bg-white/90 dark:bg-gray-900/90
              backdrop-blur-md
              border border-gray-300/30 dark:border-gray-700/30
              rounded-full
              shadow-lg
              p-3
              flex justify-around items-center
              md:hidden
              z-40">
    
<a href="index.php" 
   class="text-center text-sm transition 
          <?= basename($_SERVER['PHP_SELF']) === 'index.php' 
               ? 'text-pink-500 dark:text-pink-400 font-semibold' 
               : 'text-[#3A3A3A] dark:text-white hover:text-pink-500 dark:hover:text-pink-400' ?>">
  <i class="bi bi-house-door-fill text-xl block"></i>Home
</a>
<a href="product.php" 
   class="text-center text-sm transition 
          <?= basename($_SERVER['PHP_SELF']) === 'product.php' 
               ? 'text-pink-500 dark:text-pink-400 font-semibold' 
               : 'text-[#3A3A3A] dark:text-white hover:text-pink-500 dark:hover:text-pink-400' ?>">
  <i class="bi bi-box-seam text-xl block"></i>Collections
</a>
    <a href="about.php" class="text-center text-sm transition 
          <?= basename($_SERVER['PHP_SELF']) === 'about.php' 
               ? 'text-pink-500 dark:text-pink-400 font-semibold' 
               : 'text-[#3A3A3A] dark:text-white hover:text-pink-500 dark:hover:text-pink-400' ?>">
      <i class="bi bi-info-circle-fill text-xl block"></i>About
    </a>
<a href="blog.php" class="text-center text-sm transition
 <?= in_array(basename($_SERVER['PHP_SELF']), ['blog.php', 'blog-single.php']) ? 'text-pink-500 dark:text-pink-400 font-semibold' 
      : 'text-[#3A3A3A] dark:text-white hover:text-pink-500 dark:hover:text-pink-400' ?>">
  <i class="bi bi-journals text-xl block"></i>Blog
</a>
<a href="cart.php" 
   class="relative inline-block text-center text-sm transition 
          <?= basename($_SERVER['PHP_SELF']) === 'cart.php' 
               ? 'text-pink-500 dark:text-pink-400 font-semibold' 
               : 'text-[#3A3A3A] dark:text-white hover:text-pink-500 dark:hover:text-pink-400' ?>">
  <i class="bi bi-bag-fill text-xl block"></i>
  Cart
  <!-- Badge -->
  <span id="cartCountBadge"
        class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full shadow-md hidden">
    0
  </span>
</a>
  </div>
</body>
<script>
  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const count = cart.length;
    const badge = document.getElementById('cartCountBadge');

    if (badge) {
      if (count > 0) {
        badge.textContent = count;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
    }
  }

  // Call the update for yhe cart eevery 1 second
  setInterval(updateCartCount, 100);
</script>
    <style>
        /* Dotted border background pattern */
        /* you can use tailwind class btwn but I'm atill learming tailwind */
        .dotted-bg {
            background-image: radial-gradient(currentColor 1px, transparent 1px);
            background-size: 10px 10px;
            border: 1.5px dotted;
            border-radius: 12px;
        }
        #loadin {
  opacity: 0;
  transition: opacity 0.4s ease-in-out;
}
#loadin.visible {
  opacity: 1;
}
    </style>

<script>
    // Dark/Light Mode Toggle Logic
    const themeToggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;

    // Load theme from localStorage or system preference
    //initially na system prefrence
    const storedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
        htmlElement.classList.add('dark');
        themeIcon.className = 'bi bi-sun-fill';
    } else {
        htmlElement.classList.remove('dark');
        themeIcon.className = 'bi bi-moon-fill';
    }

    themeToggleBtn.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            themeIcon.className = 'bi bi-moon-fill';
            localStorage.setItem('theme', 'light');
        } else {
            htmlElement.classList.add('dark');
            themeIcon.className = 'bi bi-sun-fill';
            localStorage.setItem('theme', 'dark');
        }
    });

    // Mobile Menu Toggle
    const menuToggleBtn = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    menuToggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</html>
