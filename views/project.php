<?php include '../config/database.php' ; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pertanyaan</title>
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
                if (isset($_GET['message']) && $_GET['message'] == 'success') {
                    echo "<script>
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pertanyaan berhasil ditambahkan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
                if (isset($_GET['message']) && $_GET['message'] == 'edit-success') {
                    echo "<script>
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pertanyaan berhasil diperbarui.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
                if (isset($_GET['message']) && $_GET['message'] == 'success-data') {
                    echo "<script>
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Project berhasil diperbarui.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
                ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <!-- <div>
                                    <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Good Morning, <span
                                            class="text-primary">Jonas!</span></h4>
                                    <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!--    end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Project</h4>
                                    <a href="tambah_project.php" class="btn btn-primary"
                                        style="margin-left: 4px;">Tambah
                                        Project</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatable"
                                        class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

                        // Loop through each question and display data
                        while ($display = mysqli_fetch_array($get_data)) {
                            $id = !empty($display['id_cobit']) ? $display['id_cobit'] : '-';
                            $name = !empty($display['name']) ? $display['name'] : '-';
                            $auditor = !empty($display['auditor']) ? $display['auditor'] : '-';
                            $auditat = !empty($display['audit_at']) ? $display['audit_at'] : '-';
                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $auditor; ?></td>
                                                <td><?php echo $auditat; ?></td>
                                                <td>
                                                    <a href="report.php?id=<?php echo $id; ?>"
                                                        class="btn btn-info">Report</a>
                                                    <a href="detail_project.php?id_project=<?php echo $id; ?>"
                                                        class="btn btn-primary">Audit</a>
                                                    <a href="delete_project.php?id=<?php echo $id; ?>"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">Delete</a>

                                                </td>
                                            </tr>
                                            <?php
                            $no++;
                        }
                        ?>
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