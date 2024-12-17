<?php
include '../config/database.php';

header('Content-Type: application/json');

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_project = $_POST['id_project'] ?? null;
    $status_pa = $_POST['status_pa'] ?? null;
    $scores = $_POST['score'] ?? [];
    $levels = $_POST['level'] ?? [];
    $exists = $_POST['exist'] ?? [];
    $documentEvidences = $_POST['document_evidence'] ?? [];
    $question_ids = $_POST['question_id'] ?? [];
    
    // Validasi input
    if (is_null($id_project) || is_null($status_pa)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
        exit();
    }

    // Ambil detail proyek dari database
    $stmt = $conn->prepare("SELECT * FROM pengujian WHERE id_pengujian = ?");
    $stmt->bind_param("i", $id_project);
    $stmt->execute();
    $audit_detail_query = $stmt->get_result();

    // Cek apakah data ditemukan
    if ($audit_detail_query->num_rows > 0) {
        $audit_detail = $audit_detail_query->fetch_assoc();
        $process = $audit_detail['audit_process'];
        $level = $audit_detail['level'];
        $pa = $audit_detail['pa'];
    } else {
        echo "<script>Swal.fire('Error', 'Data not found!', 'error').then(function() {
            window.location = 'project.php';
        });</script>";
        exit();
    }

    // Proses penyimpanan nilai audit
    $insertQuery = $conn->prepare("INSERT INTO audit (id_pengujian, question_id, score, level, exist, document_evidence, level_audit, pa_audit) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($scores as $index => $score) {
        $question_id = $question_ids[$index];
        $questionLevel = $levels[$index] ?? 'N';
        $existValue = $exists[$index] ?? 0;
        $documentEvidence = $documentEvidences[$index] ?? '';

        $insertQuery->bind_param(
            "iiisisss",
            $id_project,
            $question_id,
            $score,
            $questionLevel,
            $existValue,
            $documentEvidence,
            $level,
            $pa
        );

        if (!$insertQuery->execute()) {
            error_log("Error: " . $insertQuery->error);
        }
    }

    // Handle level and PA updates
    if (isset($id_project) && isset($status_pa)) {
        // Mengambil level dan PA yang ada
        $level_query = $conn->prepare("SELECT level, pa FROM pengujian WHERE id_pengujian = ?");
        $level_query->bind_param("i", $id_project);
        $level_query->execute();
        $level_result = $level_query->get_result();
        $level_row = $level_result->fetch_assoc();
        $current_level = $level_row['level'];
        $current_pa = $level_row['pa'];

        // Debugging: Log the current level and PA
        error_log("Current level: " . $current_level . ", Current PA: " . $current_pa);

        // Add debug log for status_pa
        error_log("Received status_pa: " . $status_pa);

        $new_level = $current_level;
        $new_pa = $current_pa;

        // Logika kenaikan PA dan level
        if (isset($status_pa)) {
            if ($current_level == 1) {
                // Jika level 1 selesai, naik ke level 2 PA 2.1
                $new_level = 2;
                $new_pa = '2.1';
            } elseif ($current_level == 2 &&  $status_pa == 'next') {
                if ($current_pa == '2.1') {
                    $new_pa = '2.2'; // Pindah ke PA 2.2
                } elseif ($current_pa == '2.2') {
                    $new_level = 3; // Naik ke level 3
                    $new_pa = '3.1'; // Mulai PA 3.1
                }
            } elseif ($current_level == 3 &&  $status_pa == 'next') {
                if ($current_pa == '3.1') {
                    $new_pa = '3.2'; // Pindah ke PA 3.2
                } elseif ($current_pa == '3.2') {
                    $new_level = 4; // Naik ke level 4
                    $new_pa = '4.1'; // Mulai PA 4.1
                }
            } elseif ($current_level == 4) {
                if ($current_pa == '4.1') {
                    $new_pa = '4.2'; // Pindah ke PA 4.2
                } elseif ($current_pa == '4.2') {
                    $new_level = 5; // Naik ke level 5
                    $new_pa = '5.1'; // Mulai PA 5.1
                }
            } elseif ($current_level == 5) {
                if ($current_pa == '5.1') {
                    $new_pa = '5.2'; // Pindah ke PA 5.2
                } elseif ($current_pa == '5.2') {
                    $new_pa = 'stop'; // Stop
                }
            }
        } else {
            // If status_pa is not 'next', keep current PA and level
            $new_level = $current_level;
        }

        // Logika untuk memperbarui PA dan Level
        $update_level_pa = $conn->prepare("UPDATE pengujian SET level = ?, pa = ? WHERE id_pengujian = ?");
        $update_level_pa->bind_param("ssi", $new_level, $new_pa, $id_project);

        if ($update_level_pa->execute()) {
            $response = [
                'status' => 'success',
                'new_level' => $new_level,
                'pa' => $new_pa
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error updating level and PA: ' . $update_level_pa->error
            ];
        }

    }

    echo json_encode($response);
}
?>
