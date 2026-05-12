<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

onlyAdmin();

$title = 'User - Index';
$currentPage = 'user';

$search = $_GET['q'] ?? '';

$stmt = $pdo->prepare("
    SELECT id, name, username, role
    FROM users
    WHERE name LIKE :search OR username LIKE :search
    ORDER BY id DESC
");

$stmt->bindValue(':search', "%$search%");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../layouts/header.php';
?>

<div class="section-header d-flex justify-content-between">
    <h1>User</h1>

    <a href="create.php" class="btn btn-primary">Add User</a>
</div>

<div class="section-body">
    <div class="card">
        <form action="" method="GET">
            <div class="card-header">
                <h4>Search</h4>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" name="q" class="form-control" placeholder="Search by name or username" value="<?= $_GET['q'] ?? '' ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$users): ?>
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><a href="detail.php?id=<?= $user['id'] ?>"><?= $user['id'] ?></a></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>