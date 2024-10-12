<?php include '../config/database.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tambah Pertanyaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
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
                                <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Tambah Pertanyaan</h4>
                            </div>
                        </div>
                    </div>
                    <!--    end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form Tambah Pertanyaan</h4>
                                </div>
                                <div class="card-body">
                                    <form action="simpan_pertanyaan.php" method="POST">
                                        <div class="mb-3">
                                            <label for="perspektif_id" class="form-label">Nama Perspektif</label>
                                            <select class="form-select" id="perspektif_id" name="perspektif_id"
                                                required>
                                                <option value="" disabled selected>Pilih Perspektif</option>
                                                <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM perspektif");
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $row['id_perspektif'] . "'>" . $row['nama_perspektif'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="level" class="form-label">Level</label>
                                            <select class="form-select" name="level" required>
                                                <option value="1">1</option>
                                                <option value="2.1">2.1</option>
                                                <option value="2.2">2.2</option>
                                                <option value="3.1">3.1</option>
                                                <option value="3.2">3.2</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="praktik_dasar" class="form-label">Praktik Dasar</label>
                                            <textarea class="form-control" id="praktik_dasar" name="praktik_dasar"
                                                rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="praktik_umum" class="form-label">Praktik Umum</label>
                                            <textarea class="form-control" id="praktik_umum" name="praktik_umum"
                                                rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
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

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
</body>

</html>