<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Update kolom deleted_at dengan waktu saat ini
    $query = "UPDATE cobit SET deleted_at = NOW() WHERE id_cobit = '$id'";
    
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: project.php?message=delete-success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>