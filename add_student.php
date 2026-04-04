<?php
session_start();
$role = $_SESSION['role'] ?? 'user';
if ($role !== 'admin') die("Access denied!");

require_once "Class/ConnexionDB.php";
$db = ConnexionDB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section_id = $_POST['section_id'];

    $stmt = $db->prepare("INSERT INTO students (name, birthday, section_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $birthday, $section_id]);

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
    <title>Add Student</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add Student</h2>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required>
        </div>

        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <select name="section_id" id="section" class="form-select" required>
                <option value="" disabled selected>Select section</option>
                <?php foreach($sections as $sec): ?>
                    <option value="<?= $sec['id'] ?>"><?= htmlspecialchars($sec['name'] ?? $sec['designation']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Student</button>
        <a href="students.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>