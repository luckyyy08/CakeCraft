<?php 
include "includes/header.php"; 

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    echo "<script src='assets/js/users.js'></script>";
}
?>

<h1 class="page-title">Manage Customers</h1>

<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Registered On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
            if(mysqli_num_rows($res) > 0) {
                while($u = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td><?php echo $u['id']; ?></td>
                <td><strong><?php echo htmlspecialchars($u['fullname']); ?></strong></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td><?php echo htmlspecialchars($u['mobile']); ?></td>
                <td><?php echo date('d M Y', strtotime($u['created_at'])); ?></td>
                <td>
                    <a href="users.php?delete=<?php echo $u['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                        <i class="fa-solid fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='6'>No customers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
