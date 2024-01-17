<?php
$errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $reference = $_POST["reference"];

    // Check if email already exists
    include 'connection.php';
    $checkEmailQuery = "SELECT COUNT(*) AS count FROM user WHERE email = '$email'";
    $resultEmail = $conn->query($checkEmailQuery);
    $rowEmail = $resultEmail->fetch_assoc();

    if ($rowEmail['count'] > 0) {
        $errorMessage = "Email already exists. Please choose a different email.";
    } else {
        // Check if referral code exists
        $checkReferralCode = "SELECT COUNT(*) AS count FROM user WHERE referal = '$reference'";
        $resultReferral = $conn->query($checkReferralCode);
        $rowReferral = $resultReferral->fetch_assoc();

        if ($rowReferral['count'] > 0) {
            // Check if passwords match
            if ($password != $cpassword) {
                $errorMessage = "Password and Confirm Password do not match.";
            } else {
                // Insert into the database
                $sql = "INSERT INTO user (first_name, last_name, password, user_name, email, d_o_b, reference)
                        VALUES ('$fname', '$lname', '$password', '$username', '$email', '$dob', '$reference')";

                if ($conn->query($sql) === TRUE) {
                    // Send welcome email
                    if (mail($email, "Welcome Message", "Hi, You are successfully signed up on uropinion matters")) {
                        $successMessage = "Form submitted successfully";
                        header("Location: signup.php");
                        exit();
                    } else {
                        $errorMessage = "Failed to send welcome email.";
                    }
                } else {
                    $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        } else {
            $errorMessage = "Referral code does not exist!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="container">

            <div class="row justify-content-center">
              <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Your Opinion Matters</span>
                  </a>
                </div>

                <div class="card mb-6">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Signup to Your Account</h5>
                      <p class="text-center small">Enter in field to signup</p>
                    </div>
                    <?php if (!empty($errorMessage)) : ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                      </div>
                    <?php endif; ?>

                    <?php if (!empty($successMessage)) : ?>
                      <div class="alert alert-success" role="alert">
                        <?php echo $successMessage; ?>
                      </div>
                    <?php endif; ?>

                    <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                      <div class="col-6">
                        <label for="yourUsername" class="form-label">First Name</label>

                        <input type="text" name="fname" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your first name.</div>
                      </div>


                      <div class="col-6">
                        <label for="yourPassword" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your last name!</div>
                      </div>

                      <div class="col-6">
                        <label for="yourUsername" class="form-label">Password</label>

                        <input type="password" name="password" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>


                      <div class="col-6">
                        <label for="yourPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your cpassword!</div>
                      </div>

                      <div class="col-6">
                        <label for="yourUsername" class="form-label">Username</label>

                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>


                      <div class="col-6">
                        <label for="yourPassword" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your email</div>
                      </div>

                      <div class="col-6">
                        <label for="yourUsername" class="form-label">Date of birth</label>

                        <input type="date" name="dob" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your dob.</div>
                      </div>


                      <div class="col-6">
                        <label for="yourPassword" class="form-label">Reference</label>
                        <input type="text" name="reference" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your reference</div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Signup</button>
                      </div>

                    </form>

                  </div>
                </div>

                <div class="credits">

                  Designed by <a href="https://ewarenet.com/">EwareNet</a>
                </div>

              </div>
            </div>
          </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="assets/js/main.js"></script>

</body>

</html>