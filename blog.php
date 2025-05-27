<?php include 'navbar.php'?>
<?php echo '<div style="height:50px;"></div>'?>
<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">From the J-ZONE Blog</h2>
      <p class="text-gray-600 dark:text-gray-400 text-lg max-w-xl mx-auto">Explore skincare secrets, self-care guides, and wellness tips curated just for you.</p>
    </div>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-10">
      <?php
         
        $query = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
        while ($row = $query->fetch_assoc()):
      ?>
        <div class="bg-white/50 dark:bg-gray-900/40 border border-white/20 dark:border-gray-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 backdrop-blur">
          <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="w-full h-56 object-cover" />
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2"><?= htmlspecialchars($row['title']) ?></h3>
<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
  <?= htmlspecialchars(mb_strimwidth($row['excerpt'], 0, 100, '...')) ?>
</p>
            <div class="flex justify-between items-center">
<a href="blog-single.php?title=<?= urlencode(strtolower(str_replace(' ', '-', $row['title']))) ?>" class="text-pink-500 hover:underline text-sm font-medium">Read more</a>
              <span class="text-xs text-gray-500 dark:text-gray-400"><?= date('M d, Y', strtotime($row['created_at'])) ?></span>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php include 'footer.php';?>