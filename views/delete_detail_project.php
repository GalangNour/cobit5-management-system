<?php
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM pengujian WHERE id_pengujian = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman sebelumnya setelah berhasil menghapus
        echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = 'detail_project.php';
              </script>";
    } else {
        // Pesan error jika query gagal
        echo "<script>
                alert('Gagal menghapus data');
                window.location.href = 'detail_project.php';
              </script>";
    }

    $stmt->close();
} else {
    // Jika 'id' tidak ditemukan, redirect ke halaman utama
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = 'detail_project.php';
          </script>";
}

$conn->close();
?>