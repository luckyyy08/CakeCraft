<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, mobile, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $email, $mobile, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Account Created Successfully'); window.location.href='login_acc.php';</script>";
    } else {
        echo "<script>alert('Error: Email already exists'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
