<?php

require_once dirname(__DIR__, 2) . '/helpers/auth.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

onlyAdmin();

$id = $_GET['id'];

$stmt = $pdo->prepare("
    DELETE FROM users
    WHERE id = ?
");

$stmt->execute([$id]);

header("Location: index.php");