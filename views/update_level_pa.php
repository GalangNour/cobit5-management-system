<?php
include '../config/database.php';

header('Content-Type: application/json');

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_project = $_POST['id_project'] ?? null;
    $status_level = $_POST['status_level'] ?? null;
    $pa = $_POST['pa'] ?? [];
    $scores = $_POST['scores'] ?? [];
    $levels = $_POST['levels'] ?? [];
    $exists = $_POST['exists'] ?? [];
    $documentEvidences = $_POST['document_evidences'] ?? [];
    $question_ids = $_POST['question_ids'] ?? [];

    // error_log("Received data:");
    // error_log("id_project: " . var_export($id_project, true));
    error_log("status_level: " . var_export($status_level, true));
    // error_log("scores: " . var_export($scores, true));
    error_log("Pa: " . var_export($pa, true));
    // error_log("levels: " . var_export($levels, true));
    // error_log("exists: " . var_export($exists, true));
    // error_log("document_evidences: " . var_export($documentEvidences, true));
    // error_log("question_ids: " . var_export($question_ids, true));

    // Validasi input
    if (is_null($id_project)) {
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
            $paValue = $pa[$index];


            $insertQuery->bind_param(
                "iiisisss",
                $id_project,
                $question_id,
                $score,
                $questionLevel,
                $existValue,
                $documentEvidence,
                $level,
                $paValue,
            );

        if (!$insertQuery->execute()) {
            // error_log("Insert Query Error: " . $insertQuery->error);
            $insertSuccess = false;
        }
    }

    // Handle level updates
    if ($insertSuccess && isset($id_project)) {
        // Mengambil level saat ini
        $level_query = $conn->prepare("SELECT level FROM pengujian WHERE id_pengujian = ?");
        $level_query->bind_param("i", $id_project);
        $level_query->execute();
        $level_result = $level_query->get_result();
        $level_row = $level_result->fetch_assoc();
        $current_level = $level_row['level'];

        // Debugging: Log the current level
        error_log("Current level: " . $current_level);

        $new_level = $current_level;

        // Logika kenaikan level
        if (isset($status_level) && $status_level == 'next') {
            if ($current_level < 5) { // Maksimal level adalah 5
                $new_level = $current_level + 1;
            }
        }else{
            $status_level = "stop";
            $new_level = $current_level;
        }

        // Logika untuk memperbarui level
        $update_level = $conn->prepare("UPDATE pengujian SET level = ?, pa = ? WHERE id_pengujian = ?");
        $update_level->bind_param("ssi", $new_level, $status_level, $id_project);

        if ($update_level->execute()) {
            $response = [
                'status' => 'success',
                'status_level' => $status_level,
                'new_level' => $new_level
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error updating level: ' . $update_level->error
            ];
        }
    }

    echo json_encode($response);
}
?>
