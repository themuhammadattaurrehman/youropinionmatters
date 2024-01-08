<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the referral code from the AJAX request
    $referralCode = $_POST["referralCode"];
    
    // Update the referral code and link in the database
    $userId = $_SESSION['id'];
    $referralLink = "https://uropinionmatters.com/" . $referralCode;
    $sql = "UPDATE user SET referal = '$referralLink' WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "Referral code and link updated successfully! Referral Link: <a href='$referralLink'>$referralLink</a>";
    } else {
        echo "Error updating referral code and link: " . $conn->error;
    }
    
    // Close the connection
    $conn->close();
}
?>

