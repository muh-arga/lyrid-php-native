<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

onlyAdmin();

$title = 'User - Create';
$currentPage = 'user';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $check = $pdo->prepare("
        SELECT id FROM users
        WHERE username = ?
    ");

    $check->execute([$username]);

    if ($check->fetch()) {
        $error = "Username already exists";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO users
            (name, username, password, role)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $name,
            $username,
            $password,
            $role
        ]);

        header("Location: index.php");
        exit;
    }
}

include '../layouts/header.php';
?>

<div class="section-header">
    <h1>User - Create</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>