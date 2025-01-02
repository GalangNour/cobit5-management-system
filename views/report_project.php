<?php
include '../config/database.php'; // Koneksi database

// Validasi jika parameter `id` tersedia
if (isset($_GET['id'])) {
    $id_pengujian = $_GET['id'];
} else {
    echo "<script>
            alert('ID tidak valid.');
            window.history.back();
          </script>";
    exit();
}

// Ambil data dari tabel `audit` berdasarkan `id_pengujian`
$query = "
    SELECT a.*, q.question, p.audit_process 
    FROM audit a 
    JOIN question q ON a.question_id = q.id_question 
    JOIN pengujian p ON a.id_pengujian = p.id_pengujian
    WHERE a.id_pengujian = '$id_pengujian'
";
$result = mysqli_query($conn, $query);

// Periksa jika data ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Tidak ada data untuk ID pengujian ini.');
            window.history.back();
          </script>";
    exit();
}
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Project</title>
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
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title me-2">Detail report untuk pengujian:
                                        <?php echo $row['audit_process']; ?></h4>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered table-hover mt-3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>Question ID</th> -->
                                                <th>Score</th>
                                                <th>Level</th>
                                                <th>Exist</th>
                                                <th>Document Evidence</th>
                                                <!-- <th>Created At</th> -->
                                                <th>Level Audit</th>
                                                <th>PA Audit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $nomor = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $nomor++; ?></td>
                                                <!-- <td><?php echo $row['question_id']; ?></td> -->
                                                <td><?php echo $row['score']; ?></td>
                                                <td><?php echo $row['level']; ?></td>
                                                <td><?php echo $row['exist']; ?></td>
                                                <td><?php echo $row['document_evidence']; ?></td>
                                                <!-- <td><?php echo $row['created_at']; ?></td> -->
                                                <td><?php echo $row['level_audit']; ?></td>
                                                <td><?php echo $row['pa_audit']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="project.php" class="btn btn-secondary">Back to Projects</a>
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