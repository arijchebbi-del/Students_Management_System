<?php
session_start();
$role = $_SESSION['role'] ?? 'user';
if ($role !== 'admin') die("Access denied!");

require_once "Class/ConnexionDB.php";
$db = ConnexionDB::getInstance();

$id = $_GET['id'] ?? null;
if (!$id) die("Student ID missing");

$stmt = $db->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$student) die("Student not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section_id = $_POST['section_id'];

    $stmt = $db->prepare("UPDATE students SET name=?, birthday=?, section_id=? WHERE id=?");
    $stmt->execute([$name, $birthday, $section_id, $id]);

    header("Location: students.php");
    exit;
}

// Fetch sections
$sections = $db->query("SELECT * FROM sections")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Student</h2>

    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $student['birthday'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <select name="section_id" id="section" class="form-select" required>
                <option value="" disabled>Select section</option>
                <?php foreach($sections as $sec): ?>
                    <option value="<?= $sec['id'] ?>" <?= $sec['id'] == $student['section_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sec['name'] ?? $sec['designation']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="students.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>