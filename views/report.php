<?php
include '../config/database.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Jika id_project tidak ada di URL, redirect atau tampilkan pesan error
    header("Location: project.php");
    exit();
}

$total_fi_xi = 0; // To store the sum of fi * xi
$total_items = 0; // To count the total number of items
$calculation_steps = ''; // To store detailed calculation steps

$get_data = mysqli_query($conn, "SELECT * FROM pengujian WHERE id_cobit = '$id'");

// Loop through the retrieved data
while ($display = mysqli_fetch_array($get_data)) {
    $fi = !empty($display['frequency']) ? $display['frequency'] : 1; // Assuming frequency (f_i) exists
    $xi = !empty($display['level']) ? $display['level'] : 0; // Level (x_i)
    
    // Calculate sum of f_i * x_i
    $total_fi_xi += $fi * $xi;
    $total_items++;
    
    // Append each step to the calculation string
    $calculation_steps .= "f_i: $fi, x_i: $xi, f_i * x_i = " . ($fi * $xi) . "<br>";
}

// Avoid division by zero
if ($total_items > 0) {
    $capability_level = $total_fi_xi / $total_items;
} else {
    $capability_level = 0;
}

// Fetching details from 'pengujian' table
$get_pengujian = mysqli_query($conn, "SELECT * FROM pengujian WHERE id_cobit = '$id'");

// Fetching related audit details from 'audit' table based on 'id_pengujian'

if ($pengujian_data = mysqli_fetch_array($get_pengujian)) {
    $id_pengujian = $pengujian_data['id_pengujian']; // Get id_pengujian from pengujian
    // Fetch audit details using id_pengujian
    $get_audit = mysqli_query($conn, "SELECT * FROM audit WHERE id_pengujian = '$id_pengujian'");
} else {
    echo "No matching pengujian found!";
    exit();
}

 ?>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                            </div>
                        </div>
                    </div>
                    <!-- <?php var_dump($pengujian_data); // Menampilkan isi dari $pengujian_data?> -->
                    <!--    end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Audit Testing</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Audit Process</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                        $no = 1;
                        $get_data = mysqli_query($conn, "SELECT * FROM pengujian where id_cobit = '$id'");

                        // Loop through each question and display data
                        while ($display = mysqli_fetch_array($get_data)) {
                            $id = !empty($display['id_pengujian']) ? $display['id_pengujian'] : '-';
                            $audit_process = !empty($display['audit_process']) ? $display['audit_process'] : '-';
                            $description = !empty($display['description']) ? $display['description'] : '-';
                            $level = !empty($display['level']) ? $display['level'] : '-';
                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $audit_process; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td><?php echo $level; ?></td>
                                            </tr>
                                            <?php
                            $no++;
                        }
                        ?>
                                            <tr>
                                                <td colspan="3"><strong>Secara keseluruhan level tata kelola anda ada di
                                                        level :
                                                    </strong></td>
                                                <td><strong> <?php echo round($capability_level, 2); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <div class="mt-4">
                                        <h5>Capability Level Calculation:</h5>
                                        <p><?php echo $calculation_steps; ?></p>
                                        <p>Total: ∑(f_i * x_i) = <?php echo $total_fi_xi; ?></p>
                                        <p>n (Total Items): <?php echo $total_items; ?></p>
                                        <p>
                                        </p>
                                    </div> -->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Report Detail</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Report Details -->
                                    <h5 class="mt-3">Pengujian Information</h5>
                                    <?php
                $get_pengujian = mysqli_query($conn, "SELECT * FROM pengujian WHERE id_cobit = '$id'");
                
                if (mysqli_num_rows($get_pengujian) > 0) {
                    while ($pengujian = mysqli_fetch_array($get_pengujian)) {
                        $audit_process = !empty($pengujian['audit_process']) ? $pengujian['audit_process'] : '-';
                        $description = !empty($pengujian['description']) ? $pengujian['description'] : '-';
                        $level = !empty($pengujian['level']) ? $pengujian['level'] : '-';
                        ?>
                                    <p><strong>Audit Process:</strong> <?php echo $audit_process; ?></p>
                                    <p><strong>Description:</strong> <?php echo $description; ?></p>
                                    <p><strong>Level:</strong> <?php echo $level; ?></p>
                                    <?php
                        
                        // Fetch audit details using id_pengujian
                        $id_pengujian = $pengujian['id_pengujian'];
                        $get_audit = mysqli_query($conn, "SELECT * FROM audit WHERE id_pengujian = '$id_pengujian'");
                        
                        // Audit Details
                        ?>
                                    <h5 class="mt-4">Audit Details</h5>
                                    <table class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question ID</th>
                                                <th>Score</th>
                                                <th>Level</th>
                                                <th>Document Evidence</th>
                                                <th>Level Audit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                            $no = 1;
                            if (mysqli_num_rows($get_audit) > 0) {
                                while ($audit = mysqli_fetch_array($get_audit)) {
                                    $question_id = !empty($audit['question_id']) ? $audit['question_id'] : '-';
                                    $score = !empty($audit['score']) ? $audit['score'] : '-';
                                    $level_audit = !empty($audit['level_audit']) ? $audit['level_audit'] : '-';
                                    $document_evidence = !empty($audit['document_evidence']) ? $audit['document_evidence'] : '-';
                                    ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $question_id; ?></td>
                                                <td><?php echo $score; ?></td>
                                                <td><?php echo $level_audit; ?></td>
                                                <td><?php echo $document_evidence; ?></td>
                                                <td><?php echo $level_audit; ?></td>
                                            </tr>
                                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No audit details found.</td></tr>";
                            }
                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                    }
                } else {
                    echo "<p>No pengujian information available.</p>";
                }
                ?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


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