<?php
include 'navbar.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

    if ($email) {
        // Connect to your database
        $conn = new mysqli($host, $username, $password, $db);
        if ($conn->connect_error) {
            http_response_code(500);
            exit;
        }

        // Insert into `subscriptions` table
        $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
        $stmt->close();
        $conn->close();
    } else {
        http_response_code(400);
    }
}
//Still working onthe error messages(not fisplaying well)
?>