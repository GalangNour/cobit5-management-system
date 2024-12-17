<?php
include '../config/database.php';

header('Content-Type: application/json');

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_project = $_POST['id_project'] ?? [];
    $status_pa = $_POST['status_pa'] ?? [];



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

    $scores = $_POST['score'] ?? [];
    $levels = $_POST['level'] ?? [];
    $exists = $_POST['exist'] ?? [];
    $documentEvidences = $_POST['document_evidence'] ?? [];
    $question_ids = $_POST['question_id'] ?? [];
    // $id_project = $_POST['id_project'] ?? null;
    // $status_pa = $_POST['status_pa'] ?? null;
    
    $questions_count = count($scores);
    $totalScore = array_sum($scores);
    $averageScore = $questions_count > 0 ? $totalScore / $questions_count : 0;

    // Periksa apakah level sudah pernah dinilai
    $checkQuery = $conn->prepare("SELECT * FROM audit WHERE id_pengujian = ? AND level_audit = ? AND pa_audit = ?");
    $checkQuery->bind_param("iss", $id_project, $level, $pa);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
     
        $response = [
            'status' => 'error',
            'title' => 'Level Sudah Dinilai',
            'text' => 'Anda tidak bisa menilai dua kali!',
            'redirect_url' => 'project.php'
        ];
    
    } else {
        // Insert audit data into the database
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
            $level_query = "SELECT level, pa FROM pengujian WHERE id_pengujian = '$id_project'";
            $level_result = mysqli_query($conn, $level_query);
            $level_row = mysqli_fetch_assoc($level_result);
            $current_level = $level_row['level'];
            $current_pa = $level_row['pa'];

            $new_level = $current_level;
            $new_pa = $current_pa;

            // Logika kenaikan PA dan level
            if ($current_level == 1) {
                // Jika level 1 selesai, naik ke level 2 PA 2.1
                $new_level = 2;
                $new_pa = '2.1';
            } elseif ($current_level == 2) {
                // Logika untuk level 2
                if ($current_pa == '2.1' && $status_pa == 'next') {
                    $new_pa = '2.2'; // Pindah ke PA 2.2
                } elseif ($current_pa == '2.2' && $status_pa == 'next') {
                    $new_level = 3; // Naik ke level 3
                    $new_pa = '3.1'; // Mulai PA 3.1
                }
            } elseif ($current_level == 3) {
                // Logika untuk level 3
                if ($current_pa == '3.1' && $status_pa == 'next') {
                    $new_pa = '3.2'; // Pindah ke PA 3.2
                } elseif ($current_pa == '3.2' && $status_pa == 'next') {
                    $new_level = 4; // Naik ke level 4
                    $new_pa = '4.1'; // Mulai PA 4.1
                }
            } elseif ($current_level == 4) {
                // Logika untuk level 3
                if ($current_pa == '4.1' && $status_pa == 'next') {
                    $new_pa = '4.2'; // Pindah ke PA 3.2
                } elseif ($current_pa == '4.2' && $status_pa == 'next') {
                    $new_level = 5; // Naik ke level 4
                    $new_pa = '5.1'; // Mulai PA 4.1
                }
            } elseif ($current_level == 5) {
                // Logika untuk level 3
                if ($current_pa == '5.1' && $status_pa == 'next') {
                    $new_pa = '5.2'; // Pindah ke PA 3.2
                } elseif ($current_pa == '5.2' && $status_pa == 'next') {
                    $new_level = 5; // Naik ke level 6
                    $new_pa = 'stop'; // Stop
                }
            }

            // Update the database with the new level and PA
            $update_level_pa = "UPDATE pengujian SET level = '$new_level', pa = '$new_pa' WHERE id_pengujian = '$id_project'";
            if (mysqli_query($conn, $update_level_pa)) {
                $response = [
                    'status' => 'success',
                    'new_level' => $new_level,
                    'pa' => $new_pa
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Error updating level and PA: ' . mysqli_error($conn)
                ];
            }
        }

    }
    // echo json_encode($response);

}
echo json_encode($response);

// Kirimkan respon dalam format JSON
?>
