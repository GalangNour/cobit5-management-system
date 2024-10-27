<?php
session_start(); // Ensure session is started to access session variables
include '../config/database.php';

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $auditor = $_SESSION['nama']; // Get auditor name from session
    $audit_at = date('Y-m-d H:i:s'); // Set audit_at to current date

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO cobit (name, auditor, audit_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $auditor, $audit_at);

    if ($stmt->execute()) {
        header("Location: project.php?message=success");
    } else {
        header("Location: project.php?message=error");
    }
    
    $stmt->close();
    $conn->close();
}
?>