<?php
session_start();

$redirect = $_GET['redirect'] ?? 'home.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

header("Location: $redirect");
exit();
