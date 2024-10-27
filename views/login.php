<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Codebucks" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">


    <!-- dark layout js -->
    <script src="../assets/js/pages/layout.js"></script>

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- simplebar css -->
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="container-fluid authentication-bg overflow-hidden">
        <div class="bg-overlay"></div>
        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-10 col-md-6 col-lg-4 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="mt-4">Welcome Back !</h4>
                        </div>

                        <div class="p-2 mt-5">
                            <form id="loginForm">
                                <div class="input-group auth-form-group-custom mb-3">
                                    <span class="input-group-text bg-primary bg-opacity-10 fs-16 " id="basic-addon1"><i
                                            class="mdi mdi-account-outline auti-custom-input-icon"></i></span>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter email" aria-label="Email" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group auth-form-group-custom mb-3">
                                    <span class="input-group-text bg-primary bg-opacity-10 fs-16" id="basic-addon2"><i
                                            class="mdi mdi-lock-outline auti-custom-input-icon"></i></span>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Enter password" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>


                                <div class="pt-3 text-center">
                                    <button class="btn btn-primary w-xl waves-effect waves-light" type="submit">Log
                                        In</button>
                                </div>

                            </form>
                        </div>

                        <div class="mt-5 text-center">
                            <p>©
                                <script>
                                document.write(new Date().getFullYear())
                                </script>
                                Cobit5. Crafted with <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>

    <script src="../assets/js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('proses_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // change to text to inspect the raw response
            .then(data => {
                console.log('Raw response:', data); // Log the raw response
                const jsonData = JSON.parse(data); // Parse the JSON data
                if (jsonData.success) {
                    Swal.fire({
                        title: 'Login Berhasil',
                        icon: 'success'
                    }).then(() => {
                        location = 'index.php';
                    });
                } else {
                    Swal.fire({
                        title: 'Login Gagal',
                        text: jsonData.message,
                        icon: 'error'
                    }).then(() => {
                        history.back();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script>

</body>

</html>