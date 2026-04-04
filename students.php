<?php
session_start();
$role = $_SESSION['role'] ?? 'user';

require_once "Class/ConnexionDB.php"; 

$db = ConnexionDB::getInstance();

$result = $db->query("
    SELECT s.*, sec.designation AS section_designation
    FROM students s
    LEFT JOIN sections sec ON s.section_id = sec.id
    ORDER BY s.id ASC
");
$students = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students</title>

  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Students Management System</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="students.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="sections.php">Sections</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

  <!-- TOP BAR -->
  <div class="d-flex justify-content-between mb-3">
    <div class="d-flex">
      <input type="text" id="searchInput" class="form-control me-2" placeholder="Search student...">
      <button class="btn btn-outline-secondary" id="filterBtn">Filter</button>
    </div>

    <?php if ($role === 'admin'): ?>
      <a href="add_student.php" class="btn btn-primary">Add Student</a>
    <?php endif; ?>
  </div>

  <!-- TABLE -->
  <table id="studentsTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Section</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
<?php if (!empty($students)): ?>
  <?php foreach ($students as $row): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= $row['birthday'] ?></td>
      <td><?= htmlspecialchars($row['section_designation']) ?></td>

      <td class="text-center">
        <!-- INFO -->
        <a href="student_info.php?id=<?= $row['id'] ?>" class="text-info me-2">
          <i class="bi bi-info-circle"></i>
        </a>

        <!-- ADMIN ONLY -->
        <?php if ($role === 'admin'): ?>
          <a href="delete_student.php?id=<?= $row['id'] ?>" class="text-danger me-2">
            <i class="bi bi-trash"></i>
          </a>
          <a href="edit_student.php?id=<?= $row['id'] ?>" class="text-warning">
            <i class="bi bi-pencil-square"></i>
          </a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr>
    <td colspan="5" class="text-center">No students found</td>
  </tr>
<?php endif; ?>
</tbody>
  </table>
</div>

<!-- SCRIPTS -->
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
  var table = $('#studentsTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'csv', 'pdf'],
    paging: true,
    searching: true,
    ordering: true
  });

  $('#searchInput').on('keyup', function() {
    table.search(this.value).draw();
  });

  $('#filterBtn').on('click', function() {
    alert('Filter coming soon 😉');
  });
});
</script>

</body>
</html>