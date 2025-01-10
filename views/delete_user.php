<?php 
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id_users = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: user.php?message=delete-success");
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
    }
}
?>
