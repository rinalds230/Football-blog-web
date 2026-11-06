<?php
session_start();
include 'db_pg.php';

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23505 || $e->getCode() == 23000) { // username taken (Postgres / SQLite) 
            $error = "Username already exists!";
        } else {
            $error = "Error: " . $e->getMessage();
        }
    }
}

$mode = 'signup';
require __DIR__ . '/includes/auth_layout.php';
