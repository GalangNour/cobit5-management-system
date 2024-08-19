<?php 
    include 'proses_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../assets/css/style.min.css">
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Welcome back!</h1>
            <p class="sign-up__subtitle">Sign in to your account to continue</p>
            <form action="signin.php" method="post" onsubmit="return validasi()">
                <label class="form-label-wrapper">
                    <p class="form-label">Username</p>
                    <input class="form-input" id="username" name="username" type="text"
                        placeholder="Enter your username" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input class="form-input" id="password" name="password" type="password"
                        placeholder="Enter your password" required>
                </label>
                <input type="hidden" name="login_input" value="1">
                <!-- <a class="link-info forget-link" href="##">Forgot your password?</a> -->
                <button class="form-btn primary-default-btn transparent-btn" name="login_button">Sign in</button>
            </form>
        </article>
    </main>

    <script type="text/javascript">
    function validasi() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (username != "" && password != "") {
            return true;
        } else {
            alert('Username dan Password harus di isi !');
            return false;
        }
    }
    </script>
    <!-- Chart library -->
    <script src="../assets/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="../assets/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="../assets/js/script.js"></script>
</body>

</html>