<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - CakeCraft</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Login Section -->
    <div class="container-fluid d-flex align-items-center justify-content-center auth-bg">
        <div class="auth-card shadow-lg">

            <div class="text-center mb-4">
                <a href="index.php">
                    <img src="img/logo1.png" class="auth-logo mb-2">
                </a>
                <h2 class="font-secondary text-light">Welcome Back</h2>
                <p class="text-muted">Login to continue sweetness 🍰</p>
            </div>

            <form onsubmit="loginUser(); return false;">
                <!-- Email -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="loginEmail" class="form-control"
                        placeholder="Email Address" required>
                </div>

                <!-- Password with Show/Hide -->
              <div class="input-group mb-4">
    <span class="input-group-text">
        <i class="fas fa-lock"></i>
    </span>

    <input type="password" id="loginPassword" class="form-control"
        placeholder="Password" required>


</div>


                <!-- Remember & Forgot -->
                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label text-light" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <a href="forget-password.php" class="auth-link">
                        Forgot Password?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit" class="btn auth-btn w-100 mb-3">
                    Login
                </button>

                <!-- Signup -->
                <p class="text-center text-secondary">
                    Don’t have an account?
                    <a href="create_acc.php" class="auth-link">Create one</a>
                </p>
            </form>

        </div>
    </div>

    <!-- JS -->
    <script>
        // Show / Hide Password
        function togglePassword() {
            const pass = document.getElementById("loginPassword");
            const eye = document.getElementById("eyeIcon");

            if (pass.type === "password") {
                pass.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            } else {
                pass.type = "password";
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            }
        }

        // Auto Redirect After Login (Demo)
        function loginUser() {
            const email = document.getElementById("loginEmail").value;
            const pass = document.getElementById("loginPassword").value;

            if (email !== "" && pass !== "") {
                alert("Login Successful!");
                window.location.href = "index.php";
            } else {
                alert("Please enter email and password");
            }
        }
    </script>

</body>
</html>
