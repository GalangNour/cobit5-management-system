<!-- ========== Left Sidebar Start ========== -->
<div class="sidebar-left">

    <div data-simplebar class="h-100">

        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu">
                <li>
                    <a href="index.php" class="">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="question.php" class="">
                        <i class="fas fa-question-circle"></i>
                        <span>Pertanyaan</span>
                    </a>
                </li>
                <li>
                    <a href="project.php" class="">
                        <i class="fas fa-poll"></i>
                        <span>Project</span>
                    </a>
                </li>
                <?php if ($role != 'auditor') { ?>
                <li>
                    <a href="user.php" class="">
                        <i class="fas fa-poll"></i>
                        <span>Users</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->