<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $item_id = 0;
    $item_type = 'cake';

    if(isset($_POST['cake_id'])){
        $item_id = intval($_POST['cake_id']);
        $item_type = 'cake';
    } elseif(isset($_POST['item_id']) && isset($_POST['item_type'])) {
        $item_id = intval($_POST['item_id']);
        $item_type = $_POST['item_type'];
    }

    if($item_id > 0) {
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        $check = $conn->prepare("SELECT id FROM cart WHERE user_id=? AND item_id=? AND item_type=?");
        $check->bind_param("iis", $user_id, $item_id, $item_type);
        $check->execute();
        $check_result = $check->get_result();

        if($check_result && $check_result->num_rows > 0){
            $row = $check_result->fetch_assoc();
            $cart_id = $row['id'];
            $update = $conn->prepare("UPDATE cart SET quantity=quantity+? WHERE id=?");
            $update->bind_param("ii", $quantity, $cart_id);
            $update->execute();
        } else {
            $insert = $conn->prepare("INSERT INTO cart (user_id, item_id, item_type, quantity) VALUES (?, ?, ?, ?)");
            $insert->bind_param("iisi", $user_id, $item_id, $item_type, $quantity);
            $insert->execute();
        }
        // Return to the previous page instead of redirecting to cart
        $_SESSION['status'] = "Item added to cart successfully!";
        $_SESSION['status_code'] = "success";
        
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        header("Location: " . $redirect_url);
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
