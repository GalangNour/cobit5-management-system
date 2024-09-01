<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id_perspektif = $_GET['id'];
    $get_perspektif = mysqli_query($conn, "SELECT * FROM perspektif WHERE id_perspektif = '$id_perspektif'");
    $perspektif = mysqli_fetch_assoc($get_perspektif);
    $nama_perspektif = $perspektif['nama_perspektif'];
    // $namaperspektif = mysqli_q
    // Tentukan level yang akan ditampilkan
    $level = isset($_GET['level']) ? $_GET['level'] : 1;

    // Ambil data pertanyaan berdasarkan level
    $get_data = mysqli_query($conn, "SELECT * FROM questions WHERE perspektif_id = $id_perspektif AND level = '$level'");
} else {
    echo "ID Perspektif tidak ditemukan!";
    exit;
}

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nilai_input = $_POST['inputNilai'];
    $id_question = $_POST['idQuestion'];
    $total_nilai = 0;
    $jumlah_pertanyaan = count($nilai_input);

    // Update setiap nilai ke database
    for ($i = 0; $i < $jumlah_pertanyaan; $i++) {
        $nilai = $nilai_input[$i];
        $id = $id_question[$i];

        $update_query = mysqli_query($conn, "UPDATE questions SET exist = '$nilai' WHERE id_question = '$id'");

        if (!$update_query) {
            echo "Gagal menyimpan data untuk ID $id.";
            exit;
        }

        $total_nilai += $nilai;
    }

    $cc = $total_nilai / $jumlah_pertanyaan;

    if ($level == '2.1') {
        // Jika skor 51% - 100%, lanjutkan ke level 2.2
        if ($cc >= 51 && $cc <= 100) {
            $next_level = '2.2';
            header("Location: pengujian.php?id=$id_perspektif&level=$next_level");
            exit;
        } else {
            $hasil_ujian = "Skor Anda tidak cukup untuk melanjutkan ke level 2.2.";
        }
    } else if ($level == '2.2') {
        // Jika level 2.2
        if ($cc == 100) {
            $hasil_ujian = "Anda bisa lanjut ke level 3.";
        } else {
            $hasil_ujian = "Tes berakhir di sini. Skor Anda tidak cukup untuk melanjutkan.";
        }
    } else {
        // Logika untuk level lain (misalnya level 1)
        if ($cc == 100) {
            $next_level = '2.1';
            header("Location: pengujian.php?id=$id_perspektif&level=$next_level");
            exit;
        } else {
            $hasil_ujian = "Skor Anda tidak cukup untuk melanjutkan ke level berikutnya.";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pengujian Perspektif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cobit 5" name="description" />
    <meta content="Cobit 5" name="author" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'partials/topbar.php'; ?>
        <?php include 'partials/sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Pengujian <?php echo $nama_perspektif ?> Level
                                        <?php echo $level; ?></h4>
                                </div>
                                <div class="card-body">
                                    <?php if (!isset($hasil_ujian) || $level != '2.2') { ?>
                                    <!-- Tampilkan tabel pertanyaan hanya jika tidak ada hasil pengujian atau bukan level 2.2 -->
                                    <form method="POST">
                                        <table
                                            class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <?php if ($level != '2.1' && $level != '2.2') { ?>
                                                    <th>Praktik Dasar</th>
                                                    <?php } ?>
                                                    <th>Praktik Umum</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                while ($display = mysqli_fetch_array($get_data)) {
                                                    $id = $display['id_question'];
                                                    $praktik_dasar = $display['praktik_dasar'];
                                                    $praktik_umum = $display['praktik_umum'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <?php if ($level != '2.1' && $level != '2.2') { ?>
                                                    <td><?php echo $praktik_dasar ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $praktik_umum ?></td>
                                                    <td>
                                                        <input type="hidden" name="idQuestion[]"
                                                            value="<?php echo $id; ?>">
                                                        <input type="number" class="form-control" name="inputNilai[]"
                                                            aria-describedby="inputNilai" required>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <?php } ?>

                                    <!-- Tampilkan hasil pengujian -->
                                    <?php if (isset($hasil_ujian)) { ?>
                                    <p><?php echo $hasil_ujian; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>