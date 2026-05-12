<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$title = 'Employee - Edit';
$currentPage = 'employee';

$error = "";

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM employees
    WHERE id = ?
");

$stmt->execute([$id]);

$employee = $stmt->fetch(PDO::FETCH_ASSOC);

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $photo = $employee['photo'];

    if (!empty($_FILES['photo']['name'])) {

        $file = $_FILES['photo'];

        $allowed = ['image/jpeg', 'image/jpg'];

        if (!in_array($file['type'], $allowed)) {

            $error = "Only JPG/JPEG allowed";
        } elseif ($file['size'] > 300000) {

            $error = "Max size 300KB";
        } else {

            if (file_exists("../../uploads/" . $photo)) {
                unlink("../../uploads/" . $photo);
            }

            $ext = pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            );

            $photo = time() . '.' . $ext;

            move_uploaded_file(
                $file['tmp_name'],
                "../../uploads/" . $photo
            );
        }
    }

    if (!$error) {

        $update = $pdo->prepare("
            UPDATE employees
            SET
                name = ?,
                email = ?,
                phone = ?,
                address = ?,
                photo = ?
            WHERE id = ?
        ");

        $update->execute([
            $name,
            $email,
            $phone,
            $address,
            $photo,
            $id
        ]);

        header("Location: index.php");
        exit;
    }
}

include '../layouts/header.php';
?>

<div class="section-header">
    <h1>Employee - Edit</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($employee['name']) ?>">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($employee['email']) ?>">
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required value="<?= htmlspecialchars($employee['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required value="<?= htmlspecialchars($employee['address']) ?>">
                </div>

                <div class="mb-3">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg">
                </div>

                <button class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>