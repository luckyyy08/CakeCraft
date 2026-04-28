<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];

    // Accept both old cake_id and new mixed item format
    if(isset($_POST['item_id']) && isset($_POST['item_type'])){
        $item_id = intval($_POST['item_id']);
        $item_type = trim($_POST['item_type']);
    } elseif(isset($_POST['cake_id'])) {
        $item_id = intval($_POST['cake_id']);
        $item_type = 'cake';
    } else {
        header("Location: cakes.php");
        exit();
    }

    // Allow only valid item types
    $allowed_types = ['cake', 'candle', 'hamper', 'decoration'];
    if(!in_array($item_type, $allowed_types)){
        header("Location: cakes.php");
        exit();
    }

    // Check duplicate wishlist item
    $check = $conn->prepare("SELECT id FROM wishlist WHERE user_id=? AND item_id=? AND item_type=?");
    $check->bind_param("iis", $user_id, $item_id, $item_type);
    $check->execute();
    $check_result = $check->get_result();

    if($check_result && $check_result->num_rows == 0){
        $insert = $conn->prepare("INSERT INTO wishlist (user_id, item_id, item_type) VALUES (?, ?, ?)");
        $insert->bind_param("iis", $user_id, $item_id, $item_type);
        if($insert->execute()) {
            $_SESSION['status'] = "Item added to your wishlist!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to add item to wishlist.";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Item is already in your wishlist.";
        $_SESSION['status_code'] = "info";
    }

    if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: wishlist.php");
    }
    exit();
} else {
    header("Location: cakes.php");
    exit();
}
?>