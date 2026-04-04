<?php session_start(); ?>
<!DOCTYPE html>
<?php $mode = $_COOKIE['mode'] ?? 'dark'; ?>
<html data-bs-theme="<?= $mode ?>" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4" style="width: 350px;">
        <h3 class="mb-3 text-center">Login</h3>
        <form action="processLogin.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email"  autocomplete="off" class="form-control" id="exampleInputEmail1" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" autocomplete="off" class="form-control" id="exampleInputPassword1" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <?php if (isset($_GET['logout'])): ?>
            <p class="mt-2 text-success text-center">You have successfully logged out.</p>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <p class="mt-2 text-danger text-center"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
    </div>
</body>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
