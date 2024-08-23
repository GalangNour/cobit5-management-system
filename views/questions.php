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
                                    <h4 class="card-title">Data Pertanyaan</h4>
                                    <a href="tambah_pertanyaan.php" class="btn btn-primary">Tambah Pertanyaan</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatable"
                                        class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Perspektif</th>
                                                <th>Level</th>
                                                <th>Praktik Dasar</th>
                                                <th>Praktik Umum</th>
                                                <th>Aksi</th>
                                                <!-- <th>Nilai</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                            $no = 1;
                            $get_data = mysqli_query($conn, "select * from questions left join perspektif on perspektif.id_perspektif = questions.perspektif_id");
                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id_question'];
                                $perspektif_id = $display['perspektif_id'];
                                $perspektif = $display['nama_perspektif'];
                                $level = $display['level'];
                                $praktik_dasar = $display['praktik_dasar'];
                                $praktik_umum = $display['praktik_umum'];
                                // $nilai = $display['exist'];
                            ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo !empty($perspektif) ? $perspektif : '-'; ?></td>
                                                <td><?php echo !empty($level) ? $level : '-'; ?></td>
                                                <td><?php echo !empty($praktik_dasar) ? $praktik_dasar : '-'; ?></td>
                                                <td><?php echo !empty($praktik_umum) ? $praktik_umum : '-'; ?></td>
                                                <td>
                                                    <a href="edit_pertanyaan.php?id=<?php echo $id; ?>"
                                                        class="btn btn-warning">Edit</a>
                                                </td>
                                                <!-- <td><?php echo $nilai ?></td> -->
                                                <!-- <td class="text-truncate">
                                                <a href='ubah_barang.php?GetID=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Ubah' id='editbtn' class="btn btn-primary btn-user" ></a>
                                                <a href='delete_barang.php?Del=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Hapus' id='delbtn' class="btn btn-primary btn-user" ></a>                       
                                            </td> -->
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