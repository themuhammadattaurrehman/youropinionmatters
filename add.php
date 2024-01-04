<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $questionText = $_POST["question_text"];
  $option1 = $_POST["option1"];
  $option2 = $_POST["option2"];
  $quiz = $_POST["quiz"];
  include 'connection.php';
  $sql = "INSERT INTO question (question, op1, op2, quiz) 
            VALUES ('$questionText', '$option1', '$option2', '$quiz')";
  if ($conn->query($sql) === TRUE) {
    $successMessage = "Question and options inserted successfully.";
  } else {
    $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
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
      <h1>Questions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Questions</li>
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
              if (isset($successMessage)) {
                echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
              } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
              }
              ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Question</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputText" name="question_text" rows="4"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Option 1</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="option1">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Option 2</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="option2">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Quiz No.</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="quiz">
                  </div>
                </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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