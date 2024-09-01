<?php
include '../config/database.php';

// Fetch all perspectives
$get_perspektif = mysqli_query($conn, "SELECT * FROM perspektif");

// Initialize arrays to store results and for calculation
$perspektif_results = [];
$total_level_sum = 0;
$total_processes = 0;

while ($perspektif = mysqli_fetch_assoc($get_perspektif)) {
    $id_perspektif = $perspektif['id_perspektif'];
    $nama_perspektif = $perspektif['nama_perspektif'];
    $kode_perspektif = $perspektif['kode_perspektif'];

    // Initialize level variables
    $current_level = 1;
    $found_level = 1;
    $level_completed = true;

    while ($level_completed) {
        // Query to get the total number of questions and completed questions for the current level
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total_questions,
                                            SUM(CASE WHEN exist = 100 THEN 1 ELSE 0 END) AS completed_questions 
                                        FROM questions 
                                        WHERE perspektif_id = '$id_perspektif' AND level LIKE '$current_level%'");

        // Debugging: Show the result of the query
        $query_result = mysqli_fetch_assoc($query);
        var_dump($query_result);

        $total_questions = $query_result['total_questions'];
        $completed_questions = $query_result['completed_questions'];

        if ($total_questions > 0) {
            $completion_percentage = ($completed_questions / $total_questions) * 100;

            // Debugging: Show the completion percentage
            var_dump($completion_percentage);

            if ($completion_percentage == 100) {
                // Set found_level to current_level
                $found_level = $current_level;

                // Query to check for sub-levels (e.g., 2.1, 2.2 for level 2)
                $sub_levels_query = mysqli_query($conn, "SELECT DISTINCT SUBSTRING_INDEX(level, '.', 2) AS sub_level 
                                                        FROM questions 
                                                        WHERE perspektif_id = '$id_perspektif' 
                                                        AND level LIKE '$current_level.%'");

                // Debugging: Show sub-levels
                var_dump(mysqli_fetch_all($sub_levels_query, MYSQLI_ASSOC));

                // Check if there are sub-levels; if so, increment the current_level
                if (mysqli_num_rows($sub_levels_query) > 0) {
                    $current_level++;
                } else {
                    $level_completed = false;
                }
            } else {
                $level_completed = false;
            }
        } else {
            $level_completed = false;
        }
    }

    // Store results for each perspective
    $perspektif_results[] = [
        'kode_perspektif' => $kode_perspektif,
        'nama_perspektif' => $nama_perspektif,
        'max_level' => $found_level
    ];

    // Debugging: Show perspective results
    var_dump($perspektif_results);

    // Accumulate the total level sum and process count for calculation
    $total_level_sum += $found_level;
    $total_processes++;
}

// Calculate the overall capability level
if ($total_processes > 0) {
    $overall_capability_level = $total_level_sum / $total_processes;
} else {
    $overall_capability_level = 0;
}

// Debugging: Show overall capability level
var_dump($overall_capability_level);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Hasil Penilaian Perspektif</title>
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
                                    <h4 class="card-title">Hasil Penilaian Perspektif</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Proses TI</th>
                                                <th>Detail Proses TI</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1; 
                                            foreach ($perspektif_results as $perspektif) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $perspektif['kode_perspektif']; ?></td>
                                                <td><?php echo $perspektif['nama_perspektif']; ?></td>
                                                <td><?php echo $perspektif['max_level']; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3"><strong>Capability Level Keseluruhan</strong></td>
                                                <td><?php echo number_format($overall_capability_level, 2); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Display Calculation Explanation -->
                                    <div class="mt-4">
                                        <h5>Perhitungan Capability Level Keseluruhan</h5>
                                        <p>𝐶𝐿𝑖 = (∑ 𝑓𝑖.𝑥𝑖) / 𝑛</p>
                                        <p>
                                            Total Capability Level = <?php echo $total_level_sum; ?><br>
                                            Jumlah Proses TI (𝑛) = <?php echo $total_processes; ?><br>
                                            Capability Level Keseluruhan (𝐶𝐿𝑖) =
                                            <?php echo number_format($overall_capability_level, 2); ?>
                                        </p>
                                    </div>

                                    <!-- Conclusion Section -->
                                    <div class="mt-4">
                                        <h5>Kesimpulan</h5>
                                        <p>
                                            Tingkat kemampuan yang dimiliki oleh PT.ABC pada proses TI berikut:
                                        </p>
                                        <ul>
                                            <li>EDM03 (Ensure Risk Optimization)</li>
                                            <li>APO13 (Manage Security)</li>
                                            <li>DSS05 (Manage Security Services)</li>
                                        </ul>
                                        <p>berada pada Level <?php echo number_format($overall_capability_level, 0); ?>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>