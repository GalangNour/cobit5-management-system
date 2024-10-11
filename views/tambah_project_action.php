<?php
session_start(); // Ensure session is started to access session variables
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $auditor = $_SESSION['name']; // Get auditor name from session
    $audit_at = date('Y-m-d'); // Set audit_at to current date

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO cobit (name, auditor, audit_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $auditor, $audit_at);

    if ($stmt->execute()) {
        header("Location: index.php?message=success");
    } else {
        header("Location: index.php?message=error");
    }
    
    $stmt->close();
    $conn->close();
}
?>