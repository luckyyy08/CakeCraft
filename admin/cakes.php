<?php 
include "includes/header.php"; 

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM cakes WHERE id=$id");
    echo "<script src='assets/js/cakes.js'></script>";
}

?>

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1 class="page-title">Manage Cakes</h1>
    <a href="add_cake.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Cake</a>
</div>

<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $q = "SELECT cakes.*, categories.name as cat_name FROM cakes LEFT JOIN categories ON cakes.category_id = categories.id ORDER BY cakes.id DESC";
            $res = mysqli_query($conn, $q);
            if(mysqli_num_rows($res) > 0) {
                while($cake = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td>
                    <img src="../assets/images/cakes/<?php echo $cake['image']; ?>" alt="cake" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://via.placeholder.com/60?text=No+Image';">
                </td>
                <td><strong><?php echo htmlspecialchars($cake['name']); ?></strong></td>
                <td><?php echo htmlspecialchars($cake['cat_name']); ?></td>
                <td>₹ <?php echo number_format($cake['price']); ?></td>
                <td><span class="badge <?php echo ($cake['type'] == 'eggless') ? 'badge-paid' : 'badge-pending'; ?>"><?php echo ucfirst($cake['type']); ?></span></td>
                <td>
                    <a href="edit_cake.php?id=<?php echo $cake['id']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                    <a href="cakes.php?delete=<?php echo $cake['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this cake?');"><i class="fa-solid fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='6'>No cakes found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
