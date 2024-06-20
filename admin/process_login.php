<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if ($user && $password === $user['password']) {
        // if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['privilege'] = $user['privilege'];
            $_SESSION['user'] = $user['username'];
            header('Location: index.php');
            
            // // Redirect berdasarkan privilege
            // if ($user['privilege'] === 'admin') {
            //     header('Location: index.php');
            // } elseif ($user['privilege'] === 'user') {
            //     header('Location: news.php');
            // } elseif ($user['privilege'] === 'writer') {
            //     header('Location: writer_dashboard.php');
            // } else {
            //     $_SESSION['error'] = 'Invalid privilege level';
            //     header('Location: login.php');
            // }
            exit;
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: login.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>
