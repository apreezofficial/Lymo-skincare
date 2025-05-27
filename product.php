<?php
require 'navbar.php';

// to check if a specific product is requested
if (isset($_GET['id']) || isset($_GET['product'])) {
    $stmt = null;

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
        $stmt->bind_param("i", $id);
    } elseif (isset($_GET['product'])) {
        $slug = str_replace('-', ' ', $_GET['product']);
        $stmt = $conn->prepare("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.name = ?");
        $stmt->bind_param("s", $slug);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product):
?>
<?php echo '<div style="height:20px"></div>' ?>
<!-- Product Detail View -->
<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-10 items-center bg-white/40 dark:bg-gray-900/40 border border-white/20 dark:border-gray-800 p-6 rounded-2xl shadow-lg backdrop-blur-md">
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-96 object-cover rounded-xl">
    <div>
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2"><?= htmlspecialchars($product['name']) ?></h2>
      <p class="text-sm text-pink-500 uppercase tracking-wide font-semibold mb-4"><?= htmlspecialchars($product['category']) ?></p>
      <p class="text-gray-700 dark:text-gray-300 mb-6"><?= htmlspecialchars($product['description']) ?></p>
      <span class="block text-2xl font-bold text-pink-600 mb-4">$<?= htmlspecialchars($product['price']) ?></span>
      <div class="flex items-center gap-4 mt-6">
  <div class="flex items-center gap-2 bg-gray-100 dark:bg-[#1e1e1e] border border-gray-300 dark:border-gray-700 rounded-full px-2 py-1 shadow-inner">
  <button
    type="button"
    class="text-lg font-bold w-8 h-8 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 transition-colors dark:text-white"
    onclick="decreaseQty()"
  >−</button>

  <input
    id="quantity"
    type="number"
    value="1"
    min="1"
    class="w-10 text-center bg-transparent text-gray-900 dark:text-white outline-none font-semibold"
    readonly
  />

  <button
    type="button"
    class="text-lg font-bold w-8 h-8 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 transition-colors dark:text-white"
    onclick="increaseQty()"
  >+</button>
</div>

  <button
    id="cartToggleBtn"
    class="bg-pink-500 text-white px-6 py-3 rounded-full transition"
    data-id="<?= $product['id'] ?>"
    data-name="<?= htmlspecialchars($product['name']) ?>"
    data-price="<?= $product['price'] ?>"
    data-image="<?= $product['image'] ?>"
  >
    Add to Cart
  </button>
</div>

<p id="cartMessage" class="mt-4 text-sm text-green-600 dark:text-green-400 hidden"></p>
    </div>
<script>
  function increaseQty() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
  }

  function decreaseQty() {
    const input = document.getElementById('quantity');
    const value = parseInt(input.value);
    if (value > 1) input.value = value - 1;
  }

  function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
  }

  function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  function showMessage(message, success = true) {
    const msg = document.getElementById('cartMessage');
    msg.classList.remove('hidden');
    msg.className = success
      ? 'mt-4 text-sm text-green-600 dark:text-green-400'
      : 'mt-4 text-sm text-red-600 dark:text-red-400';
    msg.textContent = message;
    setTimeout(() => msg.classList.add('hidden'), 3000);
  }

  function isInCart(id) {
    const cart = getCart();
    return cart.some(item => item.id === id);
  }

  function toggleCartButtonState(id) {
    const btn = document.getElementById('cartToggleBtn');
    const cart = getCart();
    const inCart = cart.find(item => item.id === id);
    if (inCart) {
      btn.textContent = `Remove from Cart (${inCart.qty})`;
      btn.classList.remove('bg-pink-500');
      btn.classList.add('bg-red-600', 'hover:bg-red-700');
    } else {
      btn.textContent = 'Add to Cart';
      btn.classList.remove('bg-red-600', 'hover:bg-red-700');
      btn.classList.add('bg-pink-500');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('cartToggleBtn');
    const id = btn.dataset.id;
    toggleCartButtonState(id);

    btn.addEventListener('click', function () {
      const id = this.dataset.id;
      const name = this.dataset.name;
      const price = parseFloat(this.dataset.price);
      const image = this.dataset.image;
      const qty = parseInt(document.getElementById('quantity').value);

      let cart = getCart();
      const index = cart.findIndex(item => item.id === id);

      if (index > -1) {
        cart.splice(index, 1);
        showMessage('Removed from cart.', false);
      } else {
        cart.push({ id, name, price, image, qty });
        showMessage('Product added to cart!');
      }

      saveCart(cart);
      toggleCartButtonState(id);
    });
  });
</script>
  </div>
</section>

<?php
    else:
        echo "<p class='text-center py-20 text-red-500'>Product not found.</p>";
    endif;

    $stmt->close();
} else {
    // Show all products
    $result = $conn->query("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
?>
<?php echo '<div style="height:50px"></div>' ?>
<!-- All Products Grid -->

<?php
$categories = [];
$products = [];

while ($row = $result->fetch_assoc()) {
  $products[] = $row;
  $categories[] = $row['category'];
}

$categories = array_unique($categories);
?>

<!-- All Products Grid with Filters -->
<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 dark:text-white mb-10">Our Products</h2>

    <!-- Category Filter Buttons -->
    <div class="flex flex-wrap justify-center gap-4 mb-10">
      <button onclick="filterProducts('all', this)" class="filter-btn bg-pink-500 text-white px-4 py-2 rounded-full text-sm font-medium active">All</button>
      <?php foreach ($categories as $category): ?>
        <button onclick="filterProducts('<?= htmlspecialchars($category) ?>', this)" class="filter-btn bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full text-sm font-medium">
          <?= htmlspecialchars($category) ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Product Grid -->
    <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($products as $row): ?>
        <a 
          href="?product=<?= urlencode(str_replace(' ', '-', strtolower($row['name']))) ?>"
          class="product-card block bg-white/40 dark:bg-gray-900/40 p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow-md hover:scale-[1.03] transition duration-300 ease-in-out relative"
          data-category="<?= htmlspecialchars($row['category']) ?>"
        >
          <span class="absolute -top-3 -left-3 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-md rotate-[-12deg] shadow-md">
            <?= htmlspecialchars($row['category']) ?>
          </span>
          <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="w-full h-52 object-cover rounded-xl mb-4" />
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><?= htmlspecialchars($row['name']) ?></h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-2"><?= htmlspecialchars($row['description']) ?></p>
          <span class="block mt-3 text-pink-500 font-bold text-lg">$<?= htmlspecialchars($row['price']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Filter Script -->
<script>
  function filterProducts(category, clickedBtn) {
    const cards = document.querySelectorAll('.product-card');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(btn => {
      btn.classList.remove('bg-pink-500', 'text-white', 'active');
      btn.classList.add('bg-gray-200', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');
    });

    clickedBtn.classList.add('bg-pink-500', 'text-white', 'active');
    clickedBtn.classList.remove('bg-gray-200', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');

    cards.forEach(card => {
      const match = card.getAttribute('data-category') === category || category === 'all';
      card.style.display = match ? 'block' : 'none';
    });
  }

  // Default: trigger All filter on load
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.filter-btn.active')?.click();
  });
</script>

<?php } $conn->close(); ?>
<?php include 'footer.php';?>