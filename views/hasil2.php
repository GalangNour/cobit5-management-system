<?php
include '../config/database.php';

// Query untuk mendapatkan semua perspektif_id yang ada
$perspektif_query = mysqli_query($conn, "SELECT DISTINCT perspektif_id FROM questions");

// Initialize arrays
$results = [];
$perspektif_names = [];
$final_levels = [];

// Iterate over each perspektif_id
while ($perspektif_row = mysqli_fetch_assoc($perspektif_query)) {
    $perspektif_id = $perspektif_row['perspektif_id'];

    // Query untuk mendapatkan nama perspektif
    $name_query = mysqli_query($conn, "SELECT nama_perspektif FROM perspektif WHERE id_perspektif = '$perspektif_id'");
    $name_row = mysqli_fetch_assoc($name_query);
    $perspektif_name = $name_row['nama_perspektif'];
    $perspektif_names[$perspektif_id] = $perspektif_name;

    // Query untuk mendapatkan semua level yang ada pada perspektif tertentu
    $level_query = mysqli_query($conn, "SELECT DISTINCT level FROM questions WHERE perspektif_id = '$perspektif_id'");

    $level_results = [];

    // Process each level
    while ($level_row = mysqli_fetch_assoc($level_query)) {
        $level = $level_row['level'];

        // Query untuk mendapatkan data pertanyaan pada level tertentu
        $question_query = mysqli_query($conn, "SELECT id_question, exist FROM questions WHERE perspektif_id = '$perspektif_id' AND level = '$level'");

        // Initialize variables for calculation
        $total_questions = 0;
        $completed_questions = 0;

        // Fetch data and calculate
        $data = [];
        while ($row = mysqli_fetch_assoc($question_query)) {
            $exist_value = $row['exist'];
            $display_exist = is_null($exist_value) || $exist_value === '' ? 'Belum dilakukan pengujian' : $exist_value;

            // Add data to array
            $data[] = [
                'id_question' => $row['id_question'],
                'exist' => $display_exist
            ];
            
            $total_questions++;
            if ($exist_value == 100) {
                $completed_questions++;
            }
        }

        // Calculate percentage of completion
        if ($total_questions > 0) {
            $completion_percentage = ($completed_questions / $total_questions) * 100;
        } else {
            $completion_percentage = 0;
        }

        // Determine level result
        if ($completion_percentage == 100) {
            $level_result = "Level $level Complete";
            if ($level == '2.2') {
                $level = '2'; // Convert sub-level 2.2 to level 2
            }
            $final_levels[$perspektif_id] = max((int)$level, $final_levels[$perspektif_id] ?? 0);
        } else {
            $level_result = "Level $level Incomplete";
        }

        // Store results for the current level
        $level_results[$level] = [
            'data' => $data,
            'total_questions' => $total_questions,
            'completed_questions' => $completed_questions,
            'completion_percentage' => number_format($completion_percentage, 2),
            'level_result' => $level_result
        ];

        // If level 1 is incomplete, break out of the loop to stop further level checking
        if ($level == '1' && $completion_percentage < 100) {
            $results[$perspektif_id] = [
                'levels' => $level_results,
                'final_result' => "Level 1 Incomplete, stopping further checks"
            ];
            continue 2; // Skip to the next perspektif_id
        }
    }

    // If level 1 was complete, include the results for all levels
    if (!isset($results[$perspektif_id])) {
        $last_level = max(array_keys($level_results));
        $results[$perspektif_id] = [
            'levels' => $level_results,
            'final_result' => "Level $last_level Complete"
        ];
        // Ensure to handle conversion of level 2.2 to 2
        $final_levels[$perspektif_id] = ($last_level == '2.1' || $last_level == '2.2') ? 2 : (int)$last_level;
    }
}

// Prepare summary for display
$summaries = [];
foreach ($results as $perspektif_id => $data) {
    $last_level = max(array_keys($data['levels']));
    $summaries[] = [
        'perspektif_id' => $perspektif_id,
        'perspektif_name' => $perspektif_names[$perspektif_id],
        'last_level' => ($last_level == '2.1' || $last_level == '2.2') ? 2 : (int)$last_level
    ];
}
// Calculate overall Capability Level using last_level from summaries
$total_levels = array_sum(array_column($summaries, 'last_level'));
$count_perspektifs = count($summaries);
$average_cl = ($count_perspektifs > 0) ? ($total_levels / $count_perspektifs) : 0;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pengecekan Semua Perspektif dan Level</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Pengecekan Semua Perspektif dan Level</h4>
                                </div>
                                <div class="card-body">
                                    <!-- <?php foreach ($results as $perspektif_id => $data) { ?>
                                    <h5>Perspektif ID: <?php echo $perspektif_id; ?></h5>
                                    <?php foreach ($data['levels'] as $level => $result) { ?>
                                    <h5>Level: <?php echo $level; ?></h5>
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pertanyaan</th>
                                                <th>Exist</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($result['data'] as $row) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['id_question']; ?></td>
                                                <td><?php echo $row['exist']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <!-- Display Calculation Explanation 
                                    <div class="mt-4">
                                        <h5>Perhitungan Penyelesaian Level</h5>
                                        <p>Total Pertanyaan: <?php echo $result['total_questions']; ?></p>
                                        <p>Pertanyaan Selesai (Exist = 100):
                                            <?php echo $result['completed_questions']; ?></p>
                                        <p>Persentase Penyelesaian: <?php echo $result['completion_percentage']; ?>%</p>
                                        <p>Hasil Level: <?php echo $result['level_result']; ?></p>
                                    </div>
                                    <hr />
                                    <?php } ?>
                                    <div class="alert alert-info">
                                        <?php echo $data['final_result']; ?>
                                    </div>
                                    <?php } ?> -->

                                    <!-- Summary -->
                                    <div class="mt-4">
                                        <h5>Kesimpulan</h5>
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode Perspektif</th>
                                                    <th>Nama Perspektif</th>
                                                    <th>Level Terakhir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($summaries as $summary) { ?>
                                                <tr>
                                                    <td><?php echo $summary['perspektif_id']; ?></td>
                                                    <td><?php echo $summary['perspektif_name']; ?></td>
                                                    <td><?php echo $summary['last_level']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Display Overall Capability Level Calculation -->
                                    <div class="mt-4">
                                        <h5>Perhitungan Capability Level Keseluruhan</h5>
                                        <p>Total Capability Level: <?php echo number_format($total_levels, 2); ?></p>
                                        <p>Jumlah Perspektif: <?php echo $count_perspektifs; ?></p>
                                        <p>Capability Level Keseluruhan (Rata-rata):
                                            <?php echo number_format($average_cl, 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'partials/footer.php'; ?>
    </div>

    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>