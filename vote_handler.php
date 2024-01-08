<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if (isset($_POST['question_id']) && is_array($_POST['question_id']) && isset($_POST['option'])) {
        $question_ids = array_map('intval', $_POST['question_id']);
        $selected_options = array_map('htmlspecialchars', $_POST['option']);
        foreach ($question_ids as $question_id) {
            if (!isset($selected_options[$question_id])) {
                die("Invalid request. Missing selected option for question ID: $question_id");
            }
        }
        foreach ($question_ids as $question_id) {
            $selected_option = $selected_options[$question_id];
            $updateQuery = "UPDATE question SET {$selected_option}_votes = {$selected_option}_votes + 1 WHERE id = $question_id";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Vote for question ID $question_id successfully recorded!<br>";
                header("location: quiz.php");
            } else {
                echo "Error updating vote for question ID $question_id: " . mysqli_error($conn) . "<br>";
            }
        }
    // } else {
    //     echo "Invalid request. Required parameters not set or not in the expected format.";
    // }
} else {
    echo "Invalid request method. Expected POST.";
}
?>
