<?php 
include "includes/header.php"; 

if(!isset($_GET['id'])) {
    echo "<script>window.location.href='cakes.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$cake_query = mysqli_query($conn, "SELECT * FROM cakes WHERE id = $id");
$cake = mysqli_fetch_assoc($cake_query);

if(!$cake) {
    echo "<script>alert('Cake not found!'); window.location.href='cakes.php';</script>";
    exit;
}

if(isset($_POST['update_cake'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = intval($_POST['category_id']);
    $price = intval($_POST['price']);
    $original_price = intval($_POST['original_price']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $flavor = mysqli_real_escape_string($conn, $_POST['flavor']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Image Upload Logic (Simple)
    $image = $cake['image'];
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = time() . '_' . $img_name;
        move_uploaded_file($tmp_name, "../assets/images/cakes/" . $image);
    }

    $q = "UPDATE cakes SET 
            category_id = '$category_id', 
            name = '$name', 
            price = '$price', 
            original_price = '$original_price', 
            type = '$type', 
            flavor = '$flavor', 
            image = '$image', 
            description = '$description' 
          WHERE id = $id";
          
    if(mysqli_query($conn, $q)) {
        echo "<script>alert('Cake updated successfully!'); window.location.href='cakes.php';</script>";
    } else {
        echo "<script>alert('Failed to update cake. Please try again.');</script>";
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
        border-top: 5px solid #00c3ff; /* Edit uses a different accent color */
    }
    .modern-form-title {
        color: #333;
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 26px;
        text-align: center;
        letter-spacing: 0.5px;
    }
    .modern-form-group {
        margin-bottom: 20px;
        flex: 1;
        min-width: 250px;
    }
    .modern-form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modern-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f9f9f9;
        box-sizing: border-box;
    }
    .modern-input:focus {
        background: #fff;
        border-color: #00c3ff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 195, 255, 0.1);
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
        transition: all 0.3s ease;
        display: block;
        width: 100%;
        margin-top: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .modern-btn-submit:hover {
        background: linear-gradient(135deg, #00aadd, #0077dd);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 195, 255, 0.3);
    }
    .modern-btn-submit:active {
        transform: translateY(0);
    }
    .flex-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap; 
    }
    .upload-box {
        border: 2px dashed #ddd;
        padding: 30px 20px;
        text-align: center;
        border-radius: 8px;
        background: #fafafa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .upload-box:hover {
        border-color: #00c3ff;
        background: #f0fbff;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 20px;
    }
    .current-image {
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: block;
    }
</style>

<div class="page-header">
    <h1 class="page-title" style="margin:0;">Cake Catalog</h1>
    <a href="cakes.php" class="btn btn-warning" style="border-radius: 20px; font-weight: 600; padding: 10px 20px;"><i class="fa-solid fa-arrow-left"></i> Back to Cakes</a>
</div>

<div class="modern-form-container">
    <h2 class="modern-form-title">✏️ Edit Cake ✏️</h2>
    <form method="POST" enctype="multipart/form-data">
        
        <div class="flex-row">
            <div class="modern-form-group">
                <label>Cake Name *</label>
                <input type="text" name="name" class="modern-input" required placeholder="e.g. Black Forest Truffle" value="<?php echo htmlspecialchars($cake['name']); ?>">
            </div>
            <div class="modern-form-group">
                <label>Category *</label>
                <select name="category_id" class="modern-input" required>
                    <option value="">-- Select Category --</option>
                    <?php 
                    $cats = mysqli_query($conn, "SELECT * FROM categories");
                    while($c = mysqli_fetch_assoc($cats)){
                        $selected = ($c['id'] == $cake['category_id']) ? 'selected' : '';
                        echo "<option value='".$c['id']."' $selected>".$c['name']."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="flex-row">
            <div class="modern-form-group">
                <label>Selling Price (₹) *</label>
                <input type="number" name="price" class="modern-input" required placeholder="e.g. 599" min="1" value="<?php echo htmlspecialchars($cake['price']); ?>">
            </div>
            <div class="modern-form-group">
                <label>Original Price (₹)</label>
                <input type="number" name="original_price" class="modern-input" placeholder="e.g. 799" min="0" value="<?php echo htmlspecialchars($cake['original_price']); ?>">
            </div>
            <div class="modern-form-group">
                <label>Cake Type *</label>
                <select name="type" class="modern-input" required>
                    <option value="eggless" <?php echo ($cake['type'] == 'eggless') ? 'selected' : ''; ?>>🌱 Eggless</option>
                    <option value="egg" <?php echo ($cake['type'] == 'egg') ? 'selected' : ''; ?>>🥚 With Egg</option>
                </select>
            </div>
            <div class="modern-form-group">
                <label>Flavor</label>
                <input type="text" name="flavor" class="modern-input" placeholder="e.g. Chocolate & Vanilla" value="<?php echo htmlspecialchars($cake['flavor']); ?>">
            </div>
        </div>

        <div class="modern-form-group">
            <label>Product Image</label>
            <div class="upload-box" onclick="document.getElementById('file-upload').click()">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #00c3ff; margin-bottom: 10px;"></i>
                <p style="margin: 0; color: #666; font-size: 14px;">Click to browse or drag & drop a new image to replace</p>
                <input id="file-upload" type="file" name="image" accept="image/*" style="display: none;" onchange="document.getElementById('file-name').innerText = this.files[0].name;">
                <p id="file-name" style="margin-top: 10px; font-weight: bold; color: #333; font-size: 13px;"></p>
            </div>
            <?php if($cake['image'] != ""): ?>
                <div style="margin-top: 15px;">
                    <span style="font-size: 12px; color: #888;">Current Image:</span>
                    <img src="../assets/images/cakes/<?php echo $cake['image']; ?>" width="80" class="current-image" alt="Current image">
                </div>
            <?php endif; ?>
        </div>

        <div class="modern-form-group">
            <label>Description</label>
            <textarea name="description" class="modern-input modern-textarea" placeholder="Delicious details about this cake..."><?php echo htmlspecialchars($cake['description']); ?></textarea>
        </div>

        <button type="submit" name="update_cake" class="modern-btn-submit">
            <i class="fa-solid fa-floppy-disk"></i> Update Cake Details
        </button>
    </form>
</div>

<?php include "includes/footer.php"; ?>
