<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id_perspektif = $_GET['id'];
    $get_perspektif = mysqli_query($conn, "SELECT * FROM perspektif WHERE id_perspektif = '$id_perspektif'");
    $perspektif = mysqli_fetch_assoc($get_perspektif);
} else {
    echo "ID Perspektif tidak ditemukan!";
    exit;
}

// Inisialisasi variabel untuk mengatur level dan skor
$current_level = '1';
$next_level = null;
$level_passed = true;

// Logika pengujian skor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scores = $_POST['inputNilai'];
    $total_score = array_sum($scores);
    $question_count = count($scores);
    $average_score = $total_score / $question_count;

    // Logika untuk Level 1
    if ($current_level == '1') {
        if ($average_score >= 51) {
            $next_level = '2.1'; // Lanjut ke Level 2.1
        } else {
            $level_passed = false;
        }
    }

    // Logika untuk Level 2.1
    if ($current_level == '2.1' && $level_passed) {
        if ($average_score >= 51) {
            $next_level = '2.2'; // Lanjut ke Level 2.2
        } else {
            $level_passed = false;
        }
    }

    // Logika untuk Level 2.2
    if ($current_level == '2.2' && $level_passed) {
        if ($average_score < 51) {
            $level_passed = false;
        }
    }
    
    // Update level saat ini dengan level berikutnya
    $current_level = $next_level;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pengujian Perspektif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
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
                                    <h4 class="card-title">Pengujian Perspektif</h4>
                                </div>
                                <div class="card-body">

                                    <!-- Form untuk menginput nilai -->
                                    <form method="POST">
                                        <table id="datatable"
                                            class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <?php if($current_level == '1') {?>
                                                    <th>Praktik Dasar</th>
                                                    <?php } ?>
                                                    <th>Praktik Umum</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                $get_data = mysqli_query($conn, "SELECT * FROM questions WHERE perspektif_id = '$id_perspektif' AND level = '$current_level'");
                                                while ($display = mysqli_fetch_array($get_data)) {
                                                    $id = $display['id_question'];
                                                    $praktik_dasar = $display['praktik_dasar'];
                                                    $praktik_umum = $display['praktik_umum'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <?php if($current_level == '1') {?>
                                                    <td><?php echo $praktik_dasar ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $praktik_umum ?></td>
                                                    <td>
                                                        <input type="text" class="form-control" name="inputNilai[]"
                                                            required>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <!-- Tombol submit -->
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                    <!-- Jika level tidak lulus, tampilkan tabel hasil -->
                                    <?php if (!$level_passed): ?>
                                    <hr>
                                    <h4>Hasil Pengujian</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tujuan Proses</th>
                                                <th colspan="6">Pengelolaan Layanan Keamanan sistem perusahaan</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">EDM 03</th>
                                                <th rowspan="2">Level 0</th>
                                                <th>Level 1</th>
                                                <th colspan="2">Level 2</th>
                                                <th colspan="2">Level 3</th>
                                                <th colspan="2">Level 4</th>
                                                <th colspan="2">Level 5</th>
                                            </tr>
                                            <tr>

                                                <th>PA 1.1</th>
                                                <th>PA 2.1</th>
                                                <th>PA 2.2</th>
                                                <th>PA 3.1</th>
                                                <th>PA 3.2</th>
                                                <th>PA 4.1</th>
                                                <th>PA 4.2</th>
                                                <th>PA 5.1</th>
                                                <th>PA 5.2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Rating</td>
                                                <td>F</td>
                                                <td><?php echo ($current_level == '1') ? 'L' : 'F'; ?></td>
                                                <td><?php echo ($current_level == '2.1') ? 'L' : (($current_level > '1') ? 'F' : ''); ?>
                                                </td>
                                                <td><?php echo ($current_level == '2.2') ? 'L' : (($current_level > '1') ? 'F' : ''); ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
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