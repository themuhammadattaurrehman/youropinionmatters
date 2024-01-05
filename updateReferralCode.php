<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the referral code from the AJAX request
    $referralCode = $_POST["referralCode"];
    
    // Update the referral code in the database
    $userId = $_SESSION['id'];
    $sql = "UPDATE user SET referal = $referralCode WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "Referral code updated successfully!";
    } else {
        echo "Error updating referral code: " . $conn->error;
    }
    
    // Close the connection
    $conn->close();
}
?>
