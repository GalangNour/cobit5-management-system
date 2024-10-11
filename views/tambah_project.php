<?php 
session_start(); // Ensure session is started to access session variables
include '../config/database.php'; 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tambah Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div id="layout-wrapper">

        <?php include 'partials/topbar.php'; ?>
        <?php include 'partials/sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Tambah Project</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="tambah_project_action.php">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <!-- Hidden auditor input -->
                                        <input type="hidden" name="auditor" value="admin">

                                        <input type="hidden" name="audit_at" value="<?php echo date('Y-m-d'); ?>">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="index.php" class="btn btn-secondary">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- end layout-wrapper -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>