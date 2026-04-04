<?php
session_start();
require_once "Class/ConnexionDB.php";

$db = ConnexionDB::getInstance();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Simple validation
if (empty($email) || empty($password)) {
    header("Location: login.php?error=Please fill all fields");
    exit;
}

// Fetch user from DB
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $user['password'] === $password) { 
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    header("Location: students.php");
    exit;
} else {
    header("Location: login.php?error=Invalid email or password");
    exit;
}