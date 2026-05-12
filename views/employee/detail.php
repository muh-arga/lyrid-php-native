<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("
    SELECT *
    FROM employees
    WHERE id = ?
");

$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

$title = 'Employee - Detail';
$currentPage = 'employee';

include '../layouts/header.php';
?>

<div class="section-header">
    <h1>Employee - Detail</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($employee['name']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($employee['email']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required value="<?= htmlspecialchars($employee['phone']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required value="<?= htmlspecialchars($employee['address']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Photo</label>
                <div>
                    <img src="<?= '../../uploads/' . $employee['photo'] ?>" alt="Photo" width="500">
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Back</button>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>