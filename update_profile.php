<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$fullname = $_POST['fullname'];
$mobile = $_POST['mobile'];

$sql = "UPDATE users SET fullname=?, mobile=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $fullname, $mobile, $user_id);

if ($stmt->execute()) {
    $_SESSION['user_name'] = $fullname;
    echo "<script>alert('Profile Updated Successfully'); window.location.href='profile.php';</script>";
} else {
    echo "<script>alert('Something went wrong'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
