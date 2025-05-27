        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-3xl mx-auto text-center bg-white/30 dark:bg-gray-900/30 backdrop-blur-md border border-white/20 dark:border-gray-800 rounded-2xl p-10 shadow-lg">
    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
      Stay Radiant, Stay Updated
    </h2>
    <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 mb-8">
      Subscribe to receive skincare tips, exclusive deals, and product updates directly to your inbox.
    </p>
<form id="subscribeForm" class="flex flex-col sm:flex-row items-center gap-4">
  <input
    type="email"
    name="email"
    id="email"
    required
    placeholder="Enter your email"
    class="px-5 py-3 w-full sm:w-auto flex-1 rounded-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-pink-500 outline-none transition"
  />
  <button
    type="submit"
    class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-medium rounded-full shadow transition"
  >
    Subscribe
  </button>
</form>

<div id="subscribeMessage" class="mt-4 text-sm font-medium text-center"></div>
  </div>
</section>
<script>
  $(document).ready(function () {
    $('#subscribeForm').submit(function (e) {
      e.preventDefault();

      const email = $('#email').val();
      $('#subscribeMessage').removeClass().text(''); // Clear message
      $.ajax({
        url: 'subscribe.php',
        method: 'POST',
        data: { email: email },
        success: function (response) {
          $('#subscribeMessage')
            .addClass('text-green-600 dark:text-green-400')
            .text('Subscription successful! Thank you.');
          $('#subscribeForm')[0].reset();
        },
        error: function () {
          $('#subscribeMessage')
            .addClass('text-red-600 dark:text-red-400')
            .text('Oops! Something went wrong. Please try again.');
        }
      });
    });
  });
</script>
<script>
  //cloned script from my portfolio site tocreate typewriter effecr(id=loadin)
document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll('#loadin');

  elements.forEach(el => {
    const originalText = el.textContent.trim();
    el.textContent = "";

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          el.classList.add("visible");
          let i = 0;

          function typeLetter() {
            if (i < originalText.length) {
              el.textContent += originalText[i];
              i++;
              setTimeout(typeLetter, 35); // speed per letter
            }
          }

          typeLetter();
          obs.unobserve(el); // Only run once per element
        }
      });
    });

    observer.observe(el);
  });
});
</script>
<footer class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 py-10 px-6 transition-colors duration-500">
  <div class="max-w-6xl mx-auto grid md:grid-cols-4 sm:grid-cols-2 gap-8">
    
    <!-- Brand -->
    <div>
      <h3 class="text-xl font-bold text-pink-500 mb-3">lymo</h3>
      <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
        Skincare that speaks luxury. Crafted with love, inspired by nature.
      </p>
    </div>

    <!-- Links -->
    <div>
      <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2 uppercase tracking-wide">Company</h4>
      <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
        <li><a href="about.php" class="hover:underline">About</a></li>
        <li><a href="blog.php" class="hover:underline">Blog</a></li>
        <li><a href="index.php#contact" class="hover:underline">Contact</a></li>
        <li><a href="shop.php" class="hover:underline">Shop</a></li>
      </ul>
    </div>

    <!-- Support -->
    <div>
      <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2 uppercase tracking-wide">Support</h4>
      <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
        <li><a href="#" class="hover:underline">FAQs</a></li>
        <li><a href="#" class="hover:underline">Shipping & Returns</a></li>
        <li><a href="#" class="hover:underline">Privacy Policy</a></li>
        <li><a href="#" class="hover:underline">Terms of Service</a></li>
      </ul>
    </div>

    <!-- Social -->
    <div>
      <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2 uppercase tracking-wide">Follow Us</h4>
      <div class="flex gap-4">
        <a href="#" class="text-gray-500 hover:text-pink-500 transition"><i class="bi bi-facebook text-xl"></i></a>
        <a href="#" class="text-gray-500 hover:text-pink-500 transition"><i class="bi bi-twitter text-xl"></i></a>
        <a href="#" class="text-gray-500 hover:text-pink-500 transition"><i class="bi bi-instagram text-xl"></i></a>
        <a href="#" class="text-gray-500 hover:text-pink-500 transition"><i class="bi bi-youtube text-xl"></i></a>
      </div>
    </div>

  </div>

  <div class="mt-10 text-center text-xs text-gray-500 dark:text-gray-600">
    &copy; <?= date('Y') ?> lymo. All rights reserved.
  </div>
</footer>
      <?php echo "<div style='height:100px'></div>" ?>