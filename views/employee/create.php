<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$title = 'Employee - Create';
$currentPage = 'employee';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];

    if (!isset($_FILES['photo'])) {
        $error = "Photo required";
    } else {

        $file = $_FILES['photo'];

        $allowed = ['image/jpeg', 'image/jpg'];

        if (!in_array($file['type'], $allowed)) {

            $error = "Only JPG/JPEG allowed";
        } elseif ($file['size'] > 300000) {

            $error = "Max size 300KB";
        } else {

            $ext = pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            );

            $filename = time() . '.' . $ext;

            if (
                move_uploaded_file(
                    $file['tmp_name'],
                    "../../uploads/" . $filename
                )
            ) {

                $stmt = $pdo->prepare("
                    INSERT INTO employees
                    (name, email, phone, address, photo)
                    VALUES (?, ?, ?, ?, ?)
                ");

                $stmt->execute([
                    $name,
                    $email,
                    $phone,
                    $address,
                    $filename
                ]);

                header("Location: index.php");
                exit;
            } else {
                $error = "Failed upload image";
            }
        }
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

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg" required>
                </div>
                <button class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>