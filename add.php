<?php
// process_form.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $questionText = $_POST["question_text"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];

    // Perform your database insert here using the retrieved data
    // Make sure to use prepared statements to prevent SQL injection

    // Example code:
    include 'connection.php'; 

    $sql = "INSERT INTO question (question, op1, op2, op3, op4) 
            VALUES ('$questionText', '$option1', '$option2', '$option3', '$option4')";

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
    // Display success or error message
    if (isset($successMessage)) {
        echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
    } elseif (isset($errorMessage)) {
        echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
    }
    ?>
              <!-- Horizontal Form -->
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Question</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="question_text">
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
                  <label for="inputPassword" class="col-sm-2 col-form-label">Option 3</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="option3">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Option 4</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword" name="option4">
                  </div>
                </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
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