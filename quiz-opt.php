<?php
include 'connection.php';
include 'valid_session.php';
// echo $_SESSION['id'];
// $sql = "SELECT `1`,`2`,`3`,`4`,`5` FROM user WHERE id=" . $_SESSION['id'];

// // Execute the query
// $result = $conn->query($sql);
// // echo $result
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ?>

<body>
    <!-- ======= Header ======= -->
    <?php include 'header.php' ?>
    <!-- ======= Sidebar ======= -->
    <?php include 'sidebar1.php' ?>


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
        <!-- <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="quiz-opt">
                    <div class="row">

                        <div class="col-md-12">
                            <h2 class="mb-4">Please select any quiz. </h2>
                        </div>

                        <?php
                        // echo "Value from Database for Quiz 1: " . $row['1'];
                        ?>
                        <div class="col">
                            <a href="video.php?quiz=1" class="card info-card sales-card quiz-opt-card <?php echo ($row['1'] == 1) ? 'quizdisabled' : ''; ?>">
                                <span>Quiz 1</span>
                            </a>
                        </div>

                        <?php
                        // echo "Value from Database for Quiz 2: " . $row['2'];
                        ?>
                        <div class="col">
                            <a href="video.php?quiz=2" class="card info-card sales-card quiz-opt-card <?php echo ($row['2'] == 1) ? 'quizdisabled' : ''; ?>">
                                <span>Quiz 2</span>
                            </a>
                        </div>

                        <?php
                        // echo "Value from Database for Quiz 3: " . $row['3'];
                        ?>
                        <div class="col">
                            <a href="video.php?quiz=3" class="card info-card sales-card quiz-opt-card <?php echo ($row['3'] == 1) ? 'quizdisabled' : ''; ?>">
                                <span>Quiz 3</span>
                            </a>
                        </div>

                        <?php
                        // echo "Value from Database for Quiz 4: " . $row['4'];
                        ?>
                        <div class="col">
                            <a href="video.php?quiz=4" class="card info-card sales-card quiz-opt-card <?php echo ($row['4'] == 1) ? 'quizdisabled' : ''; ?>">
                                <span>Quiz 4</span>
                            </a>
                        </div>

                        <?php
                        // echo "Value from Database for Quiz 5: " . $row['5'];
                        ?>
                        <div class="col">
                            <a href="video.php?quiz=5" class="card info-card sales-card quiz-opt-card <?php echo ($row['5'] == 1) ? 'quizdisabled' : ''; ?>">
                                <span>Quiz 5</span>
                            </a>
                        </div>

                    </div>
                </div>
        <?php
            }
        }
        ?> -->

<div class="quiz-opt">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4" style="color: #012970;"><b>Please select any quiz.</b></h2>
        </div>
        <?php
        include 'connection.php';

        // Assuming $_SESSION['id'] contains the user's ID
        $userId = $_SESSION['id'];

        // Check if entry exists in the quiz table for the user
        $checkQuizSql = "SELECT quiz FROM quiz WHERE userid = $userId";
        $checkQuizResult = $conn->query($checkQuizSql);

        if ($checkQuizResult) {
            $disabledQuizzes = array();

            // Fetch the quizzes that are already present in the quiz table for the user
            while ($row = $checkQuizResult->fetch_assoc()) {
                $disabledQuizzes[] = $row['quiz'];
            }

            // Fetch the total number of distinct quiz groups
            $groupCountSql = "SELECT COUNT(DISTINCT `quiz`) AS group_count FROM question";
            $groupCountResult = $conn->query($groupCountSql);

            if ($groupCountResult) {
                $groupCount = $groupCountResult->fetch_assoc()['group_count'];

                // Assuming you want to display 5 quizzes per row
                $quizzesPerRow = 5;

                for ($quizNumber = 1; $quizNumber <= $groupCount; $quizNumber++) {
                    // Calculate whether to start a new row
                    $startNewRow = ($quizNumber % $quizzesPerRow == 1);

                    if ($startNewRow) {
                        echo '<div class="row">';
                    }

                    // Check if the quiz is already present in the quiz table for the user
                    $isDisabled = in_array($quizNumber, $disabledQuizzes) ? 'quizdisabled' : '';
        ?>
                    <div class="col">
                        <a href="video.php?quiz=<?php echo $quizNumber; ?>" class="card info-card sales-card quiz-opt-card <?php echo $isDisabled; ?>">
                            <span>Quiz <?php echo $quizNumber; ?></span>
                        </a>
                    </div>
        <?php
                    // End the row after every fifth quiz or at the end of the loop
                    if ($quizNumber % $quizzesPerRow == 0 || $quizNumber == $groupCount) {
                        echo '</div>';
                    }
                }
            } else {
                // Handle query error for group count
                echo "Error executing query for group count: " . $conn->error;
            }
        } else {
            // Handle query error for quiz check
            echo "Error executing query for quiz check: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>





        <!-- <script>
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
        </script> -->

    </main>


    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>