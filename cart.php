<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Cart - LYMO</title>
</head>
<?php echo '<div style="height:70px"></div>' ?>
<body class="bg-white dark:bg-gray-950 text-gray-800 dark:text-gray-100 transition-colors duration-500">
  <div class="max-w-5xl mx-auto py-10 px-6">
    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-center text-pink-500">Your Shopping Cart</h1>
    
    <div id="cartItemsContainer" class="space-y-6"></div>

    <div id="cartSummary" class="mt-10 hidden text-center">
      <p class="text-lg font-semibold mb-4 dark:text-white">Total: <span id="totalPrice" class="text-pink-500"></span></p>
      <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full transition">Proceed to Checkout</button>
    </div>

    <div id="emptyCart" class="text-center text-gray-500 dark:text-gray-400 mt-16 hidden">
      <i class="bi bi-bag-x-fill text-6xl mb-4"></i>
      <p class="text-lg">Your cart is currently empty.</p>
    </div>
  </div>
<script>
  function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD'
    }).format(amount);
  }

  function renderCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const container = document.getElementById('cartItemsContainer');
    const totalElem = document.getElementById('totalPrice');
    const summary = document.getElementById('cartSummary');
    const empty = document.getElementById('emptyCart');

    container.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
      summary.classList.add('hidden');
      empty.classList.remove('hidden');
      return;
    }

    empty.classList.add('hidden');
    summary.classList.remove('hidden');

    cart.forEach(product => {
      const itemTotal = product.price * product.qty;
      total += itemTotal;

      container.innerHTML += `
        <div class="flex flex-col md:flex-row items-center justify-between bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-6 rounded-2xl border border-white/20 dark:border-gray-800 shadow">
          <div class="flex items-center gap-4">
            <img src="${product.image}" alt="${product.name}" class="w-24 h-24 object-cover rounded-xl" />
            <div>
              <h3 class="text-xl font-semibold dark:text-white">${product.name}</h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">${product.description || ''}</p>
              <p class="text-pink-500 font-bold mt-1">${formatCurrency(product.price)}</p>
            </div>
          </div>

          <div class="flex items-center gap-4 mt-4 md:mt-0">
            <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-full px-3 py-2">
              <button type="button" class="text-xl dark:text-white font-bold px-2" onclick="updateQty('${product.id}', -1)">-</button>
              <input type="text" value="${product.qty}" readonly class="w-10 text-center dark:text-white bg-transparent outline-none" />
              <button type="button" class="text-xl font-bold px-2 dark:text-white" onclick="updateQty('${product.id}', 1)">+</button>
            </div>
            <button onclick="removeFromCart('${product.id}')" class="text-red-500 hover:text-red-600 transition text-sm"><i class="bi bi-trash3-fill"></i> Remove</button>
          </div>
        </div>
      `;
    });

    totalElem.textContent = formatCurrency(total);
  }

  function updateQty(productId, change) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.map(p => {
      if (p.id === productId) {
        p.qty = Math.max(1, p.qty + change);
      }
      return p;
    });
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
  }

  function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(p => p.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
  }

  document.addEventListener('DOMContentLoaded', renderCart);
</script>
</body>
</html>
<?php include 'footer.php';?>