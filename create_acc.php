<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // DEBUG – first test
    /*
    echo "<pre>";
    print_r($_POST);
    exit();
    */

    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $password = $_POST['password'];
    $cpass    = $_POST['confirm_password'];

    // Password match check
    if ($password !== $cpass) {
        echo "<script>alert('Passwords do not match'); window.history.back();</script>";
        exit();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, mobile, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $email, $mobile, $hash);

    if ($stmt->execute()) {
        echo "<script>alert('Account Created Successfully'); window.location.href='login_acc.php';</script>";
    } else {
        echo "<script>alert('Email already exists'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
