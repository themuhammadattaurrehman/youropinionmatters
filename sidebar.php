

<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">


  <li class="nav-heading">Pages</li>
  <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
    <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
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
                <a class="nav-link collapsed" href="add-video.php">
                    <i class="bi bi-person"></i>
                    <span>Add Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="review.php">
                    <i class="bi bi-person"></i>
                    <span>Approval</span>
                </a>
            </li>
        <?php } ?>
        <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
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
            </li><!-- End Profile Page Nav -->
        <?php }
        // ob_end_flush();
        ?>
  
</ul>

</aside><!-- End Sidebar-->
