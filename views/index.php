<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cobit 5</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../assets/css/style.min.css">
</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        <?php include 'sidebar.php' ?>
        <div class="main-wrapper">
            <!-- ! Main nav -->
            <?php include 'main-nav.php' ?>
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                <div class="container">
                    <h2 class="main-title">Dashboard</h2>
                    <div class="row stat-cards">
                        <div class="col-md-6 col-xl-3">
                            <article class="stat-cards-item">
                                <div class="stat-cards-icon primary">
                                    <i data-feather="bar-chart-2" aria-hidden="true"></i>
                                </div>
                                <div class="stat-cards-info">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit success">
                                            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <article class="stat-cards-item">
                                <div class="stat-cards-icon warning">
                                    <i data-feather="file" aria-hidden="true"></i>
                                </div>
                                <div class="stat-cards-info">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit success">
                                            <i data-feather="trending-up" aria-hidden="true"></i>0.24%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <article class="stat-cards-item">
                                <div class="stat-cards-icon purple">
                                    <i data-feather="file" aria-hidden="true"></i>
                                </div>
                                <div class="stat-cards-info">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit danger">
                                            <i data-feather="trending-down" aria-hidden="true"></i>1.64%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <article class="stat-cards-item">
                                <div class="stat-cards-icon success">
                                    <i data-feather="feather" aria-hidden="true"></i>
                                </div>
                                <div class="stat-cards-info">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit warning">
                                            <i data-feather="trending-up" aria-hidden="true"></i>0.00%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </main>
            <!-- ! Footer -->
            <footer class="footer">
                <div class="container footer--flex">
                    <div class="footer-start">
                        <p>2021 © Elegant Dashboard - <a href="elegant-dashboard.com" target="_blank"
                                rel="noopener noreferrer">elegant-dashboard.com</a></p>
                    </div>
                    <ul class="footer-end">
                        <li><a href="##">About</a></li>
                        <li><a href="##">Support</a></li>
                        <li><a href="##">Puchase</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    <!-- Chart library -->
    <script src="../assets/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="../assets/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="../assets/js/script.js"></script>
</body>

</html>