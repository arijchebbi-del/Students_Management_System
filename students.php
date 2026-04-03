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
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Students Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="students.php">Liste des etudiants</a></li>
          <li class="nav-item"><a class="nav-link" href="sections.php">Liste des sections</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <!-- Top controls -->
    <div class="d-flex justify-content-between mb-3">
      <div class="d-flex">
        <input type="text" id="searchInput" class="form-control me-2" placeholder="Search student...">
        <button class="btn btn-outline-secondary" id="filterBtn">Filter</button>
      </div>
      <a href="add_student.php" class="btn btn-primary">Add Student</a>
    </div>

    <!-- Students Table -->
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
        <!-- Example rows, replace with PHP loop -->
        <tr>
          <td>1</td>
          <td>Ahmed</td>
          <td>2003-05-12</td>
          <td>GL</td>
          <td class="text-center">
            <a href="student_info.php?id=1" class="text-info me-2"><i class="bi bi-info-circle"></i></a>
            <a href="delete_student.php?id=1" class="text-danger me-2"><i class="bi bi-trash"></i></a>
            <a href="edit_student.php?id=1" class="text-warning"><i class="bi bi-pencil-square"></i></a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Leila</td>
          <td>2004-07-20</td>
          <td>RT</td>
          <td class="text-center">
            <a href="student_info.php?id=2" class="text-info me-2"><i class="bi bi-info-circle"></i></a>
            <a href="delete_student.php?id=2" class="text-danger me-2"><i class="bi bi-trash"></i></a>
            <a href="edit_student.php?id=2" class="text-warning"><i class="bi bi-pencil-square"></i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize DataTable with buttons
      var table = $('#studentsTable').DataTable({
        dom: 'Bfrtip', // Add buttons at the top
        buttons: [
          'copy', 'excel', 'csv', 'pdf'
        ],
        paging: true,
        searching: true,
        ordering: true
      });

      // Search input
      $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
      });

      // Filter button
      $('#filterBtn').on('click', function() {
        alert('Filter functionality to implement!');
      });
    });
  </script>
</body>
</html>