<?php 
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id_users = '$id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $user['password']; // Update jika diisi

    $query = "UPDATE users SET nama = '$nama', email = '$email', password = '$password' WHERE id_users = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: user.php?message=edit-success");
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit User</title>
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
                                    <h4 class="card-title">Tambah User</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                        <a href="user.php" class="btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
