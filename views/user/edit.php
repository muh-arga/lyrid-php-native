<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

onlyAdmin();

$title = 'User - Edit';
$currentPage = 'user';

$error = "";

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM users
    WHERE id = ?
");

$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $check = $pdo->prepare("
        SELECT id FROM users
        WHERE username = ? AND id != ?  
    ");

    $check->execute([$username, $id]);

    if ($check->fetch()) {
        $error = "Username already exists";
    } else {
        if (!empty($_POST['password'])) {

            $password = password_hash(
                $_POST['password'],
                PASSWORD_BCRYPT
            );

            $update = $pdo->prepare("
            UPDATE users
            SET
                name = ?,
                username = ?,
                password = ?,
                role = ?
            WHERE id = ?
        ");

            $update->execute([
                $name,
                $username,
                $password,
                $role,
                $id
            ]);
        } else {

            $update = $pdo->prepare("
            UPDATE users
            SET
                name = ?,
                username = ?,
                role = ?
            WHERE id = ?
        ");

            $update->execute([
                $name,
                $username,
                $role,
                $id
            ]);
        }
    }

    header("Location: index.php");
    exit;
}

include '../layouts/header.php';
?>

<div class="section-header">
    <h1>User - Edit</h1>
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
                    <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($user['name']) ?>">
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
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