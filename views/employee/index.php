<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$title = 'Employee - Index';
$currentPage = 'employee';

$search = $_GET['q'] ?? '';

$stmt = $pdo->prepare("
    SELECT id, name, email, phone, address, photo
    FROM employees
    WHERE name LIKE :search OR email LIKE :search
    ORDER BY id DESC
");
$stmt->bindValue(':search', "%$search%");
$stmt->execute();

$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../layouts/header.php';
?>

<div class="section-header d-flex justify-content-between">
    <h1>Employee</h1>

    <a href="create.php" class="btn btn-primary">Add Employee</a>
</div>

<div class="section-body">
    <div class="card">
        <form action="" method="GET">
            <div class="card-header">
                <h4>Search</h4>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" name="q" class="form-control" placeholder="Search by name or email" value="<?= $_GET['q'] ?? '' ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$employees): ?>
                        <tr>
                            <td colspan="6" class="text-center">No employees found</td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><a href="detail.php?id=<?= $employee['id'] ?>"><?= $employee['id'] ?></a></td>
                            <td><img src="<?= '../../uploads/' . $employee['photo'] ?>" alt="Photo" width="50"></td>
                            <td><?= $employee['name'] ?></td>
                            <td><?= $employee['email'] ?></td>
                            <td><?= $employee['phone'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $employee['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?id=<?= $employee['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>