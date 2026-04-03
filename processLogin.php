<?php
session_start();
require_once 'Class/ConnexionDB.php';

// 1. Get POST data and trim whitespace
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$email || !$password) {
    die('Email and password required');
}

try {
    $db = ConnexionDB::getInstance();

    // 2. Fetch user by email
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if ($user) {
        // 3. Check password

        // If your database stores plain text passwords:
        if ($password === $user->password) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;

            // redirect after login
            header('Location: home.php');
            exit;

        // If your database stores hashed passwords (recommended):
        // if (password_verify($password, $user->password)) {
        //     $_SESSION['user_id'] = $user->id;
        //     $_SESSION['user_email'] = $user->email;
        //     header('Location: home.php');
        //     exit;
        // }

        } else {
            echo "Incorrect password!";
        }

    } else {
        echo "User not found!";
    } 

} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}