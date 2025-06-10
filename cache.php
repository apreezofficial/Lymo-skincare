<?php

// Allowed file types for security(mainly for css and js for me 👌🏽)
$allowedExtensions = ['css' => 'text/css', 'js' => 'application/javascript'];

// Get requested file from URL
if (!isset($_GET['file'])) {
    http_response_code(400);
    echo "No file specified.";
    exit;
}

$file = basename($_GET['file']);
$extension = pathinfo($file, PATHINFO_EXTENSION);

// Validate extension
if (!array_key_exists($extension, $allowedExtensions)) {
    http_response_code(403);
    echo "Invalid file type.";
    exit;
}

$filePath = __DIR__ . '/assets/' . $file;

// ToCheck if file exists
if (!file_exists($filePath)) {
    http_response_code(404);
    echo "File not found.";
    exit;
}

// Set content type based on extension
header('Content-Type: ' . $allowedExtensions[$extension]);

$cacheDuration = 60 * 60 * 24 * 30; // 30 days
header('Cache-Control: public, max-age=' . $cacheDuration);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cacheDuration) . ' GMT');

$etag = md5_file($filePath);
header('ETag: "' . $etag . '"');

// Check for browser cache
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === '"' . $etag . '"') {
    // Client has the latest version
    http_response_code(304);
    exit;
}

// Serve the file
readfile($filePath);
exit;
?>
