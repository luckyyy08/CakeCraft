<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Fetch user */
$sql = "SELECT fullname, email, mobile FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

/* Update */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $mobile   = $_POST['mobile'];

    $update = "UPDATE users SET fullname=?, mobile=? WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssi", $fullname, $mobile, $user_id);

    if ($stmt->execute()) {
        $_SESSION['user_name'] = $fullname;
        echo "<script>alert('Profile Updated Successfully 🎉'); window.location.href='profile.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - CakeCraft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1c1c1c, #2a2a2a);
        }

        .profile-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-card {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }

        .profile-card h4 {
            font-family: 'Oswald', sans-serif;
            color: #d4a017;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #d4a017;
        }

        .btn-save {
            background: #d4a017;
            color: #000;
            font-weight: 600;
            border-radius: 30px;
            padding: 8px 25px;
        }

        .btn-save:hover {
            background: #c29515;
        }

        .btn-cancel {
            border-radius: 30px;
        }

        .profile-icon {
            width: 80px;
            height: 80px;
            background: #f3f3f3;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #d4a017;
        }
    </style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="profile-wrapper">
    <div class="profile-card">

        <div class="profile-icon">
            <i class="fas fa-user"></i>
        </div>

        <h4>Edit Your Profile</h4>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control"
                       value="<?php echo $user['fullname']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control"
                       value="<?php echo $user['email']; ?>" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobile" class="form-control"
                       value="<?php echo $user['mobile']; ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="profile.php" class="btn btn-outline-secondary btn-cancel">
                    Cancel
                </a>
                <button type="submit" class="btn btn-save">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>
