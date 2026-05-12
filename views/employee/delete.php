<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT photo
    FROM employees
    WHERE id = ?
");

$stmt->execute([$id]);

$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if ($employee && file_exists("../../uploads/" . $employee['photo'])) {
    unlink("../../uploads/" . $employee['photo']);
}

$delete = $pdo->prepare("
    DELETE FROM employees
    WHERE id = ?
");

$delete->execute([$id]);

header("Location: index.php");