<?php
include '../config/database.php';

header('Content-Type: application/json');

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_project = $_POST['id_project'] ?? null;
    $status_pa = $_POST['status_pa'] ?? null;
    $scores = $_POST['scores'] ?? [];
    $levels = $_POST['levels'] ?? [];
    $exists = $_POST['exists'] ?? [];
    $documentEvidences = $_POST['document_evidences'] ?? [];
    $question_ids = $_POST['question_ids'] ?? [];
    

    error_log("Received data:");
    error_log("id_project: " . var_export($id_project, true));
    error_log("status_pa: " . var_export($status_pa, true));
    error_log("scores: " . var_export($scores, true));
    error_log("levels: " . var_export($levels, true));
    error_log("exists: " . var_export($exists, true));
    error_log("document_evidences: " . var_export($documentEvidences, true));
    error_log("question_ids: " . var_export($question_ids, true));

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
        echo json_encode(['status' => 'error', 'message' => 'Data not found']);
        exit();
    }

    // Proses penyimpanan nilai audit   
    $insertQuery = $conn->prepare("INSERT INTO audit (id_pengujian, question_id, score, level, exist, document_evidence, level_audit, pa_audit) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $insertSuccess = true;
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
            error_log("Insert Query Error: " . $insertQuery->error);
        } else {
            error_log("Insert Query Success for Question ID: $question_id");
        }

    }

    // Handle level and PA updates
    if ($insertSuccess && isset($id_project) && isset($status_pa)) {
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

        $reset = true;

        // Logika kenaikan PA dan level
        if (isset($status_pa)) {
            if ($current_level == 1 && $status_pa == 'next') {
                // Jika level 1 selesai, naik ke level 2 PA 2.1
                $new_level = 2;
                $new_pa = '2.1';
            }elseif ($current_level == 2) {
                if ($current_pa == '2.1') {
                    $new_pa = '2.2'; // Pindah ke PA 2.2
                    $reset = false;
                } elseif ($current_pa == '2.2' && $status_pa == 'next') {
                    $new_level = 3; // Naik ke level 3
                    $new_pa = '3.1'; // Mulai PA 3.1
                }else{
                    $new_pa = 'stop';
                }
            } elseif ($current_level == 3) {
                if ($current_pa == '3.1') {
                    $new_pa = '3.2'; // Pindah ke PA 3.2
                    $reset = false;
                } elseif ($current_pa == '3.2' && $status_pa == 'next') {
                    $new_level = 4; // Naik ke level 4
                    $new_pa = '4.1'; // Mulai PA 4.1
                }else{
                    $new_pa = 'stop';
                }
            } elseif ($current_level == 4) {
                if ($current_pa == '4.1') {
                    $new_pa = '4.2'; // Pindah ke PA 4.2
                    $reset = false;
                } elseif ($current_pa == '4.2' && $status_pa == 'next') {
                    $new_level = 5; // Naik ke level 5
                    $new_pa = '5.1'; // Mulai PA 5.1
                }else{
                    $new_pa = 'stop';
                }
            } elseif ($current_level == 5) {
                if ($current_pa == '5.1') {
                    $new_pa = '5.2'; // Pindah ke PA 5.2
                } elseif ($current_pa == '5.2'&& $status_pa == 'next') {
                    $new_pa = 'stop'; // Stop
                }
            }
        } else {
            // If status_pa is not 'next', new PA but current level
            $new_level = $current_level;
            $new_pa = $new_pa;
        }

        // Logika untuk memperbarui PA dan Level
        $update_level_pa = $conn->prepare("UPDATE pengujian SET level = ?, pa = ? WHERE id_pengujian = ?");
        $update_level_pa->bind_param("ssi", $new_level, $new_pa, $id_project);

        if ($update_level_pa->execute()) {
            $response = [
                'status' => 'success',
                'new_level' => $new_level,
                'pa' => $new_pa,
                'reset' => $reset,
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