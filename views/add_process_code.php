<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $process_code = mysqli_real_escape_string($conn, $_POST['process_code']);

    // Query untuk menyimpan data ke tabel `question`
    $query = "INSERT INTO process_code (nama_process_code) 
              VALUES ('$process_code')";

    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: process_code.php?message=success");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>