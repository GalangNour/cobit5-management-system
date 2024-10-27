<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM question WHERE id_question = '$id'");
    $data = mysqli_fetch_assoc($query);
}

if (isset($_POST['update'])) {
    $process_code = $_POST['process_code'];
    $level = $_POST['level'];
    $pa = $_POST['pa'];
    $question = $_POST['question'];
    $description = $_POST['description'];

    $update_query = "UPDATE question SET 
                        process_code = '$process_code', 
                        level = '$level', 
                        pa = '$pa', 
                        question = '$question', 
                        description = '$description' 
                    WHERE id_question = '$id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: question.php?message=edit-success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
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
    <script src="../assets/js/pages/layout.js"></script>
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
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
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Edit Pertanyaan</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="process_code" class="form-label">Process Code</label>
                                            <input type="text" class="form-control" id="process_code"
                                                name="process_code"
                                                value="<?php echo isset($data['process_code']) ? $data['process_code'] : ''; ?>"
                                                placeholder="Masukkan kode proses" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="level" class="form-label">Level</label>
                                            <input type="text" class="form-control" id="level" name="level"
                                                value="<?php echo isset($data['level']) ? $data['level'] : ''; ?>"
                                                placeholder="Masukkan level" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pa" class="form-label">PA</label>
                                            <input type="text" class="form-control" id="pa" name="pa"
                                                value="<?php echo isset($data['pa']) ? $data['pa'] : ''; ?>"
                                                placeholder="Masukkan PA" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="question" class="form-label">Question</label>
                                            <textarea class="form-control" id="question" name="question" rows="3"
                                                placeholder="Masukkan pertanyaan"
                                                required><?php echo isset($data['question']) ? $data['question'] : ''; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                placeholder="Masukkan deskripsi (opsional)"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary">Update
                                            Pertanyaan</button>
                                        <a href="pertanyaan.php" class="btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>