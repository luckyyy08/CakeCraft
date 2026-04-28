<?php
include "includes/db.php";
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


// Handle quantity update (via POST for legacy, keep AJAX separate if possible)
if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update = $conn->prepare("UPDATE cart SET quantity=? WHERE id=? AND user_id=?");
    $update->bind_param("iii", $quantity, $cart_id, $user_id);
    $update->execute();
    header("Location: cart.php");
    exit();
}

// Handle AJAX quantity update
if(isset($_GET['ajax_update'])){
    $cart_id = $_GET['cart_id'];
    $quantity = $_GET['quantity'];
    $update = $conn->prepare("UPDATE cart SET quantity=? WHERE id=? AND user_id=?");
    $update->bind_param("iii", $quantity, $cart_id, $user_id);
    if($update->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    exit();
}

// Handle remove item
if(isset($_POST['remove_item'])){
    $cart_id = $_POST['cart_id'];
    $delete = $conn->prepare("DELETE FROM cart WHERE id=? AND user_id=?");
    $delete->bind_param("ii", $cart_id, $user_id);
    $delete->execute();
}

// Fetch cart items
$query = "SELECT cart.id AS cart_id, cart.quantity, cart.item_type, cart.item_id,
          COALESCE(cakes.name, candles.name, hampers.name, decorations.name) as name,
          COALESCE(cakes.price, candles.price, hampers.price, decorations.price) as price,
          COALESCE(cakes.image, candles.image, hampers.image, decorations.image) as image
          FROM cart 
          LEFT JOIN cakes ON cart.item_type = 'cake' AND cart.item_id = cakes.id
          LEFT JOIN candles ON cart.item_type = 'candle' AND cart.item_id = candles.id
          LEFT JOIN hampers ON cart.item_type = 'hamper' AND cart.item_id = hampers.id
          LEFT JOIN decorations ON cart.item_type = 'decoration' AND cart.item_id = decorations.id
          WHERE cart.user_id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="cart-container">
    <h2 style="margin-top:0; color:#333; margin-bottom: 20px;">Shopping Cart</h2>

    <?php if($result->num_rows > 0): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product Details</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $total_amount = 0;
            while($row = $result->fetch_assoc()){
                $total = $row['price'] * $row['quantity'];
                $total_amount += $total;
            ?>
                <tr>
                    <td data-label="Product">
                        <div class="item-details">
                            <?php
                            $folder = 'cakes';
                            if($row['item_type'] == 'candle') $folder = 'candles';
                            if($row['item_type'] == 'hamper') $folder = 'hampers';
                            if($row['item_type'] == 'decoration') $folder = 'decorations';
                            ?>
                            <img src="assets/images/<?php echo $folder; ?>/<?php echo $row['image']; ?>" onerror="this.src='https://via.placeholder.com/80?text=Image';">
                            <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                        </div>
                    </td>
                    <td data-label="Price">₹ <?php echo number_format($row['price'], 2); ?></td>
                    <td data-label="Quantity">
                        <div class="quantity-control">
                            <button type="button" class="qty-btn minus" onclick="updateQty(<?php echo $row['cart_id']; ?>, -1)">-</button>
                            <input type="number" id="qty-<?php echo $row['cart_id']; ?>" name="quantity" class="qty-input" value="<?php echo $row['quantity']; ?>" min="1" readonly>
                            <button type="button" class="qty-btn plus" onclick="updateQty(<?php echo $row['cart_id']; ?>, 1)">+</button>
                        </div>
                    </td>
                    <td data-label="Total" style="font-weight: bold;">₹ <?php echo number_format($total, 2); ?></td>
                    <td data-label="Remove" style="text-align: center;">
                        <form method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" name="remove_item" class="btn-remove" title="Remove"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <h3 style="margin: 0 0 15px 0; color: #333;">Total Amount: <span style="font-size: 24px; color: #008542;">₹ <?php echo number_format($total_amount, 2); ?></span></h3>
            <a href="checkout.php" class="btn-checkout">PROCEED TO CHECKOUT</a> <br>
            <a href="cakes.php" style="display:inline-block; margin-top:15px; color:#555; text-decoration:none;">← Continue Shopping</a>
        </div>

    <?php else: ?>
        <div style="text-align:center; padding: 40px;">
            <i class="fa-solid fa-cart-shopping" style="font-size:50px; color:#ccc; margin-bottom:20px;"></i>
            <h3>Your cart is empty!</h3>
            <a href="cakes.php" class="btn-checkout">Shop Now</a>
        </div>
    <?php endif; ?>

</div>

<script>
function updateQty(cartId, change) {
    const qtyInput = document.getElementById('qty-' + cartId);
    let currentQty = parseInt(qtyInput.value);
    let newQty = currentQty + change;
    
    if (newQty < 1) return;
    
    qtyInput.value = newQty;
    
    // AJAX call to update quantity in database
    fetch(`cart.php?ajax_update=1&cart_id=${cartId}&quantity=${newQty}`)
        .then(response => response.text())
        .then(data => {
            if(data.trim() === 'success') {
                // Reload page to update totals
                window.location.reload();
            } else {
                alert('Error updating quantity');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>