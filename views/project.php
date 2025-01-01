<?php 
include '../config/database.php';
session_start();
$role = $_SESSION['role']; 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Project</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div id="layout-wrapper">


        <?php include 'partials/topbar.php'; ?>


        <?php include 'partials/sidebar.php'; ?>

        <!-- Start right Content here -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php
                    if (isset($_GET['message'])) {
                        $messages = [
                            'success' => 'Pertanyaan berhasil ditambahkan.',
                            'edit-success' => 'Pertanyaan berhasil diperbarui.',
                            'success-data' => 'Data Project berhasil diperbarui.'
                        ];
                        if (array_key_exists($_GET['message'], $messages)) {
                            echo "<script>
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: '{$messages[$_GET['message']]}',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            </script>";
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Data Project</h4>
                                <?php if ($role != 'auditor') { ?>
                                <a href="tambah_project.php" class="btn btn-primary">Tambah Project</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--    end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Auditor</th>
                                                <th>Audit At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $get_data = mysqli_query($conn, "SELECT * FROM cobit WHERE deleted_at IS NULL");
                                            while ($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_cobit'] ?? '-';
                                                $name = $display['name'] ?? '-';
                                                $auditor = $display['auditor'] ?? '-';
                                                $auditat = $display['audit_at'] ?? '-';
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $auditor; ?></td>
                                                <td><?php echo $auditat; ?></td>
                                                <td>
                                                    <a href="report.php?id=<?php echo $id; ?>" class="btn btn-info">Report</a>
                                                    <a href="detail_project.php?id_project=<?php echo $id; ?>" class="btn btn-primary">Audit</a>
                                                    <?php if ($role != 'auditor') { ?>
                                                    <a href="delete_project.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">Delete</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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


    <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Responsive examples -->
    <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- Datatable init js -->
    <script src="../assets/js/pages/datatables-base.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
</body>

</html>