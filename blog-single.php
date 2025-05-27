<?php include 'navbar.php' ?>
<?php echo '<div style="height:50px;"></div>'?>
<?php
// Parse blog title from URL
if (isset($_GET['title'])) {
  $slug = str_replace('-', ' ', $_GET['title']);
  $stmt = $conn->prepare("SELECT * FROM blogs WHERE LOWER(title) = LOWER(?) LIMIT 1");
  $stmt->bind_param("s", $slug);
  $stmt->execute();
  $result = $stmt->get_result();
  $blog = $result->fetch_assoc();
} else {
  header("Location: blog.php");
  exit();
}
?>

<section class="py-20 px-6 bg-white dark:bg-gray-950 transition-colors duration-500">
  <div class="max-w-3xl mx-auto">
    <?php if ($blog): ?>
      <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2"><?= htmlspecialchars($blog['title']) ?></h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Published on <?= date('F j, Y', strtotime($blog['created_at'])) ?></p>
      </div>
      <img src="<?= htmlspecialchars($blog['image']) ?>" class="w-full h-72 object-cover rounded-xl shadow mb-6" alt="<?= htmlspecialchars($blog['title']) ?>" />

      <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-300">
        <?= nl2br($blog['excerpt']) ?>
      </div>

      <!-- Like & Share -->
      <div class="mt-10 flex flex-wrap items-center gap-4">
        <button class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full shadow flex items-center gap-2">
          <i class="bi bi-heart-fill"></i> Like
        </button>
        <div class="flex items-center gap-3">
          <a href="https://twitter.com/intent/tweet?text=<?= urlencode($blog['title']) ?>&url=<?= urlencode('https://demo.lymo.preciousadedokun.com.ng/blog-single.php?title=' . $_GET['title']) ?>" target="_blank" class="text-sm text-blue-500 hover:underline">
            Share on X
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://demo.lymo.preciousadedokun.com.ng/blog-single.php?title=' . $_GET['title']) ?>" target="_blank" class="text-sm text-blue-700 hover:underline">
            Share on Facebook
          </a>
        </div>
      </div>
    <?php else: ?>
      <p class="text-center text-gray-500 dark:text-gray-400">Blog post not found.</p>
    <?php endif; ?>
  </div>
</section>
<?php include 'footer.php';?>