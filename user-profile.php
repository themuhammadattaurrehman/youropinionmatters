<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<?php include 'valid_session.php' ?>
<?php
include 'connection.php';
$sql = "SELECT * FROM `user` WHERE id=" . $_SESSION['id'];
$result=$conn->query($sql);
?>
<body>
<?php include 'header.php' ?>
  <!-- ======= Header ======= -->
  <?php include 'sidebar1.php' ?>

  <!-- ======= Sidebar ======= -->
 
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="col-xl-8">
<div class="card">
  <div class="card-body pt-3">
    <!-- Bordered Tabs -->
    <ul class="nav nav-tabs nav-tabs-bordered">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile</button>
      </li>
    </ul>
    <div class="tab-content pt-2">

      <div class="tab-pane fade show active profile-overview" id="profile-overview">
        <!-- <h5 class="card-title">About</h5>
        <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

        <h5 class="card-title">Profile Details</h5>

        <div class="row">
            <?php 
            if (!$result) {
                die("Query failed: " . $conn->error);
            }
            $row = $result->fetch_assoc();
            ?>
          <div class="col-lg-3 col-md-4 label ">Full Name</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['first_name'].' '.$row['last_name'] ?></div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 label">Email</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['email'] ?></div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 label">User Name</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['user_name'] ?></div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 label">D.O.B</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['d_o_b'] ?></div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 label">Reference</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['reference'] ?></div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 label">Easypaisa No.</div>
          <div class="col-lg-9 col-md-8"><?php echo $row['e_no'] ?></div>
        </div>
      </div>
  </div>
</div>

</div>
</div>
   

  </main><!-- End #main -->
<?php include 'footer.php' ?>
  <!-- ======= Footer ======= -->
 

</body>

</html>