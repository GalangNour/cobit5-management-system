<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $process_code = mysqli_real_escape_string($conn, $_POST['process_code']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $pa = mysqli_real_escape_string($conn, $_POST['pa']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Query untuk menyimpan data ke tabel `question`
    $query = "INSERT INTO question (process_code, level, pa, question, description) 
              VALUES ('$process_code', '$level', '$pa', '$question', '$description')";

    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: pertanyaan.php?message=success");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>