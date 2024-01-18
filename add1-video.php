<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMessage = "";
    // Assuming $_SESSION['id'] contains the user's ID
    // $userId = $_SESSION['id'];
    $quiz = $_POST['quiz'];
    // Get the video link from the form
    $videoLink = $_POST['url'];

    // Check if a video link already exists for the given quiz
    $checkSql = "SELECT COUNT(*) AS link_count FROM video WHERE quiz = $quiz";
    $checkResult = $conn->query($checkSql);

    if ($checkResult) {
        $linkCount = $checkResult->fetch_assoc()['link_count'];

        if ($linkCount > 0) {
            // Entry already exists for the quiz, you can choose to update the existing link or show an error message
            $errorMessage = "Video link already exists for Quiz $quiz";
        } else {
            // Insert the video link into the database
            $insertSql = "INSERT INTO video (quiz, link) VALUES ($quiz, '$videoLink')";

            if ($conn->query($insertSql) === TRUE) {
                $successMessage = "Video link inserted successfully";
            } else {
                $errorMessage = "Error inserting video link: " . $conn->error;
            }
        }
    } else {
        $errorMessage = "Error checking existing video link: " . $conn->error;
    }
}

// Close the database connection
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
              <h5 class="card-title">Insert Video</h5>
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
                    <!-- <option >Select Any</option>
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