<?php
include "includes/header.php";

if (isset($_POST['add_hamper'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = intval($_POST['price']);
    $original_price = intval($_POST['original_price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image Upload Logic
    $image = 'default.jpg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = time() . '_' . $img_name;
        move_uploaded_file($tmp_name, "../assets/images/hampers/" . $image);
    }

    $q = "INSERT INTO hampers (name, price, original_price, image, description) VALUES ('$name', '$price', '$original_price', '$image', '$description')";

    if (mysqli_query($conn, $q)) {
        echo "<script>alert('Hamper added successfully!'); window.location.href='hampers.php';</script>";
    } else {
        echo "<script>alert('Failed to add hamper.');</script>";
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
        background: linear-gradient(135deg, #ff4e00, #ff7e00);
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
    <h2 class="modern-form-title"> Add New Gift Hamper </h2>
    <form method="POST" enctype="multipart/form-data">
        <div style="display:flex; gap:20px;">
            <div class="modern-form-group" style="flex:2;">
                <label>Hamper Name *</label>
                <input type="text" name="name" class="modern-input" required placeholder="e.g. Royal Chocolate Basket">
            </div>
            <div class="modern-form-group" style="flex:1;">
                <label>Selling Price (₹) *</label>
                <input type="number" name="price" class="modern-input" required placeholder="e.g. 1500">
            </div>
            <div class="modern-form-group" style="flex:1;">
                <label>Original Price (₹)</label>
                <input type="number" name="original_price" class="modern-input" placeholder="e.g. 1999">
            </div>
        </div>

        <div class="modern-form-group">
            <label>Product Image *</label>
            <div class="upload-box" onclick="document.getElementById('file-upload').click()">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #ff4e00; margin-bottom: 10px;"></i>
                <p style="margin: 0; color: #666; font-size: 14px;">Click to browse image</p>
                <input id="file-upload" type="file" name="image" accept="image/*" required style="display: none;"
                    onchange="document.getElementById('file-name').innerText = this.files[0].name;">
                <p id="file-name" style="margin-top: 10px; font-weight: bold; color: #333; font-size: 13px;"></p>
            </div>
        </div>

        <div class="modern-form-group">
            <label>Description</label>
            <textarea name="description" class="modern-input modern-textarea"
                placeholder="What's inside this hamper?"></textarea>
        </div>

        <button type="submit" name="add_hamper" class="modern-btn-submit">Add Hamper</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>