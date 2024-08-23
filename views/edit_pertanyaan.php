<?php
include '../config/database.php';

$id = $_GET['id'];
$query = "SELECT * FROM questions WHERE id_question = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);

$perspektif_id = $data['perspektif_id'];
$level = $data['level'];
$praktik_dasar = $data['praktik_dasar'];
$praktik_umum = $data['praktik_umum'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Pertanyaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Pertanyaan</h4>
                            </div>
                            <div class="card-body">
                                <form action="proses_edit_pertanyaan.php" method="POST">
                                    <input type="hidden" name="id_question" value="<?php echo $id; ?>">
                                    <div class="mb-3">
                                        <label for="perspektif_id" class="form-label">Nama Perspektif</label>
                                        <select name="perspektif_id" class="form-select">
                                            <!-- Ambil data perspektif dari database untuk mengisi dropdown -->
                                            <?php
                                        $get_perspektif = mysqli_query($conn, "SELECT * FROM perspektif");
                                        while($row = mysqli_fetch_array($get_perspektif)) {
                                            $selected = ($row['id_perspektif'] == $perspektif_id) ? "selected" : "";
                                            echo "<option value='".$row['id_perspektif']."' $selected>".$row['nama_perspektif']."</option>";
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <select name="level" class="form-select">
                                            <option value="1" <?php if($level == '1') echo 'selected'; ?>>1</option>
                                            <option value="2.1" <?php if($level == '2.1') echo 'selected'; ?>>2.1
                                            </option>
                                            <option value="2.2" <?php if($level == '2.2') echo 'selected'; ?>>2.2
                                            </option>
                                            <option value="3.1" <?php if($level == '3.1') echo 'selected'; ?>>3.1
                                            </option>
                                            <option value="3.2" <?php if($level == '3.2') echo 'selected'; ?>>3.2
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="praktik_dasar" class="form-label">Praktik Dasar</label>
                                        <input type="text" class="form-control" name="praktik_dasar"
                                            value="<?php echo $praktik_dasar; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="praktik_umum" class="form-label">Praktik Umum</label>
                                        <input type="text" class="form-control" name="praktik_umum"
                                            value="<?php echo $praktik_umum; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div> <!-- end container-fluid -->
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>