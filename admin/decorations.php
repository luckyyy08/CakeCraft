<?php 
include "includes/header.php"; 

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM decorations WHERE id=$id");
    echo "<script src='assets/js/decorations.js'></script>";
}
?>

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1 class="page-title">Manage Decorations</h1>
    <a href="add_decoration.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Decoration</a>
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
            $q = "SELECT * FROM decorations ORDER BY id DESC";
            $res = mysqli_query($conn, $q);
            if(mysqli_num_rows($res) > 0) {
                while($item = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td>
                    <img src="../assets/images/decorations/<?php echo $item['image']; ?>" alt="decoration" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://via.placeholder.com/60?text=No+Image';">
                </td>
                <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                <td>₹ <?php echo number_format($item['price']); ?></td>
                <td><?php echo htmlspecialchars(substr($item['description'], 0, 50)); ?>...</td>
                <td>
                    <a href="edit_decoration.php?id=<?php echo $item['id']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                    <a href="decorations.php?delete=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this decoration?');"><i class="fa-solid fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5'>No decorations found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
