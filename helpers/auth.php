<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /views/auth/login.php");
    exit();
}

function isAdmin()
{
    return $_SESSION['user']['role'] === 'admin';
}

function isStaff()
{
    return $_SESSION['user']['role'] === 'user';
}

function onlyAdmin()
{
    if (!isAdmin()) {
        $_SESSION['error'] = "Access denied";
        header("Location: /views/employee/index.php");
        exit;
    }
}
