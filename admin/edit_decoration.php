<?php 
include "includes/header.php"; 

if(!isset($_GET['id'])) {
    echo "<script>window.location.href='decorations.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$item_query = mysqli_query($conn, "SELECT * FROM decorations WHERE id = $id");
$item = mysqli_fetch_assoc($item_query);

if(!$item) {
    echo "<script>alert('Decoration not found!'); window.location.href='decorations.php';</script>";
    exit;
}

if(isset($_POST['update_decoration'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = intval($_POST['price']);
    $original_price = intval($_POST['original_price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Image Upload Logic
    $image = $item['image'];
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = time() . '_' . $img_name;
        move_uploaded_file($tmp_name, "../assets/images/decorations/" . $image);
    }

    $q = "UPDATE decorations SET 
            name = '$name', 
            price = '$price', 
            original_price = '$original_price', 
            image = '$image', 
            description = '$description' 
          WHERE id = $id";
          
    if(mysqli_query($conn, $q)) {
        echo "<script>alert('Decoration updated successfully!'); window.location.href='decorations.php';</script>";
    } else {
        echo "<script>alert('Failed to update decoration.');</script>";
    }
}
?>

<style>
    .modern-form-container {
        max-width: 850px;
        margin: 40px auto;
        padding: 40px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border-top: 5px solid #00c3ff;
    }
    .modern-form-title {
        color: #333;
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 26px;
        text-align: center;
    }
    .modern-form-group {
        margin-bottom: 20px;
    }
    .modern-form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
    }
    .modern-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
    }
    .modern-textarea {
        resize: vertical;
        min-height: 100px;
    }
    .modern-btn-submit {
        background: linear-gradient(135deg, #00c3ff, #0088ff);
        color: white;
        border: none;
        padding: 14px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }
    .upload-box {
        border: 2px dashed #ddd;
        padding: 30px 20px;
        text-align: center;
        border-radius: 8px;
        background: #fafafa;
        cursor: pointer;
    }
</style>

<div class="modern-form-container">
    <h2 class="modern-form-title">✏️ Edit Decoration ✏️</h2>
    <form method="POST" enctype="multipart/form-data">
        <div style="display:flex; gap:20px;">
            <div class="modern-form-group" style="flex:2;">
                <label>Decoration Theme *</label>
                <input type="text" name="name" class="modern-input" required value="<?php echo htmlspecialchars($item['name']); ?>">
            </div>
            <div class="modern-form-group" style="flex:1;">
                <label>Selling Price (₹) *</label>
                <input type="number" name="price" class="modern-input" required value="<?php echo htmlspecialchars($item['price']); ?>">
            </div>
            <div class="modern-form-group" style="flex:1;">
                <label>Original Price (₹)</label>
                <input type="number" name="original_price" class="modern-input" value="<?php echo htmlspecialchars($item['original_price']); ?>">
            </div>
        </div>

        <div class="modern-form-group">
            <label>Service Image</label>
            <div class="upload-box" onclick="document.getElementById('file-upload').click()">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #00c3ff; margin-bottom: 10px;"></i>
                <p style="margin: 0; color: #666; font-size: 14px;">Click to replace image (optional)</p>
                <input id="file-upload" type="file" name="image" accept="image/*" style="display: none;" onchange="document.getElementById('file-name').innerText = this.files[0].name;">
                <p id="file-name" style="margin-top: 10px; font-weight: bold; color: #333; font-size: 13px;"></p>
            </div>
            <img src="../assets/images/decorations/<?php echo $item['image']; ?>" width="80" style="margin-top:10px; border-radius:5px;">
        </div>

        <div class="modern-form-group">
            <label>Description</label>
            <textarea name="description" class="modern-input modern-textarea"><?php echo htmlspecialchars($item['description']); ?></textarea>
        </div>

        <button type="submit" name="update_decoration" class="modern-btn-submit">Update Decoration</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>
