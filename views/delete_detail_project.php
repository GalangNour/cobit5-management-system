<?php
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah parameter 'id' dan 'id_project' ada di URL
if (isset($_GET['id']) && isset($_GET['id_project'])) {
    $id = $_GET['id'];
    $id_project = $_GET['id_project'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM pengujian WHERE id_pengujian = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman detail_project setelah berhasil menghapus
        echo "<script>
                alert('Hapus data berhasil');
                window.location.href = 'detail_project.php?id_project=$id_project';
              </script>";
        // header("Location: detail_project.php?id_project=$id_project&message=delete-success");
        // exit();
    } else {
        // Pesan error jika query gagal
        echo "<script>
                alert('Gagal menghapus data');
                window.location.href = 'detail_project.php?id_project=$id_project';
              </script>";
    }

    $stmt->close();
} else {
    // Jika 'id' atau 'id_project' tidak ditemukan, redirect ke halaman project
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = 'project.php';
          </script>";
}

$conn->close();
?>
