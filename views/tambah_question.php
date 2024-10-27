<?php include '../config/database.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tambah Pertanyaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <h4 class="card-title">Tambah Pertanyaan</h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['submit'])) {
                        $process_code = $_POST['process_code'];
                        $level = $_POST['level'];
                        $pa = $_POST['pa'];
                        $question = $_POST['question'];
                        $description = $_POST['description'];

                        $insert_query = "INSERT INTO question (process_code, level, pa, question, description) VALUES ('$process_code', '$level', '$pa', '$question', '$description')";
                        if (mysqli_query($conn, $insert_query)) {
                            echo "<script>
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Pertanyaan berhasil ditambahkan.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'question.php';
                                    }
                                });
                            </script>";
                        } else {
                            echo "<script>
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menambahkan pertanyaan.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            </script>";
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Pertanyaan</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="process_code" class="form-label">Process Code</label>
                                            <input type="text" class="form-control" id="process_code"
                                                name="process_code" placeholder="Masukkan kode proses" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="level" class="form-label">Level</label>
                                            <input type="text" class="form-control" id="level" name="level"
                                                placeholder="Masukkan level" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pa" class="form-label">PA</label>
                                            <input type="text" class="form-control" id="pa" name="pa"
                                                placeholder="Masukkan PA" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="question" class="form-label">Question</label>
                                            <textarea class="form-control" id="question" name="question" rows="3"
                                                placeholder="Masukkan pertanyaan" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                placeholder="Masukkan deskripsi (opsional)"></textarea>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Tambah
                                            Pertanyaan</button>
                                    </form>

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
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
</body>

</html>