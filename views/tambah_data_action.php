<?php
session_start(); // Ensure session is started to access session variables
include '../config/database.php';

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cobit = $_POST['id_project'];
    $audit_process = $_POST['audit_process'];
    $description = "";
    $level = 1;

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO pengujian (id_cobit, audit_process, description, level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $id_cobit, $audit_process, $description, $level);

    if ($stmt->execute()) {
        header("Location: project.php?message=success-data");
    } else {
        header("Location: project.php?message=error-data");
    }
    
    $stmt->close();
    $conn->close();
}
?>