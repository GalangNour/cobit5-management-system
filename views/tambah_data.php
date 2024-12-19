<?php
session_start(); // Ensure session is started to access session variables
include '../config/database.php'; 
date_default_timezone_set('Asia/Jakarta'); // Set timezone to Asia/Jakarta

// Ambil id_project dari URL
if (isset($_GET['id_project'])) {
    $id_project = $_GET['id_project'];
} else {
    // Jika id_project tidak ada di URL, redirect atau tampilkan pesan error
    header("Location: project.php");
    exit();
}

// Query untuk mengambil semua process_code dan status PA
$query = "
    SELECT q.process_code
    FROM question q
    WHERE q.process_code NOT IN (
        SELECT p.audit_process
        FROM pengujian p
        WHERE p.id_cobit = '$id_project'
    )
    GROUP BY q.process_code";

$process_codes = mysqli_query($conn, $query);

// Check for query errors
if (!$process_codes) {
    die("Error executing query: " . mysqli_error($conn));
}
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
                                <h4 class="mb-0">Data Project Audit Process</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="tambah_data_action.php">
                                        <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Audit Process</label>
                                            <select class="form-select" id="audit_process" name="audit_process" required>
                                                <option value="" disabled selected>Pilih Audit Process</option>
                                                <?php 
                                                while ($row = mysqli_fetch_assoc($process_codes)) {
                                                    echo "<option value='".$row['process_code']."'>".$row['process_code']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
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