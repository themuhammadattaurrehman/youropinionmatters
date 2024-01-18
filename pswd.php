<?php
include 'connection.php';
// Assuming you have a database connection established
// Include 'connection.php' or set up your database connection accordingly
include 'valid_session.php';
// session_start(); // Assuming you're using sessions for user authentication

// Initialize error message variable
$errorMsg = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $opassword = $_POST['opassword'];
    $npassword = $_POST['npassword'];
    $cpassword = $_POST['cpassword'];

    // Validate the form data (you can add more validation as needed)
    if (empty($opassword) || empty($npassword) || empty($cpassword)) {
        $errorMsg = "Please fill in all the fields.";
    } elseif ($npassword !== $cpassword) {
        $errorMsg = "New password and confirm password do not match.";
    } else {
        // Fetch the old password from the database for the logged-in user
        $userId = $_SESSION['id']; // Assuming you have a user ID in the session
        $sql = "SELECT password FROM user WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($dbPassword);
        $stmt->fetch();
        $stmt->close();

        // Check if the entered old password matches the stored password
        if ($opassword === $dbPassword) {

            $sqlUpdate = "UPDATE user SET password = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $npassword, $userId);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            $successMsg = "Password changed successfully.";
        } else {
            $errorMsg = "Incorrect old password. Please check your old password and try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>
    <?php include 'header.php' ?>
    <?php include 'sidebar1.php' ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Change Password</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Change Password</h5>
              <?php
              if (isset($successMessage)) {
                echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
              } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
              }
              ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            <!-- <h2 class="mb-4">Change Password</h2> -->
            <?php if (!empty($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMsg; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($successMsg)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMsg; ?>
                </div>
            <?php endif; ?>
        
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Old</label>
                  <div class="col-sm-10">
                <input type="password" class="form-control" id="opassword" name="opassword" required placeholder="Enter old password">
                </div>
            </div>
            <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">New</label>
                  <div class="col-sm-10">
                <input type="password" class="form-control" id="npassword" name="npassword" required placeholder="Enter new password">
                </div>
            </div>
            <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Confirm</label>
                  <div class="col-sm-10">
                <input type="password" class="form-control" id="cpassword" name="cpassword" required placeholder="Confirm new password">
                </div>
            </div>
            <div class="text-start">
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
                </div>
            <div id="message" class="alert-msg"></div>
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