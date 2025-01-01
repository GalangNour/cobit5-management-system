<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
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
    <div id="layout-wrapper">
        <?php include 'partials/topbar.php'; ?>
        <?php include 'partials/sidebar.php'; ?>
        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Welcome, <span
                                            class="text-primary"><?php echo $_SESSION['nama'];?></span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tentang COBIT 5</h5>
                <p class="card-text">
                    <strong>COBIT 5</strong> (Control Objectives for Information and Related Technologies) adalah 
                    kerangka kerja tata kelola dan manajemen teknologi informasi yang dirancang untuk membantu 
                    organisasi memastikan bahwa IT sejalan dengan tujuan bisnis. COBIT 5 memberikan panduan untuk:
                </p>
                <ul>
                    <li>Memenuhi kebutuhan pemangku kepentingan.</li>
                    <li>Meliputi seluruh organisasi.</li>
                    <li>Menerapkan kerangka kerja terpadu.</li>
                    <li>Menggunakan pendekatan holistik.</li>
                    <li>Mengelola risiko dan meningkatkan nilai IT.</li>
                </ul>
                <p>
                    Framework ini membantu organisasi menciptakan nilai dari IT dengan mengoptimalkan sumber daya 
                    dan memitigasi risiko. COBIT 5 juga mendukung kepatuhan terhadap regulasi dan peningkatan efisiensi operasional.
                </p>
            </div>
        </div>
    </div>
</div>
                    <!--    end row -->

                </div>
                <!-- end container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>

        </div>
        <!-- end main content-->
    </div>
    <!-- end layout-wrapper -->
    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>
</body>

</html>