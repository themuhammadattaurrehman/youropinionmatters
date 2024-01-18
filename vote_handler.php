<?php

include 'connection.php';
include 'valid_session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_ids = array_map('intval', $_POST['question_id']);
    $selected_options = array_map('htmlspecialchars', $_POST['option']);
    $sad = $_POST['quiz'];
    $id = $_SESSION['id'];

    // Update the user table
    $updateUserSql = "INSERT INTO quiz (`userid`, `quiz`,`attempted`) 
                  VALUES ($id, $sad,1)";


    // Execute the statement for updating the user table
    if ($conn->query($updateUserSql) === TRUE) {
        echo "Vote for user ID $id successfully recorded!<br>";

        foreach ($question_ids as $question_id) {
            $selected_option = $selected_options[$question_id];

            // Validate and sanitize the column name for the question table
            // $allowed_columns_question = ['op1', 'op2']; // replace with your actual allowed columns
            // if (!in_array($selected_option, $allowed_columns_question)) {
            //     die("Invalid column name: $selected_option");
            // }

            $updateQuery = "UPDATE question 
                            SET `{$selected_option}_votes` = `{$selected_option}_votes` + 1 
                            WHERE id = $question_id";

            // Execute the statement for updating the question table
            if ($conn->query($updateQuery) === TRUE) {
                echo "Vote for question ID $question_id successfully recorded!<br>";
                header("Location: quiz-opt.php");
                exit();
            } else {
                echo "Error updating vote for question ID $question_id: " . $conn->error . "<br>";
            }
        }

        // Redirect after processing the form data
        // Ensure that no further output is sent after the header

    } else {
        echo "Error updating vote for user ID $id in user table: " . $conn->error . "<br>";
    }

} else {
    echo "Invalid request method. Expected POST.";
}

?>
