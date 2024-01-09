<?php 
include 'connection.php';
include 'valid_session.php';
$sql = "SELECT referal FROM user WHERE id=".$_SESSION['id'];

// Execute the query
$result = $conn->query($sql);

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
            <h1>Quizzes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Quizzes</li>
                </ol>
            </nav>
        </div>

        <div class="quiz-opt">
            <div class="row">

                <div class="col-md-12">
                    <h2 class="mb-4">Please select any quiz. </h2>
                </div>

                <div class="col">
                    <a href="#" class="card info-card sales-card quiz-opt-card">
                        <span>Quiz 1</span>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card info-card sales-card quiz-opt-card">
                        <span>Quiz 2</span>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card info-card sales-card quiz-opt-card">
                        <span>Quiz 3</span>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card info-card sales-card quiz-opt-card">
                        <span>Quiz 4</span>
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="card info-card sales-card quiz-opt-card">
                        <span>Quiz 5</span>
                    </a>
                </div>

            </div>
        </div>

         

      
        <script>
            function generateReferralCode() {
                // Generate referral code
                var referralCode = Math.floor(10000000 + Math.random() * 90000000);

                // Send AJAX request to update the referral code in the database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "updateReferralCode.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText); // Output from the server
                        // Display the referral code on the page
                        document.getElementById("referralCodeDisplay").innerHTML = "Referral Code: " + referralCode;
                    }
                };
                xhr.send("referralCode=" + referralCode);
            }
        </script>

    </main>


    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>
