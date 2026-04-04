<?php
session_start();
require_once "Class/ConnexionDB.php";
$db = ConnexionDB::getInstance();

$id = $_GET['id'] ?? null;
if (!$id) die("Student ID missing");

$stmt = $db->prepare("
    SELECT s.*, sec.designation AS section_name
    FROM students s
    LEFT JOIN sections sec ON s.section_id = sec.id
    WHERE s.id = ?
");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) die("Student not found");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Info</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Student Info</h2>

    <div class="mb-3">
        <strong>ID:</strong> <?= $student['id'] ?>
    </div>
    <div class="mb-3">
        <strong>Name:</strong> <?= htmlspecialchars($student['name']) ?>
    </div>
    <div class="mb-3">
        <strong>Birthday:</strong> <?= $student['birthday'] ?>
    </div>
    <div class="mb-3">
        <strong>Section:</strong> <?= htmlspecialchars($student['section_name']) ?>
    </div>

    <a href="students.php" class="btn btn-secondary mt-3">Back to Students</a>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>