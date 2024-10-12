<?php 
include '../config/database.php';

// Ambil id_project dari URL
if (isset($_GET['id'])) {
    $id_project = mysqli_real_escape_string($conn, $_GET['id']); // Escaping to prevent SQL injection
} else {
    // Jika id_project tidak ada di URL, redirect atau tampilkan pesan error
    header("Location: project.php");
    exit();
}

// Query untuk mengambil data process dan level berdasarkan id_pengujian
$audit_detail_query = mysqli_query($conn, "SELECT * FROM pengujian WHERE id_pengujian = '$id_project'");

// Cek apakah data ditemukan
if ($audit_detail_query && mysqli_num_rows($audit_detail_query) > 0) {
    $audit_detail = mysqli_fetch_assoc($audit_detail_query);
    $process = $audit_detail['audit_process'];
    $level = $audit_detail['level'];
} else {
    // Jika data tidak ditemukan, redirect atau tampilkan pesan error
    echo "<script>Swal.fire('Error', 'Data not found!', 'error').then(function() {
        window.location = 'project.php';
    });</script>";
    exit();
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai dari form
    $scores = isset($_POST['score']) ? $_POST['score'] : [];
    $levels = isset($_POST['level']) ? $_POST['level'] : [];
    $exists = isset($_POST['exist']) ? $_POST['exist'] : []; // Exist values
    $documentEvidences = isset($_POST['document_evidence']) ? $_POST['document_evidence'] : []; // Document Evidence values
    $questions_count = count($scores);
    $question_ids = $_POST['question_id'];

    // Hitung total score
    $totalScore = array_sum($scores);
    // Hitung rata-rata score
    $averageScore = $questions_count > 0 ? $totalScore / $questions_count : 0;

    // Periksa apakah level sudah pernah dinilai
    $checkExistingQuery = "SELECT * FROM audit WHERE id_pengujian = '$id_project' AND level_audit = '$level'";
    $result = mysqli_query($conn, $checkExistingQuery);

    // Jika level sudah pernah dinilai, tampilkan pesan error
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Level Sudah Dinilai',
                text: 'Anda tidak bisa menilai dua kali!',
            }).then(function() {
                window.location.href = 'project.php';
            });
        });
    </script>";
    } else {
        // Jika level belum dinilai, lanjutkan dengan penyimpanan
        foreach ($scores as $index => $score) {
            $question_id = $question_ids[$index]; // Ambil question_id sesuai dengan indeks
            $questionLevel = isset($levels[$index]) ? $levels[$index] : 'N'; // Default to 'N' if not set
            $existValue = isset($exists[$index]) ? $exists[$index] : 0; // Default to 0 if not set
            $documentEvidence = isset($documentEvidences[$index]) ? mysqli_real_escape_string($conn, $documentEvidences[$index]) : ''; // Escape for SQL

            // Prepare the INSERT query
            $insertAuditQuery = "INSERT INTO audit (id_pengujian, question_id, score, level, exist, document_evidence, level_audit) 
                                VALUES ('$id_project', '$question_id', '$score', '$questionLevel', '$existValue', '$documentEvidence', '$level')";
            
            // Execute the query
            if (!mysqli_query($conn, $insertAuditQuery)) {
                // Handle error (you can log the error)
                error_log("Error: " . mysqli_error($conn));
            }
        }

        // Cek apakah rata-rata score mencapai 100
        if ($averageScore == 100) {
            // Update level jika rata-rata score 100
            $update_level = "UPDATE pengujian SET level = level + 1 WHERE id_pengujian = '$id_project'";
            mysqli_query($conn, $update_level);
        }

        // Redirect atau tampilkan pesan sukses
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Level berhasil diperbarui!',
            }).then(function() {
                window.location.href = 'project.php'; // Redirect ke halaman project setelah klik OK
            });
        });
    </script>";
    }
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    <!--    end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Auditing Ujian</h4>
                                </div>
                                <div class="card-body">
                                    <h4>Process : <span
                                            style="background-color: red; color:white; padding: 4px;"><?php echo $process?></span>
                                        </span>
                                        <h4>Level : <span
                                                style="background-color: red; color:white; padding: 4px;"><?php echo $level?></span>

                                        </h4><br>
                                        <form action="" method="post">
                                            <table
                                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Question</th>
                                                        <th>Exist</th>
                                                        <th>Document Evidence</th>
                                                        <th>Score</th>
                                                        <th>Level</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                            $no = 1;
                            $get_data = mysqli_query($conn, "SELECT * FROM question WHERE process_code = '$process' AND level = '$level'");

                            // Loop through each question and display data
                            while ($display = mysqli_fetch_array($get_data)) {
                                $question_id = !empty($display['id_question']) ? $display['id_question'] : '-';
                                $id = !empty($display['id_pengujian']) ? $display['id_pengujian'] : '-';
                                $question = !empty($display['question']) ? $display['question'] : '-';
                                $level = !empty($display['level']) ? $display['level'] : '-';
                            ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $question; ?></td>
                                                        <td>
                                                            <input type="checkbox" name="exist[]" value="1"
                                                                onchange="updateScoreAndLevel(this)">
                                                        </td>
                                                        <td><textarea name="document_evidence[]"></textarea></td>
                                                        <td>
                                                            <input type="text" name="score[]" value="0" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="level[]" class="level-input"
                                                                value="N" readonly>
                                                        </td>
                                                        <input type="hidden" name="question_id[]"
                                                            value="<?php echo $question_id; ?>">
                                                    </tr>
                                                    <?php
                                $no++;
                            }
                            ?>
                                                </tbody>
                                            </table>
                                            <div class="mt-3">
                                                <span><strong>Total Score: </strong></span>
                                                <input type="text" id="totalScore" value="0" readonly disabled>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <script>
                    function updateScoreAndLevel(checkbox) {
                        var scoreInput = checkbox.parentElement.parentElement.querySelector('input[name="score[]"]');
                        var levelInput = checkbox.parentElement.parentElement.querySelector('input[name="level[]"]');

                        if (checkbox.checked) {
                            scoreInput.value = 100;
                            levelInput.value = "F";
                        } else {
                            scoreInput.value = 0;
                            levelInput.value = "N";
                        }

                        updateTotalScore();
                    }

                    function updateTotalScore() {
                        var totalScore = 0;
                        var scoreInputs = document.querySelectorAll('input[name="score[]"]');
                        scoreInputs.forEach(function(input) {
                            totalScore += parseInt(input.value);
                        });

                        document.getElementById('totalScore').value = totalScore;
                    }
                    </script>


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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