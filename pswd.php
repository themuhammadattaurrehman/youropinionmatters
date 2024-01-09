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
    <?php include 'sidebar.php' ?>

     <main id="main" class="main">
    <!--<div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Change Password</h5>
         <div class="container"> -->

         
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="contact-form admin-form password-form">
                <h2 class="mb-4">Change Password</h2>


                <!-- Error Message -->
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
                

                <div class="form-group mt-1">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control" id="opassword" name="opassword" required placeholder="Enter old password">
                </div>

                <div class="form-group mt-1">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="npassword" name="npassword" required placeholder="Enter new password">
                </div>

                <div class="form-group mt-1">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required placeholder="Confirm new password">
                </div>

                <button type="submit" class="real-btn btn btn-primary btn-block mt-3">Confirm Password</button>
                <div id="message" class="alert-msg"></div>

            </form>
        <!-- </div>
        </div>
          </div>

        </div>
      </div>
    </section> -->
    </main>




    <!-- <main>


        <div class="container">

            <div class="row">
                <div class="dash-profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="admin-logo">
                                    <img src="../assets/media/logo-dark.png">
                                </div>
                            </div>
                            <div class="col-xl-4 offset-xl-4">
                                <div class="contact mb-24">
                                    <h2 class="fw-5 fs-23 color-dark-2 font-sec mb-16 form-heading">Change Password</h2>
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
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="contact-form admin-form">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-6 col-12">
                                                <div claxss="form-group mb-16">
                                                    <input type="password" class="form-control" id="opassword" name="opassword" required placeholder="Old Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-md-6 col-12">
                                                <div class="form-group mb-16">
                                                    <input type="password" class="form-control" id="npassword" name="npassword" required placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-md-6 col-12">
                                                <div class="form-group mb-16">
                                                    <input type="password" class="form-control" id="cpassword" name="cpassword" required placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="real-btn bordered w-100">change Password</button>
                                        <div id="message" class="alert-msg"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> -->


    <?php include 'footer.php' ?>
</body>

</html>