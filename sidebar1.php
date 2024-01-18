<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-heading">Pages</li>
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index-admin.php">
                    <i class="bi bi-person"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="add.php">
                    <i class="bi bi-person"></i>
                    <span>Add question</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="add1-video.php">
                    <i class="bi bi-person"></i>
                    <span>Add Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="update-video.php">
                    <i class="bi bi-person"></i>
                    <span>Update Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="review.php">
                    <i class="bi bi-person"></i>
                    <span>Approval</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="qview.php">
                    <i class="bi bi-person"></i>
                    <span>Question</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="vview.php">
                    <i class="bi bi-person"></i>
                    <span>Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="amountrecord.php">
                    <i class="bi bi-person"></i>
                    <span>Amount Record</span>
                </a>
            </li>
        <?php } ?>
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-person"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="quiz-opt.php">
                    <i class="bi bi-person"></i>
                    <span>Front Page</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="amounts.php">
                    <i class="bi bi-person"></i>
                    <span>Amount Earn</span>
                </a>
            </li>
            
        <?php }
        // ob_end_flush();
        ?>

    </ul>

</aside><!-- End Sidebar-->