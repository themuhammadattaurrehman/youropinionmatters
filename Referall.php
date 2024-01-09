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
            <h1>Referal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Referal</li>
                </ol>
            </nav>
        </div>
        <!-- <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Referal</h5>
         <div class="container"> -->

         <form class="contact-form admin-form password-form ref-form" action="">

            <h2 class="mb-4">Referal</h2>    

            

            <?php 
                if ($result) {
                    // Check if there are rows returned
                    if ($result->num_rows > 0) {
                        // Fetch the row
                        $row = $result->fetch_assoc();
                        echo '<button class="btn btn-primary" onclick="generateReferralCode()" ' . (($row['referal']) ? 'disabled' : '') . '>Referal</button>';
                        echo '<p id="referralCodeDisplay" style="margin-top: 20px; font-weight: bold; font-size: 14px; text-align:center">'. $row["referal"] .'</p>';
                    }
                }
            ?>
          

        
         </form>

        <!-- </div>

        </div>
          </div>

        </div>
      </div>
    </section>  -->
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
