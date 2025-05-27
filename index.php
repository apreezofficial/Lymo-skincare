<?php
include 'navbar.php';
?>
<section class="mt-32 px-6 md:px-12 max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-14 md:gap-10">
  <!-- Left: Text -->
  <div class="w-full md:w-1/2 bg-white/30 dark:bg-gray-900/30 backdrop-blur-xl p-8 rounded-2xl border border-white/20 dark:border-gray-700/40 shadow-xl transition-colors duration-500">
    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-tight">
      Nourish Your Skin.  
      <span class="text-pink-500">Glow Naturally.</span>
    </h1>
    <p class="mt-4 text-gray-600 dark:text-gray-300 text-lg">
      Premium skincare products inspired by nature and backed by science. Your skin deserves the best — every single day.
    </p>
    <div class="mt-6 flex flex-wrap gap-4">
      <a href="product.php" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full font-semibold shadow-lg transition duration-300">
        Shop Now
      </a>
      <a href="about.php" class="border border-pink-500 hover:bg-pink-100 dark:hover:bg-pink-900 text-pink-500 px-6 py-3 rounded-full font-semibold transition duration-300">
        Learn More
      </a>
    </div>
  </div>

  <!-- Right: Image( hidden on mobile) -->
<div class="w-full md:w-1/2 hidden md:block">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPz20OI0pSeQRMD1C9HZ2Kcrx5dY2E0rBtx93BVQyQpupaRrtmZrAdWRc&s" alt="Glowing Skin" class="w-full rounded-3xl shadow-xl object-cover" />
</div>
</section>

<section class="mt-24 px-6 md:px-12 max-w-7xl mx-auto text-center">
  <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6" id="loadin">
    Our Products
  </h2>
  <p class="text-gray-600 dark:text-gray-300 mb-12 max-w-xl mx-auto text-lg">
    Explore our most loved skincare products, crafted to rejuvenate, hydrate, and glow up your routine.
  </p>

  <div class="grid gap-10 md:grid-cols-3">
    <?php while ($row = $result->fetch_assoc()): ?>
<a href="product.php?product=<?= urlencode(str_replace(' ', '-', strtolower($row['name']))) ?>" class="relative bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow-lg transition hover:scale-105 duration-300">
    
    <!-- Category Ribbon -->
    <span class="absolute -top-3 -left-3 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-md rotate-[-12deg] shadow-md">
        <?= htmlspecialchars($row['category_name']) ?>
    </span>
    
    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="w-full h-60 object-cover rounded-xl mb-4" />
    <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="loadin"><?= htmlspecialchars($row['name']) ?></h3>
    <p class="text-gray-600 dark:text-gray-400 text-sm mt-2"><?= htmlspecialchars($row['description']) ?></p>
    <span class="block mt-3 text-pink-500 font-bold text-lg">$<?= htmlspecialchars($row['price']) ?></span>
</a>
    <?php endwhile; ?>
  </div>
  <?php echo "<div style='height:40px'></div>" ?>
        <a href="product.php" class="border border-pink-500 hover:bg-pink-100 dark:hover:bg-pink-900 text-pink-500 px-6 py-3 rounded-full font-semibold transition duration-300">
        See All
      </a>
</section>
<?php
$pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-12">
      Shop by <span class="text-pink-500">Category</span>
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($categories as $cat): ?>
        <div class="bg-pink-100 dark:bg-pink-500/10 p-6 rounded-2xl shadow-md hover:scale-105 transition duration-300 cursor-pointer">
          <img src="<?= htmlspecialchars($cat['image']) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-full h-40 object-cover rounded-lg mb-4" />
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="loadin"><?= htmlspecialchars($cat['name']) ?></h3>
          <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">Explore our exclusive <?= htmlspecialchars($cat['name']) ?> collection.</p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="py-20 px-6 bg-white dark:bg-gray-900 transition-colors duration-500">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-10">
      Why Choose <span class="text-pink-500">LYMO.</span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      
      <!-- Feature 1 -->
      <div class="bg-white/40 dark:bg-gray-800/40 p-6 rounded-2xl backdrop-blur-md border border-white/20 dark:border-gray-700 shadow-lg hover:scale-105 transition duration-300">
        <i class="fas fa-leaf text-pink-500 text-3xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2" id="loadin">Skin-Safe Ingredients</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm">
          Every product is formulated with dermatologically tested, gentle, and effective ingredients.
        </p>
      </div>

      <!-- Feature 2 -->
      <div class="bg-white/40 dark:bg-gray-800/40 p-6 rounded-2xl backdrop-blur-md border border-white/20 dark:border-gray-700 shadow-lg hover:scale-105 transition duration-300">
        <i class="fas fa-truck-moving text-pink-500 text-3xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2" id="loadin">Fast Delivery</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm">
          Get your skincare essentials delivered quickly and safely to your doorstep.
        </p>
      </div>

      <!-- Feature 3 -->
      <div class="bg-white/40 dark:bg-gray-800/40 p-6 rounded-2xl backdrop-blur-md border border-white/20 dark:border-gray-700 shadow-lg hover:scale-105 transition duration-300">
        <i class="fas fa-flask text-pink-500 text-3xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2" id="loadin">Dermatologist Approved</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm">
          All our products are approved by top skincare experts to ensure safety and effectiveness.
        </p>
      </div>

    </div>
  </div>
</section>
<section class="py-20 px-6 bg-pink-50 dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-12">
      What Our <span class="text-pink-500">Customers</span> Say
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      
      <!-- Testimonial 1 -->
      <div class="bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow-lg hover:scale-105 transition duration-300">
        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm italic">"LYMO. completely transformed my skincare routine. My skin is glowing and I feel confident every day!"</p>
        <div class="flex items-center gap-4">
          <img src="https://avatars.githubusercontent.com/u/193069706?s=40&v=4" alt="User" class="w-10 h-10 rounded-full object-cover" />
          <div>
            <p class="text-gray-900 dark:text-white font-semibold">Precious Adedokun.</p>
            <span class="text-pink-500 text-xs">Ekiti, Nigeria</span>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow-lg hover:scale-105 transition duration-300">
        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm italic">"Affordable, gentle and fast delivery. I love how fresh my skin feels after every use."</p>
        <div class="flex items-center gap-4">
          <img src="https://i.pravatar.cc/100?img=5" alt="User" class="w-10 h-10 rounded-full object-cover" />
          <div>
            <p class="text-gray-900 dark:text-white font-semibold">Blessing O.</p>
            <span class="text-pink-500 text-xs">Abuja, Nigeria</span>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow-lg hover:scale-105 transition duration-300">
        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm italic">"The best skincare brand I’ve used. 10/10 for packaging, quality, and scent!"</p>
        <div class="flex items-center gap-4">
          <img src="https://i.pravatar.cc/100?img=8" alt="User" class="w-10 h-10 rounded-full object-cover" />
          <div>
            <p class="text-gray-900 dark:text-white font-semibold">Amaka E.</p>
            <span class="text-pink-500 text-xs">Port Harcourt</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include 'footer.php';?>