<?php
// display_questions.php
include 'connection.php';

// Retrieve questions from the database
$sql = "SELECT *  FROM question where quiz=1";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ?>
<?php include 'valid_session.php' ?>

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
             if ($result->num_rows > 0) {
              echo '<form method="post" action="vote_handler.php">';
              while ($row = $result->fetch_assoc()) {
                  echo '<div class="card mb-3">';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-title">Question: ' . $row["question"] . '</h5>';
                  echo '<input type="hidden" name="question_id[]" value="' . $row["id"] . '">';
          
                  // Calculate the sum of op1, op2, op3, and op4
                  $sum = $row['op1_votes'] + $row['op2_votes'];
          
                  // Display the sum
                  // echo '<p>Sum of Options: ' . $sum . '</p>';
          
                  // Loop through options and create radio buttons
                  for ($j = 1; $j <= 2; $j++) {
                      $optionKey = 'op' . $j;
                      $optionsKey = 'op' . $j . '_votes';
                      if($sum!==0){
                      $percentage = ($row[$optionsKey] /$sum) * 100;
                    }
                      echo '<label>';
                      echo '<input type="radio" name="option[' . $row["id"] . ']" value="' . $optionKey . '"> ' . $row[$optionKey] . ' ' . $percentage . '%</label><br>';
                  }
          
                  echo '</div>';
                  echo '</div>';
              }
              echo '<input type="submit" value="Vote">';
              echo '</form>';
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