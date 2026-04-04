<?php
session_start();
$role = $_SESSION['role'] ?? 'user';
if ($role !== 'admin') die("Access denied!");

require_once "Class/ConnexionDB.php";
$db = ConnexionDB::getInstance();

$id = $_GET['id'] ?? null;
if (!$id) die("Student ID missing");

$stmt = $db->prepare("DELETE FROM students WHERE id=?");
$stmt->execute([$id]);

header("Location: students.php");
exit;