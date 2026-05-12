<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM users
    WHERE id = ?
");


$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$title = 'User - Detail';
$currentPage = 'user';

include '../layouts/header.php';
?>

<div class="section-header">
    <h1>User - Detail</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($user['name']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <input type="text" name="role" class="form-control" required value="<?= htmlspecialchars($user['role']) ?>" disabled>
            </div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Back</button>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>