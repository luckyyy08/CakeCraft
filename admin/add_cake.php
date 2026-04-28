<?php
include "includes/header.php";

if (isset($_POST['add_cake'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = intval($_POST['category_id']);
    $price = intval($_POST['price']);
    $original_price = intval($_POST['original_price']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $flavor = mysqli_real_escape_string($conn, $_POST['flavor']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image Upload Logic (Simple)
    $image = 'default.jpg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = time() . '_' . $img_name;
        move_uploaded_file($tmp_name, "../assets/images/cakes/" . $image);
    }

    $q = "INSERT INTO cakes (category_id, name, price, original_price, type, flavor, image, description) 
          VALUES ('$category_id', '$name', '$price', '$original_price', '$type', '$flavor', '$image', '$description')";

    if (mysqli_query($conn, $q)) {
        echo "<script>alert('Cake added successfully!'); window.location.href='cakes.php';</script>";
    } else {
        echo "<script>alert('Failed to add cake. Please try again.');</script>";
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
        border-top: 5px solid #ff4e00;
        /* FNP primary color inspired */
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
        border-color: #ff4e00;
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 78, 0, 0.1);
    }

    .modern-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .modern-btn-submit {
        background: linear-gradient(135deg, #ff4e00, #ff7e00);
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
        background: linear-gradient(135deg, #e64600, #e67100);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 78, 0, 0.3);
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
        border-color: #ff4e00;
        background: #fff5f0;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 20px;
    }
</style>

<div class="page-header">
    <h1 class="page-title" style="margin:0;">Cake Catalog</h1>
    <a href="cakes.php" class="btn btn-warning" style="border-radius: 20px; font-weight: 600; padding: 10px 20px;"><i
            class="fa-solid fa-arrow-left"></i> Back to Cakes</a>
</div>

<div class="modern-form-container">
    <h2 class="modern-form-title"> Add New Cake </h2>
    <form method="POST" enctype="multipart/form-data">

        <div class="flex-row">
            <div class="modern-form-group">
                <label>Cake Name *</label>
                <input type="text" name="name" class="modern-input" required placeholder="e.g. Black Forest Truffle">
            </div>
            <div class="modern-form-group">
                <label>Category *</label>
                <select name="category_id" class="modern-input" required>
                    <option value="">-- Select Category --</option>
                    <?php
                    $cats = mysqli_query($conn, "SELECT * FROM categories");
                    while ($c = mysqli_fetch_assoc($cats)) {
                        echo "<option value='" . $c['id'] . "'>" . $c['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="flex-row">
            <div class="modern-form-group">
                <label>Selling Price (₹) *</label>
                <input type="number" name="price" class="modern-input" required placeholder="e.g. 599" min="1">
            </div>
            <div class="modern-form-group">
                <label>Original Price (₹)</label>
                <input type="number" name="original_price" class="modern-input" placeholder="e.g. 799" min="0">
            </div>
            <div class="modern-form-group">
                <label>Cake Type *</label>
                <select name="type" class="modern-input" required>
                    <option value="eggless"> Eggless</option>
                    <option value="egg"> With Egg</option>
                </select>
            </div>
            <div class="modern-form-group">
                <label>Flavor</label>
                <input type="text" name="flavor" class="modern-input" placeholder="e.g. Chocolate">
            </div>
        </div>

        <div class="modern-form-group">
            <label>Product Image *</label>
            <div class="upload-box" onclick="document.getElementById('file-upload').click()">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #ff4e00; margin-bottom: 10px;"></i>
                <p style="margin: 0; color: #666; font-size: 14px;">Click to browse or drag & drop image here</p>
                <input id="file-upload" type="file" name="image" accept="image/*" required style="display: none;"
                    onchange="document.getElementById('file-name').innerText = this.files[0].name;">
                <p id="file-name" style="margin-top: 10px; font-weight: bold; color: #333; font-size: 13px;"></p>
            </div>
        </div>

        <div class="modern-form-group">
            <label>Description</label>
            <textarea name="description" class="modern-input modern-textarea"
                placeholder="Delicious details about this cake..."></textarea>
        </div>

        <button type="submit" name="add_cake" class="modern-btn-submit">
            <i class="fa-solid fa-plus-circle"></i> Add Cake to Catalog
        </button>
    </form>
</div>

<?php include "includes/footer.php"; ?>