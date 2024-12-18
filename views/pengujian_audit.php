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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Auditing Ujian</h4>
                                </div>
                                <div class="card-body">
                                    <h4>Process : <span style="background-color: red; color:white; padding: 4px;"><?php echo $process?></span></h4>
                                    <h4>Level : <span id="level" style="background-color: red; color:white; padding: 4px;"><?php echo $level?></span></h4>
                                    <h4>PA : <span id="pa" style="background-color: red; color:white; padding: 4px;"><?php echo $pa?></span></h4><br>
                              
                                    <form id="auditForm" method="post">
                                        <table class="table table-hover table-bordered table-striped dt-responsive nowrap"
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
                                                // $get_data = mysqli_query($conn, "SELECT * FROM question WHERE process_code = '$process' AND level = '$level'");
                                                $get_data = mysqli_query($conn, "SELECT * FROM question WHERE process_code = '$process' AND level = '$level' AND pa = '$pa'");
                                                while ($display = mysqli_fetch_array($get_data)) {
                                                    $question_id = !empty($display['id_question']) ? $display['id_question'] : '-';
                                                    $id = !empty($display['id_pengujian']) ? $display['id_pengujian'] : '-';
                                                    $question = !empty($display['question']) ? $display['question'] : '-';
                                                    $level = !empty($display['level']) ? $display['level'] : '-';
                                                    $pa = !empty($display['pa']) ? $display['pa'] : '-';
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
                                                    <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
                                                    <input type="hidden" name="status_pa" value="<?php echo $pa; ?>">
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
                                        <div class="mt-3">
                                            <span><strong>Total Questions: </strong></span>
                                            <input type="text" id="totalQuestions" value="0" readonly disabled>
                                        </div>
                                        <div class="mt-3">
                                            <span><strong>Average Score: </strong></span>
                                            <input type="text" id="averageScore" value="0" readonly disabled>
                                        </div>
                                        <div class="mt-3">
                                            <span><strong>Audit Score: </strong></span>
                                            <input type="text" id="auditScore" value="0" readonly disabled>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        <button type="button" id="clearStorageButton" class="btn btn-danger">Clear Storage</button>
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
        var row = checkbox.parentElement.parentElement;
        var scoreInput = row.querySelector('input[name="score[]"]');
        var levelInput = row.querySelector('input[name="level[]"]');
        var questionId = row.querySelector('input[name="question_id[]"]').value;

        // Update score and level based on checkbox state
        if (checkbox.checked) {
            scoreInput.value = 100;
            levelInput.value = "F";
        } else {
            scoreInput.value = 0;
            levelInput.value = "N";
        }

        // Save current question's state to localStorage
        var scores = JSON.parse(localStorage.getItem('audit_scores')) || {};
        scores[questionId] = { 
            score: parseInt(scoreInput.value, 10), 
            level: levelInput.value 
        };
        localStorage.setItem('audit_scores', JSON.stringify(scores));

        // Recalculate total score and total questions
        updateTotalScore();
    }


    function updateTotalScore() {
        var scores = JSON.parse(localStorage.getItem('audit_scores')) || {};
        var totalScore = 0;
        var questionCount = Object.keys(scores).length;

        Object.values(scores).forEach(item => {
            totalScore += parseInt(item.score, 10) || 0; // Parsing angka dengan fallback 0
        });

        // Simpan total skor dan jumlah pertanyaan ke LocalStorage
        localStorage.setItem('total_score', totalScore);
        // localStorage.setItem('total_questions', questionCount);

        // Tampilkan di UI
        document.getElementById("totalScore").value = totalScore;
        document.getElementById("averageScore").value = questionCount > 0 ? (totalScore / questionCount).toFixed(2) : 0;
        document.getElementById("auditScore").value = auditScore.value;

    }

    function countTotalQuestions() {
    // Count the number of rows in the tbody of the questions table
    var currentQuestionCount = document.querySelectorAll('tbody tr').length;

    // Retrieve the existing total from localStorage
    var existingTotal = parseInt(localStorage.getItem('total_questions')) || 0; // Default to 0 if not found

    // Update the total questions count
    var newTotal = existingTotal + currentQuestionCount;

    // Store the new total questions in localStorage
    localStorage.setItem('total_questions', newTotal);

    // Update the total questions input
    document.getElementById("totalQuestions").value = newTotal; 
}
function displayTotalQuestions() {
    var totalQuestions = localStorage.getItem('total_questions') || 0; // Default to 0 if not found
    document.getElementById("totalQuestions").value = totalQuestions; // Update the total questions input
}

document.getElementById('clearStorageButton').addEventListener('click', function () {
    // Hapus semua data dari localStorage
    localStorage.removeItem('audit_scores');
    localStorage.removeItem('total_score');
    localStorage.removeItem('total_questions');

    // Reset tampilan skor dan jumlah pertanyaan
    document.getElementById("totalScore").value = 0;
    document.getElementById("averageScore").value = 0;
    document.getElementById("totalQuestions").value = 0;

    // Hapus checkbox yang dicentang dan reset level dan score input
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
    document.querySelectorAll('input[name="score[]"]').forEach(scoreInput => scoreInput.value = 0);
    document.querySelectorAll('input[name="level[]"]').forEach(levelInput => levelInput.value = 'N');

    // Beri notifikasi kepada pengguna
    Swal.fire({
        icon: 'success',
        title: 'Storage Cleared',
        text: 'Local storage and form values have been reset.'
    });
});
    
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function () {
    // Handle form submission
    $('#auditForm').on('submit', function (e) {
        e.preventDefault(); // Prevent normal form submission
        
        // First, update the total and average score
        updateTotalScore();
        countTotalQuestions();
        
        
        // Now we can get the updated average score
        

        // Ambil data dari LocalStorage
        var scores = JSON.parse(localStorage.getItem('audit_scores')) || {};
        var totalScore = localStorage.getItem('total_score') || 0;
        var questionCount = localStorage.getItem('total_questions') || 0;

        var averageScore = totalScore / questionCount

        // Determine status_pa based on the average score
        var status_pa = averageScore === 100 ? 'next' : 'stay';


        // Send the data via AJAX
        $.ajax({
            url: 'update_level_pa.php', // The PHP script that will process the form data
            method: 'POST', 
            data: {
                id_project: <?php echo $id_project; ?>,
                status_pa: status_pa,
                // total_score: total_score,
                // total_questions: total_questions,
                
            },
            success: function (response) {
                // Response is already a JavaScript object
                if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: response.title,
                        text: response.text
                    }).then(function () {
                        window.location.href = response.redirect_url; // Redirect if needed
                    });
                } else if (response.status === 'success') {
                    $('#level').text(response.new_level);
                    $('#pa').text(response.pa);
                    Swal.fire({
                        icon: 'success',
                        title: 'Level dan PA berhasil diperbarui',
                        text: 'Level dan PA telah diperbarui ke level ' + response.new_level + ' dengan PA ' + response.pa
                    }).then(function () {
                        window.location.reload(); // Redirect if needed
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data. (' + textStatus + ')', 'error');
            }
        });
    });
    // Count total questions and display on page load
    displayTotalQuestions();
});


</script>
</body>
</html>