<!DOCTYPE html>
<html lang="en">
<?php
include 'connection.php';
include 'valid_session.php';
if (isset($_POST['approve'])) {
    $user_id = $_POST['user_id'];
    $approval = $_POST['approval'];
    $other = $_POST['other'];
    // Fetch the email associated with the user
    $getEmailQuery = "SELECT email,e_no FROM user WHERE id = '$user_id'";
    $resultEmail = $conn->query($getEmailQuery);
    if (!$resultEmail) {
        $errorMessage = "Error: " . $conn->error;
    } else {
        $rowEmail = $resultEmail->fetch_assoc();
        $email = $rowEmail['email'];
        $no=$rowEmail['e_no'];
        // Update the approval status in the database
        $updateQuery = "UPDATE user SET `$approval` = '1' WHERE `id` = '$user_id'";
        if ($conn->query($updateQuery) === TRUE) {
            // Send approval email
            if (mail($email, "Amount Message", "Hi, Your amount of 15rs in account no.".$no)) {
                $successMessage = "Updated successfully.";
                header("Location: review.php");
                exit();
            } else {
                $errorMessage = "Failed to send email.";
            }
        } else {
            $errorMessage = "Error updating approval status: " . $conn->error;
        }
    }
} elseif (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $other = $_POST['other'];
    $sql = "UPDATE user SET `$other` = '0' WHERE `id` = '$user_id'";

    if ($conn->query($sql) === TRUE) {
      $successMessage = "deleted successfully.";
    } else {
      $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
  
    // $conn->close();
}

include 'head.php';
?>

<body>
    <?php include 'header.php' ?>
    <?php include 'sidebar1.php' ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Question</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Question</li>
                </ol>
            </nav>
        </div>
        <div class="review">
            <div class="row">
                <div class="col-md-12">
                <?php
              if (isset($successMessage)) {
                echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
              } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
              }
              ?>
                    <table class="table blue-table shadow rounded">
                        <thead class="thead-blue">
                            <tr>
                                <th scope="col">Question</th>
                                <th scope="col">Option 1</th>
                                <th scope="col">Option 2</th>
                                <th scope="col">Quiz no</th>
                                <!-- <th scope="col">Amount</th>
                                <th scope="col">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
// Include your database connection
include 'connection.php';

// Query to fetch questions
$questionsQuery = "SELECT * FROM question";
$resultQuestions = $conn->query($questionsQuery);

// Check if there are questions
if ($resultQuestions->num_rows > 0) {
    // echo "<table border='1'>";
    // echo "<tr><th>Question</th><th>Options</th></tr>";

    while ($rowQuestion = $resultQuestions->fetch_assoc()) {
    //     $question_id = $rowQuestion['question_id'];
    //     $question_text = $rowQuestion['question_text'];

        echo "<tr>";
        echo "<td>" .$rowQuestion['question']."</td>";

        // Query to fetch options for each question
        // $optionsQuery = "SELECT * FROM options WHERE question_id = '$question_id'";
        // $resultOptions = $conn->query($optionsQuery);

        // // Check if there are options
        // if ($resultOptions->num_rows > 0) {
            echo "<td>";
            // while ($rowOption = $resultOptions->fetch_assoc()) {
                // $option_text = $rowOption['option_text'];
                echo $rowQuestion['op1'];
            // }
            echo "</td>";
            echo "<td>";
            // while ($rowOption = $resultOptions->fetch_assoc()) {
                // $option_text = $rowOption['option_text'];
                echo $rowQuestion['op2'];
            // }
            echo "</td>";
            echo "<td> Quiz " .$rowQuestion['quiz']."</td>";
        // } else {
        //     echo "<td>No options found</td>";
        // }

        echo "</tr>";
    }

    // echo "</table>";
} else {
    echo "<p>No questions found.</p>";
}

// Close the database connection
$conn->close();
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $('#myElement').on('click', function() {

            $.ajax({
                type: 'POST',
                url: 'myFunction.php',
                data: {
                    callFunction: true
                },
                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log('Error:', error);
                }
            });
        });
        $('#myElement1').on('click', function() {

            $.ajax({
                type: 'POST',
                url: 'myFunction1.php',
                data: {
                    callFunction: true
                },
                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log('Error:', error);
                }
            });
        });
    </script>
    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>