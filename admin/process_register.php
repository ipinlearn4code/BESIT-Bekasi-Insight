<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeatPassword']);

    if ($password !== $repeatPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match!']);
        exit;
    }

    // Check if the username or email already exists
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Username or email already taken!']);
        exit;
    }

    // Insert new user into the database without password encryption
    $stmt = $pdo->prepare("INSERT INTO user (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
    if ($stmt->execute([$username, $email, $password])) {
        echo json_encode(['success' => true, 'message' => 'Registration successful!']);
        echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: Could not complete registration.']);
    }
}
?>

