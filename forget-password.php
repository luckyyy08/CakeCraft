<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Account - CakeCraft</title>
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

<body class="bg-offer">


<!-- Create Account Section -->
<div class="container-fluid d-flex justify-content-center align-items-center auth-bg">
    <div class="auth-card">

        <div class="text-center mb-4">
            <img src="img/logo1.png" class="auth-logo mb-2">
            <h3 class="text-light">Forgot Password</h3>
            
            <p class="text-muted">Enter your registered email</p>
        </div>
        

        <form>
            <div class="input-group mb-4">
                  <span class="input-group-text">
                        <i class="fas fa-envelope"> </i>
                    </span>
                <input type="email" class="form-control"
                    placeholder="Email Address" required>
            </div>

            <button class="btn auth-btn w-100 mb-3">
                Send Reset Link
            </button>

            <p class="text-center">
                <a href="login_acc.php" class="auth-link">Back to Login</a>
            </p>
        </form>

    </div>
</div>

</body>

</html>