<?php 
include "includes/header.php"; 

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM candles WHERE id=$id");
    echo "<script src='assets/js/candles.js'></script>";
}
?>

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1 class="page-title">Manage Candles</h1>
    <a href="add_candle.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Candle</a>
</div>

<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $q = "SELECT * FROM candles ORDER BY id DESC";
            $res = mysqli_query($conn, $q);
            if(mysqli_num_rows($res) > 0) {
                while($item = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td>
                    <img src="../assets/images/candles/<?php echo $item['image']; ?>" alt="candle" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://via.placeholder.com/60?text=No+Image';">
                </td>
                <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                <td>₹ <?php echo number_format($item['price']); ?></td>
                <td><?php echo htmlspecialchars(substr($item['description'], 0, 50)); ?>...</td>
                <td>
                    <a href="edit_candle.php?id=<?php echo $item['id']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                    <a href="candles.php?delete=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this candle?');"><i class="fa-solid fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5'>No candles found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
