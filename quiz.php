<?php
// display_questions.php
include 'connection.php';

// Retrieve questions from the database
$sql = "SELECT * FROM question";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ?>

<body>

  <!-- ======= Header ======= -->
  <?php include 'header.php' ?>
  <!-- ======= Sidebar ======= -->
  <?php include 'sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Insert Question</h5>
              <?php
        // Display questions
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Question: ' . $row["question"] . '</h5>';
                echo '<p class="card-text">Option 1: ' . $row["op1"] . '</p>';
                echo '<p class="card-text">Option 2: ' . $row["op2"] . '</p>';
                echo '<p class="card-text">Option 3: ' . $row["op3"] . '</p>';
                echo '<p class="card-text">Option 4: ' . $row["op4"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No questions available.</p>';
        }
        ?>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php' ?>

</body>

</html>