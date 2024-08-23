<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_question = $_POST['id_question'];
    $perspektif_id = $_POST['perspektif_id'];
    $level = $_POST['level'];
    $praktik_dasar = $_POST['praktik_dasar'];
    $praktik_umum = $_POST['praktik_umum'];

    $query = "UPDATE questions SET perspektif_id = '$perspektif_id', level = '$level', praktik_dasar = '$praktik_dasar', praktik_umum = '$praktik_umum' WHERE id_question = '$id_question'";

    if (mysqli_query($conn, $query)) {
        header("Location: questions.php?message=edit-success");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>