<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $questionText = $_POST["url"];
  $quiz = $_POST["quiz"];

  include 'connection.php';

 
  $questionText = mysqli_real_escape_string($conn, $questionText);
  $quiz = mysqli_real_escape_string($conn, $quiz);

 
  $sql = "UPDATE video SET `link` = '$questionText' WHERE `quiz` = '$quiz'";

  if ($conn->query($sql) === TRUE) {
    $successMessage = "Updated successfully.";
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
  <?php include 'sidebar1.php' ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Videos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Videos</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Video</h5>
              <?php
              if (isset($successMessage)) {
                echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
              } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
              }
              ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row mb-3">
                  <label for="url" class="col-sm-2 col-form-label">Link:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="url" name="url">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="quiz" class="col-sm-2 col-form-label">Quiz:</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="quiz" name="quiz">
                    <!-- <select class="form-select" id="quiz" name="quiz">
                    <option >Select Any</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select> -->
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
  </main>
  <?php include 'footer.php' ?>
</body>

</html>