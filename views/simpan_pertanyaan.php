<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $perspektif_id = $_POST['perspektif_id'];
    $level = $_POST['level'];
    $praktik_dasar = $_POST['praktik_dasar'];
    $praktik_umum = $_POST['praktik_umum'];

    $query = "INSERT INTO questions (perspektif_id, level, praktik_dasar, praktik_umum) VALUES ('$perspektif_id', '$level', '$praktik_dasar', '$praktik_umum')";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Pertanyaan berhasil ditambahkan!'); window.location.href='questions.php';</script>";
        header("Location: questions.php?message=success");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        // echo "<script>alert('Gagal menambahkan pertanyaan!'); window.location.href='tambah_pertanyaan.php';</script>";
    }
}
?>