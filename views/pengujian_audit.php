<?php 
include '../config/database.php';

// Ambil id_project dari URL dengan validasi
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_project = intval($_GET['id']);
} else {
    header("Location: project.php");
    exit();
}

// Query untuk mengambil data process dan level berdasarkan id_pengujian
$stmt = $conn->prepare("SELECT * FROM pengujian WHERE id_pengujian = ?");
$stmt->bind_param("i", $id_project);
$stmt->execute();
$audit_detail_query = $stmt->get_result();



// Cek apakah data ditemukan
if ($audit_detail_query->num_rows > 0) {
    $audit_detail = $audit_detail_query->fetch_assoc();
    $process = $audit_detail['audit_process'];
    $id_cobit = $audit_detail['id_cobit'];
    $level = $audit_detail['level'];
    $pa = $audit_detail['pa'];
} else {
    echo "<script>Swal.fire('Error', 'Data not found!', 'error').then(function() {
        window.location = 'project.php';
    });</script>";
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
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <script src="../assets/js/pages/layout.js"></script>
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
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

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title">Auditing Ujian</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Process: <span style="background-color: red; color:white; padding: 4px;"><?php echo $process ?></span></h4>
                                    <h4>Level: <span id="level" style="background-color: red; color:white; padding: 4px;"><?php echo $level ?></span></h4><br>

                                    <form id="auditForm" method="post">
                                        <?php 
                                        // Ambil nilai unik PA berdasarkan proses dan level
                                        $pa_query = mysqli_query($conn, "SELECT DISTINCT pa FROM question WHERE process_code = '$process' AND level = '$level'");
                                        
                                        while ($pa_row = mysqli_fetch_assoc($pa_query)) {
                                            $current_pa = $pa_row['pa'];
                                            echo "<h4>PA: <span style='background-color: blue; color:white; padding: 4px;'>$current_pa</span></h4>";
                                            echo "<table class='table table-hover table-bordered table-striped dt-responsive nowrap' style='border-collapse: collapse; border-spacing: 0; width: 100%;'>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Question</th>
                                                            <th>Exist</th>
                                                            <th>Document Evidence</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                            
                                            // Query untuk mengambil pertanyaan berdasarkan `pa` saat ini
                                            $get_data = mysqli_query($conn, "SELECT * FROM question WHERE process_code = '$process' AND level = '$level' AND pa = '$current_pa'");
                                            $no = 1;
                                            while ($display = mysqli_fetch_array($get_data)) {
                                                $question_id = !empty($display['id_question']) ? $display['id_question'] : '-';
                                                $question = !empty($display['question']) ? $display['question'] : '-';

                                                echo "<tr>
                                                        <td>$no</td>
                                                        <td>$question</td>
                                                        <td>
                                                            <input type='checkbox' name='exist[]' value='1' onchange='updateScoreAndLevel(this)'>
                                                        </td>
                                                        <td>
                                                            <textarea name='document_evidence[]'></textarea>
                                                            <input type='hidden' name='score[]' value='0' readonly>
                                                            <input type='hidden' name='level[]' class='level-input' value='N' readonly>
                                                        </td>
                                                        <input type='hidden' name='question_id[]' value='$question_id'>
                                                        <input type='hidden' name='id_project' value='$id_project'>
                                                        <input type='hidden' name='pa[]' value='$current_pa'>
                                                    </tr>";
                                                $no++;
                                            }
                                            echo "</tbody></table>";
                                        }
                                        ?>

                                            </tbody>
                                        </table>
                                        <input type="text" id="totalScore" value="0" readonly disabled>

                                        <input type="hidden" id="totalQuestions" value="0" readonly>

                                        <input type="hidden" id="averageScore" value="0" readonly disabled>

                                        <input type="hidden" id="auditScore" value="0" readonly disabled>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" id="clearStorageButton" class="btn btn-danger">Clear
                                            Storage</button>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
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
            scoreInputs.forEach(function (input) {
                totalScore += parseInt(input.value);
            });

            document.getElementById("totalScore").value = totalScore;
        }

        function countTotalQuestions() {
            var totalQuestions = 0;

            // Count the number of rows in the table
            $('#auditForm tbody tr').each(function() {
                totalQuestions++; // Increment the question count for each row
            });
            console.log("Total Questions:", totalQuestions);

            // Display the total questions in the input field
            document.getElementById("totalQuestions").value = totalQuestions;
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {

        // Handle form submission
        $('#auditForm').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission

            // First, update the total and average score
            updateTotalScore();
            countTotalQuestions();

            // Log total score and total questions
            console.log("Total Score: ", document.getElementById("totalScore").value);
            console.log("Total Questions: ", document.getElementById("totalQuestions").value);

            var totalScore = parseInt(document.getElementById("totalScore").value) || 0;
            var totalQuestions = parseInt(document.getElementById("totalQuestions").value) || 0;

            var averageScore = totalQuestions > 0 ? (totalScore / totalQuestions) : 0;

            // Log the calculated average score
            console.log("Average Score: ", averageScore);

            // Determine status_pa based on the average score
            var status_level = averageScore === 100 ? 'next' : 'stop';

            // Prepare data untuk dikirim
            var scoresArray = [];
            var levelsArray = [];
            var existsArray = [];
            var documentEvidencesArray = [];
            var questionIdsArray = [];
            var paArray = [];


            // Iterasi melalui semua pertanyaan (baris)
            $('#auditForm tbody tr').each(function() {
                var row = $(this);
                var score = row.find('input[name="score[]"]').val(); // Ambil nilai score
                var level = row.find('input[name="level[]"]').val(); // Ambil nilai level
                var exist = row.find('input[name="exist[]"]').prop('checked') ? 1 : 0; // Ambil status checkbox exist
                var documentEvidence = row.find('textarea[name="document_evidence[]"]').val(); // Ambil nilai evidence
                var questionId = row.find('input[name="question_id[]"]').val(); // Ambil ID pertanyaan
                var pa = row.find('input[name="pa[]"]').val(); // Capture the `pa` value for each question


                // Log nilai yang akan dikirim
                // console.log('Score:', score, 'Level:', level, 'Exist:', exist, 'Evidence:', documentEvidence, 'Question ID:', questionId, 'PA:', pa);

                // Tambahkan nilai ke array
                scoresArray.push(score);
                levelsArray.push(level);
                existsArray.push(exist);
                documentEvidencesArray.push(documentEvidence);
                questionIdsArray.push(questionId);
                paArray.push(pa);
            });


            // Send the data via AJAX
            $.ajax({
                url: 'update_level_pa.php', // The PHP script that will process the form data
                method: 'POST',
                data: {
                    id_project: <?php echo $id_project; ?>,
                    status_level: status_level,
                    pa: paArray,
                    scores: scoresArray, // Send the scores array
                    levels: levelsArray, // Send the levels array
                    exists: existsArray, // Send the exists array
                    document_evidences: documentEvidencesArray, // Send the document evidences array
                    question_ids: questionIdsArray // Send the question IDs array
                    },
                success: function(response) {
                    console.log(response);
                    // Response is already a JavaScript object
                    if (response.status == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: response.title,
                            text: response.text
                        }).then(function() {
                            window.location.href = response
                                .redirect_url; // Redirect if needed
                        });
                    } else if (response.status == 'success') {

                        // Perbarui tampilan level dan PA
                        $('#level').text(response.new_level);
                        $('#status_level').text(response.status_level);

                        if (response.status_level == 'stop') {
                            // Jika PA adalah 'stop', redirect ke halaman detail_project.php
                            Swal.fire({
                                icon: 'error',
                                title: 'Proses selesai',
                                text: 'Level dan PA telah selesai, akan diarahkan ke detail proyek.'
                            }).then(function() {
                                // Redirect ke detail_project.php dengan id_project yang sesuai
                                localStorage.removeItem('audit_scores');
                                localStorage.removeItem('total_score');
                                localStorage.removeItem('total_questions');

                                // Reset tampilan skor dan jumlah pertanyaan
                                document.getElementById("totalScore").value = 0;
                                document.getElementById("averageScore").value = 0;
                                document.getElementById("totalQuestions").value = 0;
                                window.location.href =
                                    'detail_project.php?id_project=<?php echo $id_cobit; ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Level dan PA berhasil diperbarui',
                                text: 'Level dan PA telah diperbarui ke level ' +
                                    response.new_level + ' dengan PA ' + response.pa
                            }).then(function() {
                                window.location.reload(); // Redirect if needed
                            });
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire('Error', 'Terjadi kesalahan saat mengirim data. (' +
                        textStatus + ')', 'error');
                }

            });
        });
    });
    </script>
</body>

</html>